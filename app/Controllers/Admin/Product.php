<?php

namespace App\Controllers\Admin;

use App\Libraries\ImageUpload;
use App\Models\ProductCategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductSpecificationModel;

class Product extends AdminBaseController
{
    protected ProductModel $productModel;
    protected ProductSpecificationModel $specModel;
    protected ProductImageModel $imageModel;
    protected ImageUpload $imageUpload;

    public function __construct()
    {
        $this->productModel = model(ProductModel::class);
        $this->specModel    = model(ProductSpecificationModel::class);
        $this->imageModel   = model(ProductImageModel::class);
        $this->imageUpload  = new ImageUpload();
    }

    public function index()
    {
        $filters = [
            'search'      => $this->request->getGet('search'),
            'status'      => $this->request->getGet('status'),
            'category_id' => $this->request->getGet('category_id'),
        ];

        $result = $this->productModel->adminList($filters, 20);

        return $this->render('admin/products/index', [
            'pageTitle'  => 'Products',
            'products'   => $result['products'],
            'pager'      => $result['pager'],
            'filters'    => $filters,
            'categories' => model(ProductCategoryModel::class)->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        return $this->render('admin/products/form', [
            'pageTitle'      => 'Add Product',
            'product'        => null,
            'specifications' => [],
            'gallery'        => [],
            'categories'     => model(ProductCategoryModel::class)->where('status', 'active')->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function store()
    {
        return $this->saveProduct();
    }

    public function edit(int $id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('admin/products/form', [
            'pageTitle'      => 'Edit Product',
            'product'        => $product,
            'specifications' => $this->specModel->getByProduct($id),
            'gallery'        => $this->imageModel->getByProduct($id),
            'categories'     => model(ProductCategoryModel::class)->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function update(int $id)
    {
        return $this->saveProduct($id);
    }

    public function view(int $id)
    {
        $product = $this->productModel->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'product_categories.id = products.category_id', 'left')
            ->where('products.id', $id)
            ->first();

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('admin/products/view', [
            'pageTitle'      => 'View Product',
            'product'        => $product,
            'specifications' => $this->specModel->getByProduct($id),
            'gallery'        => $this->imageModel->getByProduct($id),
        ]);
    }

    public function delete(int $id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            return $this->jsonResponse(['success' => false, 'message' => 'Product not found.'], 404);
        }

        $this->imageUpload->delete($product['main_image']);

        foreach ($this->imageModel->getByProduct($id) as $img) {
            $this->imageUpload->delete($img['image']);
        }

        $this->productModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->jsonResponse(['success' => true, 'message' => 'Product deleted successfully.']);
        }

        return redirect()->to('/admin/products')->with('success', 'Product deleted successfully.');
    }

    public function deleteGalleryImage(int $id)
    {
        $image = $this->imageModel->deleteImage($id);

        if (! $image) {
            return $this->jsonResponse(['success' => false, 'message' => 'Image not found.'], 404);
        }

        $this->imageUpload->delete($image['image']);

        return $this->jsonResponse(['success' => true, 'message' => 'Gallery image deleted.']);
    }

    protected function saveProduct(?int $id = null)
    {
        $rules = [
            'name'        => 'required|min_length[2]|max_length[255]',
            'category_id' => 'required|integer',
            'status'      => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = $this->request->getPost('slug');

        if (empty($slug)) {
            $slug = create_slug($this->request->getPost('name'), 'products', $id);
        }

        $data = [
            'category_id'              => (int) $this->request->getPost('category_id'),
            'name'                     => $this->request->getPost('name'),
            'slug'                     => $slug,
            'short_description'        => $this->request->getPost('short_description'),
            'description'              => $this->request->getPost('description'),
            'moq'                      => $this->request->getPost('moq'),
            'moq_unit'                 => $this->request->getPost('moq_unit'),
            'applications'             => $this->request->getPost('applications'),
            'benefits'                 => $this->request->getPost('benefits'),
            'packaging_information'    => $this->request->getPost('packaging_information'),
            'availability_information' => $this->request->getPost('availability_information'),
            'meta_title'               => $this->request->getPost('meta_title'),
            'meta_description'         => $this->request->getPost('meta_description'),
            'meta_keywords'            => $this->request->getPost('meta_keywords'),
            'is_featured'              => $this->request->getPost('is_featured') ? 1 : 0,
            'status'                   => $this->request->getPost('status'),
        ];

        $mainImage = $this->request->getFile('main_image');

        if ($mainImage && $mainImage->isValid()) {
            $upload = $this->imageUpload->upload($mainImage, 'products');

            if (! $upload['success']) {
                return redirect()->back()->withInput()->with('error', $upload['message']);
            }

            if ($id) {
                $existing = $this->productModel->find($id);
                $this->imageUpload->delete($existing['main_image'] ?? null);
            }

            $data['main_image'] = $upload['filename'];
        }

        if ($id) {
            $this->productModel->update($id, $data);
            $productId = $id;
            $message   = 'Product updated successfully.';
        } else {
            $productId = $this->productModel->insert($data);
            $message   = 'Product created successfully.';
        }

        $specifications = $this->request->getPost('specifications') ?? [];
        $this->specModel->saveForProduct($productId, is_array($specifications) ? $specifications : []);

        $galleryFiles = $this->request->getFiles()['gallery'] ?? [];

        if (is_array($galleryFiles)) {
            $sortOrder = count($this->imageModel->getByProduct($productId));

            foreach ($galleryFiles as $file) {
                if ($file && $file->isValid() && ! $file->hasMoved()) {
                    $upload = $this->imageUpload->upload($file, 'products/gallery');

                    if ($upload['success']) {
                        $this->imageModel->insert([
                            'product_id' => $productId,
                            'image'      => $upload['filename'],
                            'sort_order' => $sortOrder++,
                        ]);
                    }
                }
            }
        }

        return redirect()->to('/admin/products')->with('success', $message);
    }
}
