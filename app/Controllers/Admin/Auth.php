<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

class Auth extends AdminBaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            return $this->attemptLogin();
        }

        return view('admin/auth/login', [
            'pageTitle' => 'Admin Login',
        ]);
    }

    protected function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = model(UserModel::class);
        $user      = $userModel->verifyLogin(
            $this->request->getPost('email'),
            $this->request->getPost('password')
        );

        if (! $user) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        session()->set([
            'admin_logged_in'    => true,
            'admin_user'         => [
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
            ],
            'admin_last_activity'=> time(),
        ]);

        return redirect()->to('/admin/dashboard')->with('success', 'Welcome back, ' . $user['name'] . '!');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/admin/login')->with('success', 'You have been logged out successfully.');
    }
}
