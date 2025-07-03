<!DOCTYPE html>
<html>
<head>
    <title>Detail Barang</title>
    <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

    <a href="<?= session()->get('role') === 'admin' ? '/admin/barang' : '/dashboard' ?>"><i data-feather="arrow-left-circle"></i></a>
    <?php if (session()->get('role') === 'admin') : ?>
    <?php endif; ?>

    <h2>Detail Barang</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <img src="<?= base_url('uploads/' . $barang['foto']) ?>" width="200"><br><br>
    <strong>Nama:</strong> <?= esc($barang['nama']) ?><br>
    <strong>Kode:</strong> <?= esc($barang['kode']) ?><br>
    <strong>Jumlah:</strong> <?= esc($barang['jumlah']) ?><br>
    <strong>Deskripsi:</strong><br> <?= nl2br(esc($barang['deskripsi'])) ?><br>
    <strong>Tanggal Masuk:</strong> <?= esc($barang['tgl_masuk']) ?><br><br>

    <?php if (session()->get('role') === 'admin') : ?>
        <form action="/barang/kirim/<?= $barang['id'] ?>" method="post">
            <label>Jumlah yang akan dikirim:</label><br>
            <input type="number" name="jumlah_keluar" min="1" max="<?= $barang['jumlah'] ?>" required><br><br>
            <div class="floating-button">
                <button type="submit"><i data-feather="send"></i> Kirim</button>
            </div>
        </form>
    <?php endif; ?>

    <script>
        feather.replace();
    </script>
</body>
</html>