<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();

        $data = [
            'title' => 'Dashboard',
            'barang' => $barangModel->findAll(),
        ];

        return view('dashboard/index', $data);
    }
}
