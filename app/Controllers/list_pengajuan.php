<?php

namespace App\Controllers;

use App\Models\list_pengajuan_model;

class List_pengajuan extends BaseController
{
    public function index()
    {
        $model = new list_pengajuan_model();
        $data['mutasi'] = $model->getJoin(); // ambil semua data dgn join
        return view('list_pengajuan', $data);
    }

    public function autocomplete()
        {
        $term = $this->request->getGet('term');

        $model = new App\Models\list_pengajuan_model();
        $results = $model->like('namalengkap', $term)->select('namalengkap')->findAll(10);

        $suggestions = [];
        foreach ($results as $row) {
            $suggestions[] = ['label' => $row['namalengkap']];
        }

        return $this->response->setJSON($suggestions);
    }

}
