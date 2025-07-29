<?php

namespace App\Controllers;

use App\Models\list_pengajuan_model;

class List_pengajuan extends BaseController
{

    protected $model; // Deklarasikan property

    public function __construct()
    {
        // Inisialisasi model di constructor
        $this->model = new list_pengajuan_model();
    }

    public function index()
    {
        $model = new list_pengajuan_model();
        $data['mutasi'] = $model->getJoin(); // ambil semua data dgn join
        return view('list_pengajuan', $data);
    }

    // public function autocomplete()
    //    {
    //    $term = $this->request->getGet('term');

    //    $model = new App\Models\list_pengajuan_model();
    //    $results = $model->like('namalengkap', $term)->select('namalengkap')->findAll(10);

    //    $suggestions = [];
    //    foreach ($results as $row) {
    //        $suggestions[] = ['label' => $row['namalengkap']];
    //    }

    //    return $this->response->setJSON($suggestions);
    //   }

    public function create(): string
    {
        $data = [
            'title' => 'Form Pengajuan Mutasisssss',
            // 'validation' => \Config\Services::validation(),
            'pegawai' => null // Inisialisasi pegawai sebagai null
        ];
        return view(name: 'find_data_pegawai', data: $data);
    }

    public function store()
    {
        $list_pengajuan_model = new list_pengajuan_model();
        $rules = [
            'nip' => 'required|max_length[21]',
            // 'namalengkap' => 'required|max_length[255]',
            // 'kodeunker' => 'required|max_length[8]',
            // 'pnskodegol' => 'required|max_length[2]',
            'alasan' => 'required|max_length[150]',
            // 'jabatan_lama' => 'max_length[255]',
            // 'jabatan_baru' => 'max_length[255]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataPeg = $list_pengajuan_model->getPegawai($this->request->getPost('nip'));
        
        // Dapatkan data dari form
        $data = [
            'nip' => $this->request->getPost('nip'),
            'namalengkap' => ($dataPeg->namalengkap ?? ''),
            'kodeunker' => ($dataPeg->kodeunker ?? ''),
            'golakhirkodegol' => ($dataPeg->golakhirkodegol ?? ''),
            'jabakhirnama' => ($dataPeg->jabakhirnama ?? ''),
            // 'jabatan_lama' => $this->request->getPost('jabatan_lama'),
            // 'jabatan_baru' => $this->request->getPost('jabatan_baru'),
            'alasan' => $this->request->getPost('alasan'),
            'input_by_id' => session()->get('user_id') // Sesuaikan dengan session user Anda
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/list_pengajuan')->with('message', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
    }

    //fitur search
    public function suggestion() 
    {
        $keyword = $this->request->getGet('query');
        $kodeunker_utama = session()->get('kodeunker'); // 2 digit dari user login

        $list_pengajuan_model = new list_pengajuan_model();
        $data = $list_pengajuan_model->searchPegawai($keyword, $kodeunker_utama);

        $suggestions = [];
        foreach ($data as $item) {  
            $suggestions[] = [
                'label' => $item['nip'] . ' - ' . $item['namalengkap'] . '(' . $item['kodeunker']. ')' . ' - ' . $item['kodeaktif'] . ' - ' . $item['kodestatusASN'],
                'value' => $item['nip'],
            ];
        }

        return $this->response->setJSON($suggestions);
        
    }

    // Form get data pegawai
    public function getdatapegawai()
    {
        $keyword = $this->request->getGet('search_pegawai');
        // dd($keyword);
        // echo "Keyword: " . $keyword;
        $list_pengajuan_model = new list_pengajuan_model();
        $explodedKeyword = explode(' - ', $keyword);
        $nip = trim($explodedKeyword[0]); // Ambil NIP dari input
        $data = [
            'title' => 'form Data Pegawai',
            // 'validation' => \Config\Services::validation(),
            'pegawai' => $list_pengajuan_model->getPegawai($nip)
        ];

        return view('form_pengajuan', $data);
    }

}
