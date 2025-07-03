<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default routes
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/register', 'Auth::register');
$routes->post('/registerProcess', 'Auth::registerProcess');
$routes->get('/logout', 'Auth::logout');

// Dashboard untuk user biasa
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Barang umum (user bisa tambah & lihat)
$routes->get('/barang/tambah', 'Barang::create', ['filter' => 'auth']);
$routes->post('/barang/simpan', 'Barang::store', ['filter' => 'auth']);
$routes->get('/barang/(:num)', 'Barang::detail/$1', ['filter' => 'auth']);

// Statistik Umum (User bisa akses lihat, kalau mau hanya admin, bisa pindahkan)
$routes->get('/statistik', 'Statistik::index', ['filter' => 'auth']);
$routes->get('/statistik/cetak', 'Statistik::cetakMingguan', ['filter' => 'auth']);
$routes->get('/statistik/cetak-bulanan', 'Statistik::cetakBulanan', ['filter' => 'auth']);
$routes->get('/statistik/cetak-tahunan', 'Statistik::cetakTahunan', ['filter' => 'auth']);
$routes->get('/statistik/filter', 'Statistik::filterForm', ['filter' => 'auth']);
$routes->post('/statistik/filter', 'Statistik::filterResult', ['filter' => 'auth']);
$routes->post('/statistik/cetak-custom', 'Statistik::cetakCustomPDF', ['filter' => 'auth']);

// 👮 ADMIN-ONLY
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('barang', 'Admin::barang');
    $routes->get('barang/edit/(:num)', 'Barang::edit/$1');
    $routes->post('barang/update/(:num)', 'Barang::update/$1');
    $routes->post('barang/kirim/(:num)', 'Barang::kirim/$1');
    $routes->get('statistik', 'Statistik::index');
    $routes->get('statistik/cetak', 'Statistik::cetakMingguan');
    $routes->get('statistik/cetak-bulanan', 'Statistik::cetakBulanan');
    $routes->get('statistik/cetak-tahunan', 'Statistik::cetakTahunan');
    $routes->get('statistik/filter', 'Statistik::filterForm');
    $routes->post('statistik/filter', 'Statistik::filterResult');
    $routes->post('statistik/cetak-custom', 'Statistik::cetakCustomPDF');
});