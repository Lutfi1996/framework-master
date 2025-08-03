<?php

namespace App\Models;

use CodeIgniter\Model;

class list_pengajuan_model extends Model
{
    protected $table = 'z_mutasi_pengajuan';
    protected $primaryKey = 'id'; // ganti sesuai kolom PK

    // protected $allowedFields = ['nip', 'namalengkap', 'kodeunker', 'pnskodegol', 'jabatan_lama', 
    // 'jabatan_baru', 'alasan']; // sesuaikan

    protected $allowedFields = [
        'nip', 
        'namalengkap', 
        'kodeunker', 
        'golakhirkodegol', 
        'jabakhirnama',
        // 'jabatan_lama', 
        // 'jabatan_baru', 
        'alasan',
        'input_by_id',
        'input_date',
        'update_by_id',
        'update_date',
        'status_pengajuan'
    ];
    
    protected $useAutoIncrement = true;
    
    protected $useTimestamps = false;
    
    protected $beforeInsert = ['setInsertData'];
    protected $beforeUpdate = ['setUpdateData'];

    public function getJoin()
    {
        return $this->select('z_mutasi_pengajuan.*, Peg_Unker.unker1')
            ->join('Peg_unker', 'Peg_unker.kodeunker = z_mutasi_pengajuan.kodeunker')
            ->findAll();
    }

    protected function setInsertData(array $data)
    {
        // if (isset($data['data'])) {
        //     $data['data']['input_date'] = date('Y-m-d H:i:s');
        //     // Anda bisa menambahkan input_by_id dari session user yang login
        //     // $data['data']['input_by_id'] = user_id();
        // }
        // return $data;
        if (!isset($data['data']['input_by_id'])) {
            $userId = session()->get('user_id');
            
            if (empty($userId)) {
                // Log warning jika tidak ada user id
                log_message('warning', 'Attempting to insert record without user_id');
                $userId = 0; // atau throw exception
            }
            
            $data['data']['input_by_id'] = $userId;
        }
        
        if (!isset($data['data']['input_date'])) {
            $data['data']['input_date'] = date('Y-m-d H:i:s');
        }
        
        return $data;
    }
    
    protected function setUpdateData(array $data)
    {
        if (isset($data['data'])) {
            $data['data']['update_date'] = date('Y-m-d H:i:s');
            // $data['data']['update_by_id'] = user_id();
        }
        return $data;
    }

    public function searchPegawai($keyword, $kodeunker_utama)
    {
        // Menggunakan kodeunker_utama untuk filter
        return $this->db->table('Peg_Pegawai')
            ->select('nip, namalengkap, kodeunker, kodeaktif, kodestatusASN')
            // ->where('left(kodeunker_utama,2)', $kodeunker_utama) // Filter berdasarkan kodeunker_utama
            ->like('kodeunker', $kodeunker_utama, 'after') // cocokan prefix 2 digit
            ->where('kodeaktif',1) // hanya yang aktif
            ->where('kodestatusASN', 1) // hanya yang ASN
            ->groupStart()
                ->like('nip', $keyword)
                ->orLike('namalengkap', $keyword)
            ->groupEnd()
            ->limit(10) // Batasi hasil pencarian
            ->get()
            ->getResultArray();
    }

    public function getPegawai($id)
    {
        // return $this->where(['nip' => $id])->first();
        return $this->db->table('Peg_Pegawai')
            ->join('Peg_unker', 'Peg_unker.kodeunker = Peg_Pegawai.kodeunker')
            ->join('Peg_Golongan', 'Peg_Golongan.kodegol = Peg_Pegawai.golakhirkodegol')
            ->select('Peg_Pegawai.nip, Peg_Pegawai.namalengkap, Peg_Pegawai.kodeunker, Peg_Pegawai.golakhirkodegol,
             Peg_Pegawai.kodeaktif, Peg_Pegawai.kodestatusASN, Peg_Pegawai.jabakhirnama,
             Peg_unker.unker1, Peg_unker.unker2, Peg_unker.unker3,
             Peg_Golongan.pangkatgol')
            ->where('Peg_Pegawai.nip', $id)
            ->get()
            ->getRow();
    }

    // Untuk menyimpan approval
    public function processApproval($id, $approverId, $status)
    {
        $data = [
            'status_pengajuan' => $status,
            'update_date' => date('Y-m-d H:i:s'),
            'update_by_id' => $approverId
        ];
        
        return $this->update($id, $data);
    }

}

