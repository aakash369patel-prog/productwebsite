<?php

namespace App\Controllers\Admin;

abstract class AdminBaseController extends \App\Controllers\BaseController
{
    protected function render(string $view, array $data = []): string
    {
        $data['adminUser'] = admin_user();
        $data['pageTitle'] = $data['pageTitle'] ?? 'Admin Panel';

        return view('admin/layout/header', $data)
            . view('admin/layout/sidebar', $data)
            . view($view, $data)
            . view('admin/layout/footer', $data);
    }

    protected function jsonResponse(array $data, int $status = 200)
    {
        return $this->response->setStatusCode($status)->setJSON($data);
    }
}
