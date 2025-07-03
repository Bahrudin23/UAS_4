<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
</head>
<body>
    <h2>Registrasi</h2>
    <?php if(session()->getFlashdata('errors')): ?>
        <ul>
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form action="/registerProcess" method="post">
        <input type="text" name="name" placeholder="Nama Lengkap" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <div>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <i data-feather="eye-off" onclick="togglePassword('password', this)"></i>
        </div>
        <div>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" required>
            <i data-feather="eye-off" onclick="togglePassword('confirm_password', this)"></i>
        </div>
        <input type="text" name="whatsapp" placeholder="Nomor WhatsApp" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="/login">Login</a></p>

    <script>
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            const isPassword = field.type === "password";
            field.type = isPassword ? "text" : "password";
            icon.setAttribute("data-feather", isPassword ? "eye" : "eye-off");
            feather.replace();
        }
        feather.replace();
    </script>
</body>
</html>
