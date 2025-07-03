<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/register', 'Auth::register');
$routes->post('/registerProcess', 'Auth::registerProcess');
$routes->get('/logout', 'Auth::logout');



$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/barang/tambah', 'Barang::create', ['filter' => 'auth']);
$routes->post('/barang/simpan', 'Barang::store', ['filter' => 'auth']);


