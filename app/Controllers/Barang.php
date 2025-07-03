<?php

namespace App\Controllers;

use App\Models\BarangModel;

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

        return redirect()->to('/dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }
}
