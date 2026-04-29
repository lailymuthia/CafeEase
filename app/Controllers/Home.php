<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function index() {
        $nomorMeja = $this->request->getVar('table');
        
        // Simpan nomor meja ke session jika ada input dari form
        if ($nomorMeja) { 
            session()->set('nomor_me_ja', null); // Bersihkan typo lama jika ada
            session()->set('nomor_meja', $nomorMeja); 
        }
        
        $data['mejaAktif'] = session()->get('nomor_meja');
        
        // Ambil menu unggulan saja untuk landing page
        $data['menus'] = $this->db->table('menus')
                                  ->where('is_unggulan', 1)
                                  ->get()
                                  ->getResultArray(); 
                                  
        return view('landing_page', $data);
    }

    public function identitas() {
        if (!session()->get('nomor_meja')) return redirect()->to('/');
        $data['mejaAktif'] = session()->get('nomor_meja');
        return view('halaman_identitas', $data);
    }

    public function simpanIdentitas() {
        session()->set([
            'nama_pelanggan' => $this->request->getPost('nama'),
            'hp_pelanggan'   => $this->request->getPost('hp'),
        ]);
        return redirect()->to('/menu');
    }

    public function menu() {
        if (!session()->get('nama_pelanggan')) return redirect()->to('/identitas');
        $data = [
            'nama'  => session()->get('nama_pelanggan'),
            'meja'  => session()->get('nomor_meja'),
            'menus' => $this->db->table('menus')->get()->getResultArray()
        ];
        return view('halaman_menu', $data);
    }

    public function tambahKeranjang() {
        $nama = $this->request->getPost('nama');
        $harga = $this->request->getPost('harga');
        $keranjang = session()->get('keranjang') ?? [];
        
        if (isset($keranjang[$nama])) { 
            $keranjang[$nama]['qty']++; 
        } else { 
            $keranjang[$nama] = ['nama' => $nama, 'harga' => $harga, 'qty' => 1]; 
        }
        
        session()->set('keranjang', $keranjang);
        return $this->response->setJSON(['status' => 'success', 'total_item' => count($keranjang)]);
    }

    public function lihatKeranjang() {
        if (!session()->get('nama_pelanggan')) return redirect()->to('/');
        $data = [
            'keranjang' => session()->get('keranjang') ?? [],
            'nama' => session()->get('nama_pelanggan'),
            'meja' => session()->get('nomor_meja')
        ];
        return view('halaman_keranjang', $data);
    }

    public function checkout()
    {
        $session = session();
        $keranjang = $session->get('keranjang') ?? [];
        
        if (empty($keranjang)) {
            return redirect()->to('menu')->with('error', 'Keranjang masih kosong!');
        }

        $db = \Config\Database::connect();
        
        // 1. Simpan ke tabel pesanan
        $dataPesanan = [
            'nama_pelanggan' => $session->get('nama_pelanggan'),
            'nomor_meja'     => $session->get('nomor_meja'),
            'total_harga'    => $this->hitungTotal($keranjang), 
            'status'         => 'Menunggu',
            'created_at'     => date('Y-m-d H:i:s')
        ];
        
        $db->table('pesanan')->insert($dataPesanan);
        $id_pesanan_baru = $db->insertID(); 

        // 2. Simpan rincian ke order_items
        foreach ($keranjang as $item) {
            $dataItem = [
                'id_pesanan' => $id_pesanan_baru,
                'nama_menu'  => $item['nama'],
                'harga'      => $item['harga']
            ];
            $db->table('order_items')->insert($dataItem);
        }

        // Simpan data untuk View Sukses sebelum session keranjang dihapus
        $dataSukses = [
            'nama' => $session->get('nama_pelanggan'),
            'meja' => $session->get('nomor_meja')
        ];

        $session->remove('keranjang');
        return view('halaman_sukses', $dataSukses); 
    }

    private function hitungTotal($keranjang) {
        $total = 0;
        foreach ($keranjang as $item) {
            $total += ($item['harga'] * $item['qty']);
        }
        return $total;
    }

    public function resetMeja() {
        session()->destroy();
        return redirect()->to('/');
    }
}