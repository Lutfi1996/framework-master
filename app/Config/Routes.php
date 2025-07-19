<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/dbtest', 'DBTest::index');
$routes->get('/', 'Home::index');
$routes->get('/form_pengajuan', 'Home::form_pengajuan', ['filter' => 'auth']);
$routes->get('/list_pengajuan', 'list_pengajuan::index', ['filter' => 'auth']);
$routes->get('/setting_users', 'list_users::index', ['filter' => 'auth']);
$routes->get('/create_user', 'list_users::create', ['filter' => 'auth']);
$routes->post('/create_user', 'list_users::store', ['filter' => 'auth']);


$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');
// $routes->get('/dashboard', 'Dashboard::index');