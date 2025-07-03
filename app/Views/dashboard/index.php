<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
</head>
<body>
    <h2>Dashboard</h2>

    <a href="/logout">Logout</a>

    <h3>Stok Barang</h3>
    <form method="get">
        <input type="text" name="search" placeholder="Cari nama barang">
        <button type="submit"><i data-feather="search"></i></button>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($barang as $b): ?>
            <tr>
                <td><img src="<?= base_url('uploads/' . $b['foto']) ?>" width="50"></td>
                <td><a href="/barang/<?= $b['id'] ?>"><?= esc($b['nama']) ?></a></td>
                <td><?= esc($b['kode']) ?></td>
                <td><?= esc($b['jumlah']) ?></td>
                <td><?= esc($b['tgl_masuk']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button onclick="window.location.href='/barang/tambah'">
        <i data-feather="plus"></i> Tambah Barang
    </button>

    <script>
        feather.replace();
    </script>
</body>
</html>
