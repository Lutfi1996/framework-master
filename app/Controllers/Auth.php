<?php

namespace App\Controllers;

use App\Models\list_users_model;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $list_users_model;
    protected $session;

    public function __construct()
    {
        $this->list_users_model = new list_users_model();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    public function attemptLogin()
    {
        $rules = [
            'nip'      => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');

        $user = $this->list_users_model->getUserByNip($nip);

        if (!$user || $user['status'] != 1) {
            return redirect()->back()->withInput()->with('error', 'NIP atau password salah atau akun tidak aktif');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'NIP atau password salah');
        }

        // Update status login
        $this->list_users_model->updateStatusLogin($user['id'], 1);

        // Set session
        $sessionData = [
            'userId'        => $user['id'],
            'nip'           => $user['nip'],
            'nama'         => $user['nama'],
            'email'        => $user['email'],
            'kodeunker'    => $user['kodeunker_utama'],
            'type_user'     => $user['type_user'],
            'isLoggedIn'   => true,
        ];

        $this->session->set($sessionData);

        return redirect()->to('/')->with('success', 'Login berhasil');
    }

    public function logout()
    {
        if ($this->session->get('isLoggedIn')) {
            // Update status login
            $this->list_users_model->updateStatusLogin($this->session->get('userId'), 0);
            
            // Destroy session
            $this->session->destroy();
        }

        return redirect()->to('/login');
    }
}