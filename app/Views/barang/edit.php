<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        textarea {
            width: 100%;
            resize: none;
            overflow: hidden;
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>

    <a href="<?= session()->get('role') === 'admin' ? '/admin/barang' : '/dashboard' ?>"><i data-feather="arrow-left-circle"></i></a>

    <h2>Edit Barang</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color:red;">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    <?php endif ?>

    <form action="/barang/update/<?= $barang['id'] ?>" method="post" enctype="multipart/form-data">
        <label>Kode Barang</label><br>
        <input type="text" name="kode" id="kode" value="<?= esc($barang['kode']) ?>" required readonly><br><br>

        <button type="button" id="startScanButton">Scan Barcode</button><br><br>

        <label>Foto Barang</label><br>
        <input type="file" name="foto" accept="image/*"><br>
        <small>Biarkan kosong jika tidak ingin mengganti foto</small><br><br>

        <label>Nama</label><br>
        <input type="text" name="nama" value="<?= esc($barang['nama']) ?>" required><br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="3" oninput="autoGrow(this)"><?= esc($barang['deskripsi']) ?></textarea><br><br>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" value="<?= esc($barang['jumlah']) ?>" required><br><br>

        <div class="floating-button">
            <button type="submit"><i data-feather="save"></i> Simpan</button>
        </div>
    </form>

    <script>
        feather.replace();
        function autoGrow(el) {
            el.style.height = "5px";
            el.style.height = (el.scrollHeight) + "px";
        }

        const startScanButton = document.getElementById("startScanButton");
        startScanButton.addEventListener("click", function () {
            const html5QrCode = new Html5Qrcode("reader");

            html5QrCode.start(
                { facingMode: "environment" },
                {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText, decodedResult) => {
                    document.getElementById("kode").value = decodedText;
                    html5QrCode.stop();
                },
                (errorMessage) => {
                    console.log(errorMessage);
                }
            );
        });
    </script>
</body>
</html>