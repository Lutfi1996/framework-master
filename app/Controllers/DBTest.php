<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class DBTest extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();

            // Tes query ke SQL Server
            $query = $db->query("SELECT name FROM sys.databases");
            $results = $query->getResult();

            echo "<h3>✅ Koneksi ke SQL Server Berhasil!</h3>";
            echo "<strong>Daftar Database:</strong><br>";
            foreach ($results as $row) {
                echo "- " . $row->name . "<br>";
            }
        } catch (\Exception $e) {
            echo "<h3>❌ Gagal koneksi ke SQL Server</h3>";
            echo "Error: " . $e->getMessage();
        }
    }
}
