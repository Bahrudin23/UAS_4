<!DOCTYPE html>
<html>
<head><title>Hasil Filter</title></head>
<body>
    <h2>Laporan Barang Keluar dari <?= $start ?> s/d <?= $end ?></h2>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>No</th><th>Kode</th><th>Nama</th><th>Jumlah</th><th>Tanggal</th>
            </tr>
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

    <form action="/statistik/cetak-custom" method="post">
        <input type="hidden" name="start_date" value="<?= $start ?>">
        <input type="hidden" name="end_date" value="<?= $end ?>">
        <button type="submit">🖨️ Cetak PDF</button>
    </form>
</body>
</html>