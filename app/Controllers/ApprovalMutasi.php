<?php

namespace App\Controllers;

use App\Models\list_pengajuan_model;
use App\Models\mutasi_file_model;

class ApprovalMutasi extends BaseController
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
        $perPage = 10; // Jumlah data per halaman
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $start_date = $this->request->getGet('start_date') ?? date('Y-m-01');
        $end_date = $this->request->getGet('end_date') ?? date('Y-m-t');

        $dataMutasi = $this->model->getJoinOutstanding($perPage, $start_date, $end_date); // ambil semua data dgn join 

        // Pastikan hanya admin BKPSDM yang bisa akses
        if (session()->get('type_user') != 1 && session()->get('type_user') != 2) {
            return redirect()->to('/');
        }
        //$data['mutasi'] = $model->getJoin(); // ambil semua data dgn join
        $data = [
            'title' => 'Approval Pengajuan Mutasi',
            'mutasi' => $dataMutasi, // ambil semua data dgn join
            'pager' => $this->model->pager,
            'currentPage' => $currentPage,
            'start_date' => $start_date,
            'end_date' => $end_date,
            // 'keyword' => $keyword
        ];
        
        return view('approval_mutasi/index', $data);
    }
    
    public function view($id)
    {
        $pengajuan = $this->model->find($id);
        
        if (!$pengajuan) {
            return redirect()->to('/approval-mutasi')->with('error', 'Data pengajuan tidak ditemukan');
        }

        // $list_pengajuan_model = new list_pengajuan_model();
        // $explodedKeyword = explode(' - ', $keyword);
        $nip = $pengajuan['nip'];
        // $data = [
        //     'title' => 'form Data Pegawai',
        //     // 'validation' => \Config\Services::validation(),
        // ];

        //$this->fileModel->where('id_pengajuan', $id);
        $files = $this->fileModel->getFilesByPengajuan($id);

        // Cara 1: Query Builder
        $db = db_connect();
        $unker1 = $db->table('Peg_Unker')
                            ->select('unker1')
                            ->distinct()
                            ->get()
                            ->getResultArray();
        
        $data = [
            'title' => 'Detail Pengajuan Mutasi',
            'pengajuan' => $pengajuan,
            'pegawai' =>$this->model->getPegawai($nip),
            'defaultDinas' => $pengajuan['unker1_baru'],
            'defaultBidang' => $pengajuan['unker2_baru'],
            'defaultSubBidang' => $pengajuan['unker3_baru'],
            'filepdf'=> $files,
            'unker1' => $unker1,
        ];
        
        return view('approval_mutasi/view', $data);
    }

    public function actionApproval($id)
    {
        $approverId = session()->get('id'); // ID admin yang melakukan approval
        $action = $this->request->getPost('action'); // Ambil nilai action dari form

        if ($action === 'approve') {
            $status = 1; // Status untuk approve
            $message = 'Pengajuan berhasil disetujui';
        } elseif ($action === 'reject') {
            $status = 4; // Status untuk reject
            $message = 'Pengajuan berhasil ditolak';
        } else {
            return redirect()->to('/approval-mutasi')->with('error', 'Aksi tidak valid');
        }


        // ambil data kode unker tujuan
        $db = db_connect();
        $builder = $db->table('Peg_Unker');
        $query = $builder->select('kodeunker')
                        ->where('unker1', $this->request->getPost('tujuanunker1'))
                        ->where('unker2', $this->request->getPost('bidangunker2'))
                        ->where('unker3', $this->request->getPost('subbidangunker3'))
                        ->get();
        $result = $query->getRow();
        $kodeUnkerBaru = '';
        if ($result) {
            $kodeUnkerBaru = $result->kodeunker;
        } 
        $jabakhirnama_baru = $this->request->getPost('tujuanjabatan');
        $unker1_baru = $this->request->getPost('tujuanunker1');
        $unker2_baru = $this->request->getPost('bidangunker2');
        $unker3_baru = $this->request->getPost('subbidangunker3');

        if ($this->model->processApproval($id, $approverId, $status, 
            $unker1_baru, $unker2_baru, $unker3_baru, $kodeUnkerBaru, $jabakhirnama_baru)) {
            $this->fileModel->processApprovalFile($id, $approverId, $status);
            return redirect()->to('/approval-mutasi')->with('message', $message);
        } else {
            return redirect()->to('/approval-mutasi')->with('error', 'Gagal memproses pengajuan');
        }
    }
    
    /*ini tidak jadi, jadinya pake form post
    public function approve($id)    
    {
        $approverId = session()->get('id'); // ID admin yang melakukan approval
        
        if ($this->model->processApproval($id, $approverId, 1)) {
            $this->fileModel->processApprovalFile($id, $approverId, 1);
            return redirect()->to('/approval-mutasi')->with('message', 'Pengajuan berhasil disetujui');
        } else {
            return redirect()->to('/approval-mutasi')->with('error', 'Gagal menyetujui pengajuan');
        }
    }
    
    public function reject($id)
    {
        $approverId = session()->get('id'); // ID admin yang melakukan approval
        
        if ($this->model->processApproval($id, $approverId, 4)) {
            $this->fileModel->processApprovalFile($id, $approverId, 4);
            return redirect()->to('/approval-mutasi')->with('message', 'Pengajuan berhasil ditolak');
        } else {
            return redirect()->to('/approval-mutasi')->with('error', 'Gagal menolak pengajuan');
        }
    }
    */
    
    public function viewPdf($id)
    {
        $fileData = $this->fileModel->find($id);
        $filepath = WRITEPATH  . $fileData['file_path'] . '/'. $fileData['file_name'];

        // Cek apakah file ada
        if (!file_exists($filepath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $mime = mime_content_type($filepath);
        header('Content-Type: ' . $mime);
        header('Content-Disposition: inline; filename="' . $fileData['file_name'] . '"');
        readfile($filepath);
        exit();
    }
}