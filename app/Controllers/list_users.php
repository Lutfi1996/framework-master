<?php

namespace App\Controllers;

use App\Models\list_users_model;

class List_users extends BaseController
{

    protected $list_users_model;
    protected $session;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->list_users_model = new list_users_model();
        $this->session = \Config\Services::session();
        
        // Proteksi halaman
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        // Tambahkan pengecekan role jika diperlukan
        // if ($this->session->get('type_user') != 1) {
        //     throw new PageNotFoundException();
        // }
    }

    public function index()
    {
        $model = new list_users_model();
        $data['user_list'] = $model->getJoinUnker(); // ambil semua data
        return view('setting_users', $data);
    }

    // Method to handle user creation
    // public function create()
    // {
    //     return view('create_user'); // Assuming you have a view for creating users
    // }

    public function create()
    {
        $modelType = new list_users_model();
        $typeUsersData = $modelType->getAllTypeUser();
        $dinaslist = $modelType->getAllUnkerUtama();


        return view('create_user', [
            'typeUsers' => $typeUsersData,
            'dinaslist' => $dinaslist,
            'session' => $this->session,
            'title' => 'Tambah User Baru',
        ]);
    }

    public function store()
    {
        // Validasi input
        $rules = [
            'nip' => 'required|max_length[21]|is_unique[z_mutasi_user.nip]',
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email|max_length[100]',
            'password' => 'permit_empty|min_length[8]',
            'kodeunker_utama' => 'required|max_length[8]',
            'type_user' => 'required|numeric',
            'status' => 'permit_empty|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Logic to handle form submission and user creation
        // This would typically involve validating input, saving to the database, etc.
        // For now, we can just redirect back to the user list or show a success message.
        $input_user =  new list_users_model();
        $data = [
            'type_user' => $this->request->getPost('type_user'),
            'nip' => $this->request->getPost('nip'),
            'nama' => $this->request->getPost('nama'),
            'kodeunker_utama' => $this->request->getPost('kodeunker_utama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('nip'), PASSWORD_DEFAULT), // Use NIP as default password
            'input_by' => 1, // Assuming you have
            'status_login' => 0, // Assuming status_login is 0 for new users
            'status' => 1, // Assuming status is active by default
            // 'input_by' => session()->get('id'), // Assuming you have a user session
            date_default_timezone_set('Asia/Jakarta'), // Set timezone to Jakarta
            'input_date' => date('Y-m-d H:i:s') // Current timestamp 
        ];
        $input_user->insert($data);
        return redirect()->to('/setting_users');
        

        // // Dapatkan ID user yang sedang login
        // $currentUserId = $this->session->get('userId');
        
        // if (empty($currentUserId)) {
        //     return redirect()->back()->withInput()->with('error', 'Anda harus login untuk membuat user');
        // }

        // // Prepare data
        // $data = [
        //     'nip' => $this->request->getPost('nip'),
        //     'nama' => $this->request->getPost('nama'),
        //     'email' => $this->request->getPost('email'),
        //     'kodeunker_utama' => $this->request->getPost('kodeunker_utama'),
        //     'type_user' => $this->request->getPost('type_user'),
        //     'status' => $this->request->getPost('status') ?? 1,
        //     'input_by' => $currentUserId, // Pastikan ini diisi
        //     date_default_timezone_set('Asia/Jakarta'), // Set timezone to Jakarta
        //     'input_date' => date('Y-m-d H:i:s') // Tambahkan ini juga
        // ];

        // // Jika password diisi, gunakan yang diinput
        // if (!empty($this->request->getPost('password'))) {
        //     $data['password'] = $this->request->getPost('password');
        // }

        // // Simpan user
        // if ($this->list_users_model->createUser($data)) {
        //     return redirect()->to('/setting_users')->with('message', 'User berhasil ditambahkan');
        // } else {
        //     return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
        // }
    }
}