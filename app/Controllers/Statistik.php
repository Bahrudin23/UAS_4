<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\BarangModel;
use App\Models\BarangKeluarModel;

class Statistik extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $keluarModel = new BarangKeluarModel();

        // Total barang
        $total = $barangModel->countAll();

        // Statistik mingguan
        $minggu = $keluarModel
            ->select("DATE(tanggal) as tgl, SUM(jumlah) as total")
            ->where('tanggal >=', date('Y-m-d', strtotime('-7 days')))
            ->groupBy('tanggal')
            ->findAll();

        return view('statistik/index', [
            'total_barang' => $total,
            'data_minggu' => $minggu,
        ]);
    }
    public function cetakMingguan()
    {
        $keluarModel = new BarangKeluarModel();
        $barangModel = new BarangModel();

        $mingguLalu = date('Y-m-d', strtotime('-7 days'));

        $data = $keluarModel
            ->where('tanggal >=', $mingguLalu)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        foreach ($data as &$row) {
            $barang = $barangModel->find($row['barang_id']);
            $row['nama'] = $barang['nama'] ?? 'Tidak Diketahui';
            $row['kode'] = $barang['kode'] ?? '-';
        }

        $html = view('statistik/pdf_mingguan', ['data' => $data]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('laporan_barang_keluar_mingguan.pdf', ['Attachment' => true]);
    }
    public function cetakBulanan()
    {
        $keluarModel = new BarangKeluarModel();
        $barangModel = new BarangModel();

        $bulanIni = date('Y-m-01');

        $data = $keluarModel
            ->where('tanggal >=', $bulanIni)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        foreach ($data as &$row) {
            $barang = $barangModel->find($row['barang_id']);
            $row['nama'] = $barang['nama'] ?? 'Tidak Diketahui';
            $row['kode'] = $barang['kode'] ?? '-';
        }

        $html = view('statistik/pdf_bulanan', ['data' => $data]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_barang_keluar_bulanan.pdf', ['Attachment' => true]);
    }
    public function cetakTahunan()
    {
        $keluarModel = new BarangKeluarModel();
        $barangModel = new BarangModel();

        $tahunIni = date('Y-01-01');

        $data = $keluarModel
            ->where('tanggal >=', $tahunIni)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        foreach ($data as &$row) {
            $barang = $barangModel->find($row['barang_id']);
            $row['nama'] = $barang['nama'] ?? 'Tidak Diketahui';
            $row['kode'] = $barang['kode'] ?? '-';
        }

        $html = view('statistik/pdf_tahunan', ['data' => $data]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_barang_keluar_tahunan.pdf', ['Attachment' => true]);
    }
    public function filterForm()
    {
        return view('statistik/filter_form');
    }
    public function filterResult()
    {
        $start = $this->request->getPost('start_date');
        $end = $this->request->getPost('end_date');

        $keluarModel = new BarangKeluarModel();
        $barangModel = new BarangModel();

        $data = $keluarModel
            ->where('tanggal >=', $start)
            ->where('tanggal <=', $end)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        foreach ($data as &$row) {
            $barang = $barangModel->find($row['barang_id']);
            $row['nama'] = $barang['nama'] ?? '-';
            $row['kode'] = $barang['kode'] ?? '-';
        }

        return view('statistik/filter_result', [
            'data' => $data,
            'start' => $start,
            'end' => $end,
        ]);
    }
    public function cetakCustomPDF()
    {
        $start = $this->request->getPost('start_date');
        $end = $this->request->getPost('end_date');

        $keluarModel = new BarangKeluarModel();
        $barangModel = new BarangModel();

        $data = $keluarModel
            ->where('tanggal >=', $start)
            ->where('tanggal <=', $end)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        foreach ($data as &$row) {
            $barang = $barangModel->find($row['barang_id']);
            $row['nama'] = $barang['nama'] ?? '-';
            $row['kode'] = $barang['kode'] ?? '-';
        }

        $html = view('statistik/pdf_custom', [
            'data' => $data,
            'start' => $start,
            'end' => $end,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_barang_keluar_custom.pdf', ['Attachment' => true]);
    }
}