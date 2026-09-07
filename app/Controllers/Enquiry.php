<?php

namespace App\Controllers;

use App\Models\ProductEnquiryModel;
use App\Models\ProductModel;

class Enquiry extends BaseController
{
    public function submit()
    {
        if (! $this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON(['success' => false, 'message' => 'Method not allowed.']);
        }

        $rules = [
            'product_id' => 'required|integer',
            'name'       => 'required|min_length[2]|max_length[150]',
            'email'      => 'required|valid_email',
            'phone'      => 'required|min_length[6]|max_length[30]',
            'message'    => 'required|min_length[10]',
            'company_name' => 'permit_empty|max_length[200]',
            'country'    => 'permit_empty|max_length[100]',
            'quantity'   => 'permit_empty|max_length[100]',
            'unit'       => 'permit_empty|max_length[50]',
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Please fix the validation errors.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $productModel  = model(ProductModel::class);
        $enquiryModel  = model(ProductEnquiryModel::class);
        $productId     = (int) $this->request->getPost('product_id');
        $product       = $productModel->find($productId);

        if (! $product || $product['status'] !== 'active') {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Please select a valid product.',
            ]);
        }

        $data = [
            'product_id'   => $productId,
            'name'         => $this->request->getPost('name'),
            'company_name' => $this->request->getPost('company_name'),
            'email'        => $this->request->getPost('email'),
            'phone'        => $this->request->getPost('phone'),
            'country'      => $this->request->getPost('country'),
            'quantity'     => $this->request->getPost('quantity'),
            'unit'         => $this->request->getPost('unit'),
            'message'      => $this->request->getPost('message'),
            'status'       => 'new',
        ];

        $enquiryModel->insert($data);

        $this->sendEmails($data, $product);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Thank you! Your enquiry has been submitted successfully. We will contact you shortly.',
        ]);
    }

    protected function sendEmails(array $enquiry, array $product): void
    {
        $email = \Config\Services::email();

        $emailData = [
            'enquiry' => $enquiry,
            'product' => $product,
        ];

        $adminEmail = env('email.adminEmail', env('email.fromEmail', 'admin@example.com'));

        try {
            $email->setTo($adminEmail);
            $email->setSubject('New Product Enquiry - ' . $product['name']);
            $email->setMessage(view('emails/admin_enquiry', $emailData));
            $email->send();

            $email->clear();

            if (env('email.sendCustomerConfirmation', true)) {
                $email->setTo($enquiry['email']);
                $email->setSubject('Enquiry Received - ' . site_name());
                $email->setMessage(view('emails/customer_enquiry', $emailData));
                $email->send();
            }
        } catch (\Throwable $e) {
            log_message('error', 'Enquiry email failed: ' . $e->getMessage());
        }
    }
}
