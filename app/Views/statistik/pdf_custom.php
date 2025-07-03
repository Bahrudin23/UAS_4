<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">LAPORAN BARANG KELUAR</h3>
    <p>Periode: <?= $start ?> s/d <?= $end ?></p>

    <table>
        <thead>
            <tr><th>No</th><th>Kode</th><th>Nama</th><th>Jumlah</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $d): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= esc($d['kode']) ?></td>
                    <td><?= esc($d['nama']) ?></td>
                    <td><?= esc($d['jumlah']) ?></td>
                    <td><?= $d['tanggal'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>