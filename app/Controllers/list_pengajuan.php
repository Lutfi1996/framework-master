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
        return view(name: 'form_pengajuan');
    }

    public function store()
    {
        $rules = [
            'nip' => 'required|max_length[21]',
            'namalengkap' => 'required|max_length[255]',
            'kodeunker' => 'required|max_length[8]',
            'pnskodegol' => 'required|max_length[2]',
            'alasan' => 'required|max_length[150]',
            'jabatan_lama' => 'max_length[255]',
            'jabatan_baru' => 'max_length[255]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Dapatkan data dari form
        $data = [
            'nip' => $this->request->getPost('nip'),
            'namalengkap' => $this->request->getPost('namalengkap'),
            'kodeunker' => $this->request->getPost('kodeunker'),
            'pnskodegol' => $this->request->getPost('pnskodegol'),
            'jabatan_lama' => $this->request->getPost('jabatan_lama'),
            'jabatan_baru' => $this->request->getPost('jabatan_baru'),
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
            $list_pengajuan_model = new list_pengajuan_model();
            $data = $list_pengajuan_model->searchPegawai($keyword);

            $suggestions = [];
            foreach ($data as $item) {  
                $suggestions[] = [
                    'label' => $item['nip'] . ' - ' . $item['namalengkap'],
                    'value' => $item['nip'],
                ];
            }

            return $this->response->setJSON($suggestions);
            
        }

}
