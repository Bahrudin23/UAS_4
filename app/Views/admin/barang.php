<!DOCTYPE html>
<html>
<head>
    <title>Barang (Admin)</title>
    <link href="https://unpkg.com/feather-icons" rel="stylesheet">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
    <h2>Barang (Admin)</h2>

    <a href="/logout" style="float: right;">Logout</a>

    <a href="/barang/tambah">Tambah Barang</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>Foto</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barang as $b): ?>
            <tr>
                <td><img src="<?= base_url('uploads/' . $b['foto']) ?>" width="50"></td>
                <td><?= esc($b['kode']) ?></td>
                <td><?= esc($b['nama']) ?></td>
                <td><?= esc($b['jumlah']) ?></td>
                <td>
                    <a href="/barang/<?= $b['id'] ?>">Detail</a> |
                    <a href="/admin/barang/edit/<?= $b['id'] ?>">Edit</a> |
                    <form action="/admin/barang/kirim/<?= $b['id'] ?>" method="post" style="display:inline;">
                        <input type="number" name="jumlah_keluar" value="1" min="1" max="<?= $b['jumlah'] ?>">
                        <button type="submit">Kirim</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>