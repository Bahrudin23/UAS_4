<!DOCTYPE html>
<html>
<head><title>Filter Tanggal</title></head>
<body>
    <h2>Filter Laporan Barang Keluar</h2>
    <form action="/statistik/filter" method="post">
        <label>Dari Tanggal:</label><br>
        <input type="date" name="start_date" required><br><br>
        <label>Sampai Tanggal:</label><br>
        <input type="date" name="end_date" required><br><br>
        <button type="submit">Lihat Laporan</button>
    </form>
</body>
</html>