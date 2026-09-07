<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Please login to continue.');
        }

        $lastActivity = session()->get('admin_last_activity');

        if ($lastActivity && (time() - $lastActivity) > 7200) {
            session()->destroy();

            return redirect()->to('/admin/login')->with('error', 'Session expired. Please login again.');
        }

        session()->set('admin_last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
