<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
</head>
<body>
    <h2>Login</h2>
    <?php if(session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <form action="/loginProcess" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <div>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <i data-feather="eye-off" onclick="togglePassword('password', this)"></i>
        </div>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="/register">Daftar</a></p>

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
