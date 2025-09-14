<?php

namespace App\Models;

use CodeIgniter\Model;

class list_users_model extends Model
{
    protected $table = 'z_mutasi_user';
    protected $primaryKey = 'id'; // ganti sesuai kolom PK
    // protected $allowedFields = ['id', 'type_user', 'nip', 'password', 'nama', 'kodeunker_utama', 'email', 'status', 'input_by', 'input_date']; // sesuaikan
    protected $allowedFields = ['nip', 'nama', 'email', 'password', 'status', 'status_login', 'kodeunker_utama', 'type_user', 'input_by', 'input_date', 'last_login']; // sesuaikan
    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = ['hashPassword'];
    // protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        // Jika password tidak diset, buat dari NIP
        if (!isset($data['data']['password']) && isset($data['data']['nip'])) {
            $data['data']['password'] = $this->generateDefaultPassword($data['data']['nip']);
        }
        // Jika password diset (baik manual maupun dari NIP), hash password
        elseif (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    /**
     * Generate password default dari NIP
     */
    public function generateDefaultPassword($nip)
    {
        // Enkripsi NIP dengan metode yang lebih kuat dari md5
        // Bisa menggunakan enkripsi hash_hmac dengan secret key aplikasi
        $secretKey = env('encryption.key'); // Ambil dari .env
        
        // Gabungkan dengan salt atau pepper untuk keamanan tambahan
        $pepper = 'YourAppPepperString'; // Ganti dengan string unik aplikasi Anda
        
        // Hash dengan algoritma yang lebih aman
        $hashed = hash_hmac('sha256', $nip . $pepper, $secretKey);
        
        // Ambil 12 karakter pertama sebagai password default
        return substr($hashed, 0, 12);
    }

    public function getUserByNip($nip)
    {
        return $this->where('nip', $nip)->first();
    }

    public function updateStatusLogin($id, $status)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta
        // Update status login dan last login
        return $this->update($id, ['status_login' => $status, 'last_login' => date('Y-m-d H:i:s')]);
    }

    // Tambahkan method untuk create user
    public function createUser($data)
    {
        // Set nilai default
        $data['status'] = $data['status'] ?? 1; // Default aktif
        $data['status_login'] = 0; // Default belum login
        $data['input_date'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }

    public function getJoinUnker()
    {
        return $this->select('z_mutasi_user.*, Peg_UnkerUtama.*')
            ->join('Peg_UnkerUtama', 'Peg_UnkerUtama.kodeunkerutama = z_mutasi_user.kodeunker_utama')
            ->findAll();
    }

    public function getAllTypeUser()
    {
        return $this->db->table('z_mutasi_type_user')->get()->getResultArray();
    }

    public function getAllUnkerUtama()
    {
        return $this->db->table('Peg_UnkerUtama')
            ->where('aktif', 1)
            ->orderBy('namaunkerutamabesar','ASC')
            ->get()->getResultArray();
    }

    // Get user by ID
    public function getUserById($id)
    {
        $builder = $this->db->table('z_mutasi_user u');
        $builder->select('u.*, tu.type_user as type_user_name, unker.namaunkerutamabesar as namaunkerutamabesar');
        $builder->join('z_mutasi_type_user tu', 'u.type_user = tu.id', 'left');
        $builder->join('Peg_UnkerUtama unker', 'u.kodeunker_utama = unker.kodeunkerutama', 'left');
        $builder->where('u.id', $id);
        
        $query = $builder->get();
        return $query->getRow();
    }

}
