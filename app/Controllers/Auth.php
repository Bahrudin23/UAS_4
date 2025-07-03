<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        $session->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $userModel = new UserModel();

        $rules = [
            'name'      => 'required',
            'username'  => 'required|is_unique[users.username]',
            'password'  => 'required|min_length[4]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/]',
            'confirm_password' => 'matches[password]',
            'whatsapp'  => 'required|regex_match[/^0\d{11,12}$/]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->save([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'whatsapp' => $this->request->getPost('whatsapp'),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
