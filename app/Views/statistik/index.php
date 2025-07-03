<!DOCTYPE html>
<html>
<head>
    <title>Statistik Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .chart-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
        .button-container {
            margin-top: 20px;
            text-align: center;
        }
        button {
            margin: 0 5px;
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <a href="/dashboard"><i data-feather="arrow-left-circle"></i> Kembali</a>
    <h2 style="text-align:center;">Statistik Barang Keluar Mingguan</h2>

    <div class="chart-container">
        <canvas id="mingguanChart"></canvas>
    </div>

    <div class="button-container">
        <h3>Cetak Laporan PDF</h3>
        <a href="/statistik/cetak"><button>Cetak Mingguan</button></a>
        <a href="/statistik/cetak-bulanan"><button>Cetak Bulanan</button></a>
        <a href="/statistik/cetak-tahunan"><button>Cetak Tahunan</button></a>
    </div>

    <script>
        feather.replace();

        const ctx = document.getElementById('mingguanChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($data_minggu, 'tgl')) ?>,
                datasets: [{
                    label: 'Barang Keluar (7 Hari Terakhir)',
                    data: <?= json_encode(array_column($data_minggu, 'total')) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>