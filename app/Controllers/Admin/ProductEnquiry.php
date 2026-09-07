<?php

namespace App\Controllers\Admin;

use App\Models\ProductEnquiryModel;
use App\Models\ProductModel;

class ProductEnquiry extends AdminBaseController
{
    protected ProductEnquiryModel $enquiryModel;

    public function __construct()
    {
        $this->enquiryModel = model(ProductEnquiryModel::class);
    }

    public function index()
    {
        $filters = [
            'search'     => $this->request->getGet('search'),
            'status'     => $this->request->getGet('status'),
            'product_id' => $this->request->getGet('product_id'),
            'date_from'  => $this->request->getGet('date_from'),
            'date_to'    => $this->request->getGet('date_to'),
        ];

        $result = $this->enquiryModel->adminList($filters, 20);

        return $this->render('admin/enquiries/index', [
            'pageTitle' => 'Product Enquiries',
            'enquiries' => $result['enquiries'],
            'pager'     => $result['pager'],
            'filters'   => $filters,
            'products'  => model(ProductModel::class)->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function view(int $id)
    {
        $enquiry = $this->enquiryModel->getWithProduct($id);

        if (! $enquiry) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($enquiry['status'] === 'new') {
            $this->enquiryModel->update($id, ['status' => 'read']);
            $enquiry['status'] = 'read';
        }

        return $this->render('admin/enquiries/view', [
            'pageTitle' => 'View Enquiry #' . $id,
            'enquiry'   => $enquiry,
        ]);
    }

    public function updateStatus(int $id)
    {
        $enquiry = $this->enquiryModel->find($id);

        if (! $enquiry) {
            return $this->jsonResponse(['success' => false, 'message' => 'Enquiry not found.'], 404);
        }

        $status = $this->request->getPost('status');

        if (! in_array($status, ['new', 'read', 'replied', 'closed'], true)) {
            return $this->jsonResponse(['success' => false, 'message' => 'Invalid status.'], 422);
        }

        $this->enquiryModel->update($id, ['status' => $status]);

        return $this->jsonResponse(['success' => true, 'message' => 'Status updated successfully.']);
    }

    public function delete(int $id)
    {
        $enquiry = $this->enquiryModel->find($id);

        if (! $enquiry) {
            return $this->jsonResponse(['success' => false, 'message' => 'Enquiry not found.'], 404);
        }

        $this->enquiryModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->jsonResponse(['success' => true, 'message' => 'Enquiry deleted successfully.']);
        }

        return redirect()->to('/admin/enquiries')->with('success', 'Enquiry deleted successfully.');
    }
}
