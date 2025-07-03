<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Admin extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function barang()
    {
        $data['barang'] = $this->barangModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/barang', $data);
    }
}