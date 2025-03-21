<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembayaran</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background-color: #2C3E50;
            color: #fff;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            border-bottom: 1px solid #34495E;
        }

        .sidebar a:hover {
            background-color: #1ABC9C;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            overflow-y: auto;
        }

        .chart-container {
            width: 50%;
            margin: auto;
        }

        canvas {
            margin-top: 20px;
        }

        .logout-button {
            margin-top: 20px;
            padding: 8px 15px; /* Size adjusted */
            background-color: #E74C3C;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px; /* Font size adjusted */
            width: auto;
            display: inline-block;
            text-align: center;
        }

        .logout-button:hover {
            background-color: #C0392B;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3 style="text-align:center;">Dashboard</h3>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('payment.spp') }}">Pembayaran SPP</a>
        <a href="{{ route('payment.seragam') }}">Pembayaran Seragam</a>
        <a href="{{ route('payment.ijazah') }}">Pembayaran Ijazah</a>
    </div>

    <div class="content">
        <h2>Dashboard Pembayaran</h2>
        <div class="chart-container">
            <canvas id="paymentChart"></canvas>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route("chart.data") }}')
                .then(response => response.json())
                .then(data => {
                    const categories = ['SPP', 'Seragam', 'Ijazah'];
                    const payments = ['Bayar', 'Belum Bayar'];

                    let dataset = categories.map(category => {
                        let paymentStatus = payments.map(status => {
                            let found = data.find(d => d.category === category && d.status === status);
                            return found ? found.total : 0;
                        });

                        let backgroundColor = ''; // Default empty color
                        switch (category) {
                            case 'SPP':
                                backgroundColor = '#FFCE56'; // Kuning untuk SPP
                                break;
                            case 'Seragam':
                                backgroundColor = '#36A2EB'; // Biru untuk Seragam
                                break;
                            case 'Ijazah':
                                backgroundColor = '#4CAF50'; // Hijau untuk Ijazah
                                break;
                        }

                        return {
                            label: category,
                            data: paymentStatus,
                            backgroundColor: [backgroundColor, backgroundColor], // Same color for all status
                            borderColor: [backgroundColor, backgroundColor],
                            borderWidth: 1
                        };
                    });

                    const ctx = document.getElementById('paymentChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['SPP', 'Seragam', 'Ijazah'],
                            datasets: dataset
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ": " + tooltipItem.raw + " Orang";
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>

</body>
</html>
