<?php

// app/Filters/RoleFilter.php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if(!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        // Ubah ini dari 'role' menjadi 'type_user'
        $userRole = $session->get('type_user');
        
        if(!in_array($userRole, $arguments)) {
            return redirect()->to('/')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request
    }
}