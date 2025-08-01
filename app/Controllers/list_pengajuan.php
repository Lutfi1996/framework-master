<?php

namespace App\Controllers;

use App\Models\list_pengajuan_model;
use App\Models\mutasi_file_model;

class List_pengajuan extends BaseController
{

    protected $model; // Deklarasikan property
    protected $fileModel; // Model untuk file

    public function __construct()
    {
        // Inisialisasi model di constructor
        $this->model = new list_pengajuan_model();
        $this->fileModel = new mutasi_file_model();
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
            'title' => 'Form Pengajuan Mutasi',
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


        // Validasi untuk semua file
        $validationRules = [
            'inputSK' => [
                'label' => 'File SK',
                'rules' => 'uploaded[inputSK]|max_size[inputSK,2048]|ext_in[inputSK,pdf]|mime_in[inputSK,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diupload',
                    'max_size' => '{field} maksimal 2MB',
                    'ext_in' => '{field} harus berupa PDF',
                    'mime_in' => '{field} harus berupa PDF'
                ]
            ],
            'inputSKKP' => [
                'label' => 'File SKKP',
                'rules' => 'uploaded[inputSKKP]|max_size[inputSKKP,2048]|ext_in[inputSKKP,pdf]|mime_in[inputSKKP,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diupload',
                    'max_size' => '{field} maksimal 2MB',
                    'ext_in' => '{field} harus berupa PDF',
                    'mime_in' => '{field} harus berupa PDF'
                ]
            ],
            'inputSKP1' => [
                'label' => 'File SKP 1',
                'rules' => 'uploaded[inputSKP1]|max_size[inputSKP1,2048]|ext_in[inputSKP1,pdf]|mime_in[inputSKP1,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diupload',
                    'max_size' => '{field} maksimal 2MB',
                    'ext_in' => '{field} harus berupa PDF',
                    'mime_in' => '{field} harus berupa PDF'
                ]
            ],
            'inputSKP2' => [
                'label' => 'File SKP 2',
                'rules' => 'uploaded[inputSKP2]|max_size[inputSKP2,2048]|ext_in[inputSKP2,pdf]|mime_in[inputSKP2,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diupload',
                    'max_size' => '{field} maksimal 2MB',
                    'ext_in' => '{field} harus berupa PDF',
                    'mime_in' => '{field} harus berupa PDF'
                ]
            ],
            'suratopd' => [
                'label' => 'Surat OPD',
                'rules' => 'uploaded[suratopd]|max_size[suratopd,2048]|ext_in[suratopd,pdf]|mime_in[suratopd,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diupload',
                    'max_size' => '{field} maksimal 2MB',
                    'ext_in' => '{field} harus berupa PDF',
                    'mime_in' => '{field} harus berupa PDF'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
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
            'input_by_id' => session()->get('userId') // Sesuaikan dengan session user Anda
        ];
        
        if ($this->model->insert($data)) {

            // Ambil ID terakhir
            $lastInsertID = $this->model->getInsertID(); // Menggunakan method model
            $kodeNip = $this->request->getPost('nip');
            // Proses upload masing-masing file
            $uploadedFiles = [];
            // $fileFields = ['inputSK', 'inputSKKP', 'inputSKP1', 'inputSKP2', 'suratopd'];
            // Mapping field ke folder tujuan
            $folderMapping = [
                'inputSK' => 'sk',
                'inputSKKP' => 'skkp',
                'inputSKP1' => 'skp1',
                'inputSKP2' => 'skp2',
                'suratopd' => 'opd'
            ];

            // foreach ($fileFields as $field) {
            foreach ($folderMapping as $field => $folder) {
                $file = $this->request->getFile($field);
                // Cek apakah file valid dan belum dipindahkan
                if ($file->isValid() && !$file->hasMoved()) {
                    // Buat folder jika belum ada
                    $uploadPath = WRITEPATH . 'uploads/' . $folder . '/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }

                    // Format nama file
                    $newName = sprintf(
                        "%d-%s-%s-%s-%s.%s",
                        $lastInsertID,
                        $kodeNip,
                        $field,
                        date('Ymd-His'),
                        bin2hex(random_bytes(3)),
                        $file->getClientExtension()
                    );

                    // Pindahkan file ke folder khusus
                    $file->move($uploadPath, $newName);
                    $uploadedFiles[$field] = $folder . '/' . $newName;

                    $idPengajuan = $lastInsertID; // Simpan ID pengajuan untuk digunakan nanti
                    // Simpan ke database
                    $this->saveFileRecord([
                        'id_pengajuan' => $idPengajuan,
                        'type_file' => $field,
                        'file_name' => $newName,
                        'file_path' => 'uploads/' . $folder . '/',
                        'status_file' => 0 // Status file 0 untuk open
                    ]);
                }
            }

            return redirect()->to('/list_pengajuan')->with('message', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
    }

    // Simpan data file ke database
    protected function saveFileRecord($data)
    {
        // $this->model->insert($data)
        $builder = $this->fileModel->table('z_mutasi_pengajuan_files');
        $builder->insert($data);
        return $this->fileModel->insertID();
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
