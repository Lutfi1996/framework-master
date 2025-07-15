<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/dbtest', 'DBTest::index');
$routes->get('/', 'Home::index');
$routes->get('/form_pengajuan', 'Home::form_pengajuan');
$routes->get('/list_pengajuan', 'list_pengajuan::index');
