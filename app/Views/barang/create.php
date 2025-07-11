<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <style>
        textarea {
            width: 100%;
            resize: none;
            overflow: hidden;
        }
        .floating-button {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <h2>Tambah Barang</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    <?php endif ?>

    <form action="/barang/simpan" method="post" enctype="multipart/form-data">
        <label>Kode Barcode</label><br>
        <input type="text" name="kode" id="kode" required readonly><br><br>

        <button type="button" id="startScanButton">Scan Barcode</button><br><br>

        <label>Foto Barang</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <label>Nama Barang</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="3" oninput="autoGrow(this)"></textarea><br><br>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" required><br><br>

        <label>Tanggal Masuk</label><br>
        <input type="date" name="tgl_masuk" required><br><br>

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