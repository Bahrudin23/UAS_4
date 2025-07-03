<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\BarangMasukModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        helper(['form', 'url']);
    }

    public function create()
    {
        return view('barang/create');
    }

    public function store()
    {
        $validationRules = [
            'kode'       => 'required|is_unique[barang.kode]',
            'nama'       => 'required',
            'jumlah'     => 'required|integer',
            'tgl_masuk'  => 'required|valid_date',
            'foto'       => 'if_exist|is_image[foto]|max_size[foto,2048]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $fotoName = 'Foto_Default.png';

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploads/', $fotoName);
        }

        $this->barangModel->save([
            'kode'      => $this->request->getPost('kode'),
            'nama'      => $this->request->getPost('nama'),
            'jumlah'    => $this->request->getPost('jumlah'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto'      => $fotoName,
        ]);

        $barangId = $this->barangModel->getInsertID();
        $masukModel = new BarangMasukModel();
        $masukModel->save([
            'barang_id' => $barangId,
            'jumlah'    => $this->request->getPost('jumlah'),
            'tanggal'   => $this->request->getPost('tgl_masuk'),
        ]);

        return redirect()->to('/dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }
    public function detail($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang tidak ditemukan');
        }

        return view('barang/detail', ['barang' => $barang]);
    }

    public function kirim($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->to('/dashboard')->with('error', 'Barang tidak ditemukan.');
        }

        $jumlahKeluar = (int) $this->request->getPost('jumlah_keluar');

        if ($jumlahKeluar <= 0 || $jumlahKeluar > $barang['jumlah']) {
            return redirect()->back()->with('error', 'Jumlah keluar tidak valid.');
        }

        // Kurangi jumlah barang
        $this->barangModel->update($id, [
            'jumlah' => $barang['jumlah'] - $jumlahKeluar
        ]);

        // Simpan histori pengeluaran (opsional, nanti bisa buat tabel `barang_keluar`)
        // Logikanya akan digunakan untuk laporan PDF

        return redirect()->to('/barang/' . $id)->with('success', 'Barang berhasil dikirim.');
    }
    public function edit($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang tidak ditemukan');
        }

        return view('barang/edit', ['barang' => $barang]);
    }

    public function update($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->to('/dashboard')->with('error', 'Barang tidak ditemukan.');
        }

        $rules = [
            'kode'       => "required|is_unique[barang.kode,id,{$id}]",
            'nama'       => 'required',
            'jumlah'     => 'required|integer',
            'foto'       => 'if_exist|is_image[foto]|max_size[foto,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $fotoName = $barang['foto']; // default: tetap pakai foto lama

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploads/', $fotoName);
        }

        $this->barangModel->update($id, [
            'kode'      => $this->request->getPost('kode'),
            'nama'      => $this->request->getPost('nama'),
            'jumlah'    => $this->request->getPost('jumlah'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto'      => $fotoName,
        ]);

        return redirect()->to('/barang/' . $id)->with('success', 'Barang berhasil diperbarui.');
    }
}
