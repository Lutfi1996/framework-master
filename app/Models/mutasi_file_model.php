<?php 

namespace App\Models;

use CodeIgniter\Model;

class mutasi_file_model extends Model
{
    protected $table = 'z_mutasi_pengajuan_files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pengajuan', 'type_file', 'file_name', 'status_file', 'file_path'];
    protected $returnType = 'array';

    // Status file
    const STATUS_APPROVED = 1;
    const STATUS_OPEN = 0;
    const STATUS_REJECTED = 2;

    // Type file
    const TYPE_SK = 1;
    const TYPE_SKKP = 2;
    const TYPE_SKP1 = 3;
    const TYPE_SKP2 = 4;
    const TYPE_OPD = 5;

    public function getFilesByPengajuan($idPengajuan)
    {
        return $this->where('id_pengajuan', $idPengajuan)
                   ->findAll();
    }
}