<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view(name: 'dashboard');
    }
    public function form_pengajuan(): string
    {
        return view(name: 'form_pengajuan');
    }
    public function list_pengajuan(): string
    {
        return view(name: 'list_pengajuan');
    }
}

?>

