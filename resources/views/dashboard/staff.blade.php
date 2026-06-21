@extends('layouts.app')

@section('content')

<style>

.dashboard-title{
    margin-bottom:5px;
    color:#1e3a8a;
    font-size:32px;
    font-weight:700;
}

.dashboard-subtitle{
    color:#6b7280;
    margin-bottom:30px;
}

.card-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:35px;
}

.stat-card{
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(37,99,235,.2);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-card h4{
    font-size:16px;
    font-weight:500;
    opacity:.9;
    margin-bottom:15px;
}

.stat-card h2{
    font-size:40px;
}

.summary-card{
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.summary-title{
    color:#1e3a8a;
    margin-bottom:20px;
}

</style>


<h1 class="dashboard-title">
    Dashboard Staff Gudang
</h1>

<p class="dashboard-subtitle">
    Aktivitas transaksi gudang SIGURESTO
</p>


<div class="card-container">

    <div class="stat-card">
        <h4>Barang Masuk</h4>
        <h2>{{ $barangMasuk }}</h2>
    </div>

    <div class="stat-card">
        <h4>Barang Keluar</h4>
        <h2>{{ $barangKeluar }}</h2>
    </div>

    <div class="stat-card">
        <h4>Permintaan Pending</h4>
        <h2>{{ $permintaanPending }}</h2>
    </div>

    <div class="stat-card">
        <h4>Total Transaksi</h4>
        <h2>{{ $totalTransaksi }}</h2>
    </div>

</div>


<div class="summary-card">

    <h2 class="summary-title">
        Grafik Aktivitas Gudang
    </h2>

    <canvas id="staffChart"></canvas>

</div>


<br><br>


<div class="summary-card">

    <h2 class="summary-title">
        Persentase Aktivitas Gudang
    </h2>

    <div style="width:350px;margin:auto">
        <canvas id="pieChart"></canvas>
    </div>

</div>


<script>

document.addEventListener("DOMContentLoaded", function () {

    // Grafik Batang
    const staffCtx = document.getElementById('staffChart');

    if (staffCtx) {

        new Chart(staffCtx, {

            type: 'bar',

            data: {
                labels: [
                    'Barang Masuk',
                    'Barang Keluar',
                    'Permintaan Pending'
                ],

                datasets: [{
                    label: 'Jumlah',
                    data: [
                        {{ $barangMasuk }},
                        {{ $barangKeluar }},
                        {{ $permintaanPending }}
                    ],

                    backgroundColor: [
                        '#10b981',
                        '#ef4444',
                        '#f59e0b'
                    ],

                    borderRadius: 10
                }]
            },

            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

        });

    }


    // Grafik Donut
    const pieCtx = document.getElementById('pieChart');

    if (pieCtx) {

        new Chart(pieCtx, {

            type: 'doughnut',

            data: {
                labels: [
                    'Barang Masuk',
                    'Barang Keluar',
                    'Permintaan Pending'
                ],

                datasets: [{
                    data: [
                        {{ $barangMasuk }},
                        {{ $barangKeluar }},
                        {{ $permintaanPending }}
                    ],

                    backgroundColor: [
                        '#10b981',
                        '#ef4444',
                        '#f59e0b'
                    ]
                }]
            },

            options: {
                responsive: true
            }

        });

    }

});

</script>

@endsection
