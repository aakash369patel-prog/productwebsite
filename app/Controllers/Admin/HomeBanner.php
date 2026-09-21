<?php

namespace App\Controllers\Admin;

use App\Libraries\ImageUpload;
use App\Models\HomeBannerModel;

class HomeBanner extends AdminBaseController
{
    protected HomeBannerModel $bannerModel;
    protected ImageUpload $imageUpload;

    public function __construct()
    {
        $this->bannerModel = model(HomeBannerModel::class);
        $this->imageUpload = new ImageUpload();
    }

    public function index()
    {
        $filters = [
            'search' => $this->request->getGet('search'),
            'status' => $this->request->getGet('status'),
        ];

        $result = $this->bannerModel->adminList($filters, 20);

        return $this->render('admin/banners/index', [
            'pageTitle' => 'Home Banners',
            'banners'   => $result['banners'],
            'pager'     => $result['pager'],
            'filters'   => $filters,
        ]);
    }

    public function create()
    {
        return $this->render('admin/banners/form', [
            'pageTitle' => 'Add Home Banner',
            'banner'    => null,
        ]);
    }

    public function store()
    {
        return $this->saveBanner();
    }

    public function edit(int $id)
    {
        $banner = $this->bannerModel->find($id);

        if (! $banner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('admin/banners/form', [
            'pageTitle' => 'Edit Home Banner',
            'banner'    => $banner,
        ]);
    }

    public function update(int $id)
    {
        return $this->saveBanner($id);
    }

    public function view(int $id)
    {
        $banner = $this->bannerModel->find($id);

        if (! $banner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('admin/banners/view', [
            'pageTitle' => 'View Home Banner',
            'banner'    => $banner,
        ]);
    }

    public function delete(int $id)
    {
        $banner = $this->bannerModel->find($id);

        if (! $banner) {
            return $this->jsonResponse(['success' => false, 'message' => 'Banner not found.'], 404);
        }

        $this->imageUpload->delete($banner['image']);
        $this->bannerModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->jsonResponse(['success' => true, 'message' => 'Banner deleted successfully.']);
        }

        return redirect()->to('/admin/banners')->with('success', 'Banner deleted successfully.');
    }

    protected function saveBanner(?int $id = null)
    {
        $rules = [
            'title'  => 'required|min_length[2]|max_length[255]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'badge'                 => $this->request->getPost('badge'),
            'title'                 => $this->request->getPost('title'),
            'description'           => $this->request->getPost('description'),
            'button_text'           => $this->request->getPost('button_text'),
            'button_url'            => $this->request->getPost('button_url'),
            'secondary_button_text' => $this->request->getPost('secondary_button_text'),
            'secondary_button_url'  => $this->request->getPost('secondary_button_url'),
            'sort_order'            => (int) $this->request->getPost('sort_order'),
            'status'                => $this->request->getPost('status'),
        ];

        $file = $this->request->getFile('image');

        if ($file && $file->isValid()) {
            $upload = $this->imageUpload->upload($file, 'banners');

            if (! $upload['success']) {
                return redirect()->back()->withInput()->with('error', $upload['message']);
            }

            if ($id) {
                $existing = $this->bannerModel->find($id);
                $this->imageUpload->delete($existing['image'] ?? null);
            }

            $data['image'] = $upload['filename'];
        }

        if ($id) {
            $this->bannerModel->update($id, $data);
            $message = 'Home banner updated successfully.';
        } else {
            $this->bannerModel->insert($data);
            $message = 'Home banner created successfully.';
        }

        return redirect()->to('/admin/banners')->with('success', $message);
    }
}
