<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $db;

    public function __construct() { 
        $this->db = \Config\Database::connect(); 
    }

    public function login() { 
        return view('admin/login'); 
    }

    public function auth() {
        if ($this->request->getPost('username') == 'admin' && $this->request->getPost('password') == 'admin') {
            session()->set('is_admin', true);
            return redirect()->to('admin/dashboard');
        }
        return redirect()->back()->with('error', 'Login Gagal!');
    }

    public function dashboard() {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        
        $data['orders'] = $this->db->table('pesanan p')
            ->select('p.*, GROUP_CONCAT(oi.nama_menu SEPARATOR ", ") as detail_item')
            ->join('order_items oi', 'oi.id_pesanan = p.id', 'left')
            ->groupBy('p.id')
            ->orderBy('p.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/dashboard', $data);
    }

    public function kelola_menu() {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        $data['menus'] = $this->db->table('menus')->get()->getResultArray();
        return view('admin/kelola_menu', $data);
    }

    public function simpan() {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $fileGambar = $this->request->getFile('icon');
        $namaGambar = 'default.jpg'; 

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName(); 
            $fileGambar->move('uploads/', $namaGambar); 
        }

        $data = [
            'nama'        => $this->request->getPost('nama'),
            'harga'       => $this->request->getPost('harga'),
            'kategori'    => $this->request->getPost('kategori'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'icon'        => $namaGambar, 
            'is_unggulan' => $this->request->getPost('is_unggulan') ? 1 : 0,
        ];

        $this->db->table('menus')->insert($data);
        return redirect()->to('admin/kelola_menu');
    }

    // --- FITUR EDIT & UPDATE BARU ---

    public function edit($id) {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        
        // Ambil data menu lama untuk ditampilkan di form edit
        $data['menu'] = $this->db->table('menus')->where('id', $id)->get()->getRowArray();
        
        if (!$data['menu']) {
            return redirect()->to('admin/kelola_menu')->with('error', 'Menu tidak ditemukan.');
        }

        return view('admin/edit_menu', $data);
    }

    public function update($id) {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $fileGambar = $this->request->getFile('icon');
        
        // Ambil data lama dulu untuk menjaga nama gambar jika tidak diganti
        $menuLama = $this->db->table('menus')->where('id', $id)->get()->getRowArray();

        $data = [
            'nama'        => $this->request->getPost('nama'),
            'harga'       => $this->request->getPost('harga'),
            'kategori'    => $this->request->getPost('kategori'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'is_unggulan' => $this->request->getPost('is_unggulan') ? 1 : 0,
        ];

        // Logika Update Gambar: Hanya upload jika ada file baru
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaBaru = $fileGambar->getRandomName();
            $fileGambar->move('uploads/', $namaBaru);
            $data['icon'] = $namaBaru;
        }

        $this->db->table('menus')->where('id', $id)->update($data);
        return redirect()->to('admin/kelola_menu')->with('success', 'Menu berhasil diperbarui.');
    }

    // --- AKHIR FITUR EDIT ---

    public function update_status($id) {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $this->db->table('pesanan')
                 ->where('id', $id)
                 ->update(['status' => 'Selesai']);

        return redirect()->to('admin/dashboard')->with('success', 'Pesanan telah diselesaikan.');
    }

    public function hapus($id) {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        $this->db->table('menus')->where('id', $id)->delete();
        return redirect()->to('admin/kelola_menu');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('admin/login');
    }
}