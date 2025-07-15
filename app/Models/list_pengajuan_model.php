<?php

namespace App\Models;

use CodeIgniter\Model;

class list_pengajuan_model extends Model
{
    protected $table = 'mutasi_pengajuan';
    protected $primaryKey = 'id'; // ganti sesuai kolom PK

    protected $allowedFields = ['nip', 'namalengkap', 'kodeunker', 'pnskodegol', 'jabatan_lama', 'jabatan_baru', 'alasan']; // sesuaikan

    public function getJoin()
    {
        return $this->select('mutasi_pengajuan.*, Peg_Unker.unker1')
            ->join('Peg_unker', 'Peg_unker.kodeunker = mutasi_pengajuan.kodeunker')
            ->findAll();
    }
}

