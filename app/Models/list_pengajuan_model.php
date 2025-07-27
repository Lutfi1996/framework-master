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
        'pnskodegol', 
        'jabatan_lama', 
        'jabatan_baru', 
        'alasan',
        'input_by_id',
        'input_date',
        'update_by_id',
        'update_date'
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

    public function searchPegawai($keyword)
    {
        return $this->db->table('Peg_Pegawai')
            ->select('nip, namalengkap')
            ->like('nip', $keyword)
            ->orLike('namalengkap', $keyword)
            ->limit(5)
            ->get()
            ->getResultArray();
    }
}

