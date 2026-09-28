<?php

// Admin category module disabled — see app/Config/Routes.php (category routes commented).

namespace App\Controllers\Admin;

use App\Libraries\ImageUpload;
use App\Models\ProductCategoryModel;

class ProductCategory extends AdminBaseController
{
    protected ProductCategoryModel $categoryModel;
    protected ImageUpload $imageUpload;

    public function __construct()
    {
        $this->categoryModel = model(ProductCategoryModel::class);
        $this->imageUpload   = new ImageUpload();
    }

    public function index()
    {
        $filters = [
            'search' => $this->request->getGet('search'),
            'status' => $this->request->getGet('status'),
        ];

        $result = $this->categoryModel->adminList($filters, 20);

        return $this->render('admin/categories/index', [
            'pageTitle'  => 'Product Categories',
            'categories' => $result['categories'],
            'pager'      => $result['pager'],
            'filters'    => $filters,
        ]);
    }

    public function create()
    {
        return $this->render('admin/categories/form', [
            'pageTitle' => 'Add Category',
            'category'  => null,
        ]);
    }

    public function store()
    {
        return $this->saveCategory();
    }

    public function edit(int $id)
    {
        $category = $this->categoryModel->find($id);

        if (! $category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('admin/categories/form', [
            'pageTitle' => 'Edit Category',
            'category'  => $category,
        ]);
    }

    public function update(int $id)
    {
        return $this->saveCategory($id);
    }

    public function view(int $id)
    {
        $category = $this->categoryModel->find($id);

        if (! $category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('admin/categories/view', [
            'pageTitle' => 'View Category',
            'category'  => $category,
        ]);
    }

    public function delete(int $id)
    {
        $category = $this->categoryModel->find($id);

        if (! $category) {
            return $this->jsonResponse(['success' => false, 'message' => 'Category not found.'], 404);
        }

        $this->imageUpload->delete($category['image']);
        $this->categoryModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->jsonResponse(['success' => true, 'message' => 'Category deleted successfully.']);
        }

        return redirect()->to('/admin/categories')->with('success', 'Category deleted successfully.');
    }

    protected function saveCategory(?int $id = null)
    {
        $rules = [
            'name'   => 'required|min_length[2]|max_length[200]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = $this->request->getPost('slug');

        if (empty($slug)) {
            $slug = create_slug($this->request->getPost('name'), 'product_categories', $id);
        }

        $data = [
            'name'              => $this->request->getPost('name'),
            'slug'              => $slug,
            'short_description' => $this->request->getPost('short_description'),
            'description'       => $this->request->getPost('description'),
            'meta_title'        => $this->request->getPost('meta_title'),
            'meta_description'  => $this->request->getPost('meta_description'),
            'meta_keywords'     => $this->request->getPost('meta_keywords'),
            'sort_order'        => (int) $this->request->getPost('sort_order'),
            'status'            => $this->request->getPost('status'),
        ];

        $file = $this->request->getFile('image');

        if ($file && $file->isValid()) {
            $upload = $this->imageUpload->upload($file, 'categories');

            if (! $upload['success']) {
                return redirect()->back()->withInput()->with('error', $upload['message']);
            }

            if ($id) {
                $existing = $this->categoryModel->find($id);
                $this->imageUpload->delete($existing['image'] ?? null);
            }

            $data['image'] = $upload['filename'];
        }

        if ($id) {
            $this->categoryModel->update($id, $data);
            $message = 'Category updated successfully.';
        } else {
            $this->categoryModel->insert($data);
            $message = 'Category created successfully.';
        }

        return redirect()->to('/admin/categories')->with('success', $message);
    }
}
