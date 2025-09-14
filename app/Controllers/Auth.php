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

    public function change_password()
    {
        $data = [];
        return view('change_password', $data);
    }

    public function update_password()
    {
        // Validasi input
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/ubah-password')->withInput()->with('validation', $this->validator);
        }

        // Ambil data dari form
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        // Dapatkan data user yang sedang login
        // Ganti dengan cara Anda menyimpan user_id di session
        $user_id = session()->get('userId');
        
        if (!$user_id) {
            return redirect()->to('/ubah-password')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }
        
        // Dapatkan user dari database - gunakan method find dengan select explicit
        $user = $this->list_users_model->select('id, nip, nama, password, status')->find($user_id);
        
        // Debug: Tampilkan struktur data user (untuk troubleshooting)
        // echo "<pre>"; print_r($user); echo "</pre>"; die();
        
        // Periksa apakah user ditemukan
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan '.$user['nama'].' ');
            return redirect()->to('/ubah-password')->with('error', 'User tidak ditemukan');
        }

        
        // Verifikasi password saat ini
        if (!password_verify($current_password, $user['password'])) {
            return redirect()->to('/ubah-password')->with('error', 'Password saat ini salah');
        }

        // Periksa kecocokan konfirmasi password
        if( $new_password != $confirm_password ) {
            // session()->setFlashdata('error', 'Konfirmasi password tidak sesuai');
            return redirect()->to('/ubah-password')->with('error', 'Konfirmasi password tidak sesuai');
        }
        
        // Update password baru
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $this->list_users_model->update($user_id, ['password' => $hashed_password]);
        // session()->setFlashdata('success', 'Password berhasil diubah');
        return redirect()->to('/ubah-password')->with('success', 'Password berhasil diubah ');
    }

    // Method untuk debugging - tampilkan data user
    public function debug_user($id = null)
    {
        if (!$id) {
            $id = session()->get('userId');
        }
        
        $user = $this->list_users_model->find($id);
        echo "<pre>";
        print_r($user);
        echo "</pre>";
        echo "<pre>";
        print_r(session()->get('kodeunker')); 
         echo "</pre>";
        // Cek juga session
        echo "<h3>Session Data:</h3>";
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }
}