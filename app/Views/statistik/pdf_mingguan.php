<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>LAPORAN BARANG KELUAR MINGGUAN</h2>
    <p>Dicetak tanggal: <?= date('d-m-Y') ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Keluar</th>
                <th>Tanggal Keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $d): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($d['kode']) ?></td>
                <td><?= esc($d['nama']) ?></td>
                <td><?= esc($d['jumlah']) ?></td>
                <td><?= date('d-m-Y', strtotime($d['tanggal'])) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>