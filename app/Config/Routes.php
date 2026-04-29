<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes Pelanggan
$routes->get('/', 'Home::index');
$routes->get('menu', 'Home::menu');
$routes->get('identitas', 'Home::identitas');
$routes->post('simpan-identitas', 'Home::simpanIdentitas');
$routes->post('tambah-keranjang', 'Home::tambahKeranjang');
$routes->get('keranjang', 'Home::lihatKeranjang');
$routes->get('checkout', 'Home::checkout');
$routes->get('reset-meja', 'Home::resetMeja'); // Ini yang dipakai di Landing Page

// Routes Admin
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/auth', 'Admin::auth');
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/kelola_menu', 'Admin::kelola_menu');
$routes->post('admin/simpan', 'Admin::simpan');
$routes->get('admin/edit/(:num)', 'Admin::edit/$1');    // Menampilkan halaman form edit
$routes->post('admin/update/(:num)', 'Admin::update/$1');
$routes->get('admin/hapus/(:num)', 'Admin::hapus/$1');
$routes->get('admin/logout', 'Admin::logout');
$routes->post('admin/update_status/(:num)', 'Admin::update_status/$1');