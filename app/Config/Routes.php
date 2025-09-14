<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/dbtest', 'DBTest::index');
$routes->get('/', 'Home::index', ['filter' => 'auth']);
// $routes->get('/form_pengajuan', 'list_pengajuan::create', ['filter' => 'role:3']);
// $routes->get('/form_pengajuan', 'list_pengajuan::create', ['filter' => 'role:3']);
$routes->get('/list_pengajuan', 'list_pengajuan::index', ['filter' => 'auth']);
$routes->get('/list_pengajuan/view/(:num)', 'list_pengajuan::view/$1', ['filter' => 'auth']);

$routes->get('getUnkerBidangByDinas/(:segment)', 'list_pengajuan::getBidangByDinas/$1');
$routes->get('getUnkerSubBidangByBidang/(:segment)/(:segment)', 'list_pengajuan::getSubBidangByBidang/$1/$2');

$routes->get('ubah-password', 'Auth::change_password');
$routes->post('ubah-password', 'Auth::update_password');
// $routes->get('debug-user', 'Auth::debug_user');
// $routes->get('debug-user/(:num)', 'Auth::debug_user/$1');

$routes->group('form_pengajuan', function($routes) {
    $routes->get('/', 'list_pengajuan::create',  ['filter' => 'role:3']);
    $routes->post('store', 'list_pengajuan::store', ['filter' => 'role:3']);
    // Tambahkan route lain untuk edit, update, delete sesuai kebutuhan
    $routes->get('suggestion', 'list_pengajuan::suggestion', ['filter' => 'role:3']);
    $routes->get('getdatapegawai', 'list_pengajuan::getdatapegawai', ['filter' => 'role:3']);
});


$routes->get('/setting_users', 'list_users::index', ['filter' => 'role:1,2']);//misal menu ini bisa diakses oleh admin dan admin bkpsdm
$routes->get('/create_user', 'list_users::create', ['filter' => 'role:1,2']);//misal menu ini bisa diakses oleh admin dan admin bkpsdm
$routes->post('/create_user', 'list_users::store', ['filter' => 'role:1,2']);//misal menu ini bisa diakses oleh admin dan admin bkpsdm

$routes->group('user', function($routes) {
    $routes->get('view/(:num)', 'list_users::view/$1', ['filter' => 'role:1,2']);
    $routes->get('edit/(:num)', 'list_users::edit/$1', ['filter' => 'role:1,2']);
    $routes->post('update/(:num)', 'list_users::update/$1', ['filter' => 'role:1,2']);
});

$routes->group('approval-mutasi', ['filter' => 'role:1,2'], function($routes) {
    $routes->get('/', 'ApprovalMutasi::index');
    $routes->get('view/(:num)', 'ApprovalMutasi::view/$1');
    $routes->get('approve/(:num)', 'ApprovalMutasi::approve/$1');
    $routes->get('reject/(:num)', 'ApprovalMutasi::reject/$1');
    $routes->get('view-pdf/(:any)', 'ApprovalMutasi::viewPdf/$1');
});

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');
// $routes->get('/dashboard', 'Dashboard::index');