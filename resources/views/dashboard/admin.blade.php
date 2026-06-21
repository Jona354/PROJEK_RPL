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

.summary-table{
    width:100%;
    border-collapse:collapse;
}

.summary-table th{
    background:#2563eb;
    color:white;
    padding:15px;
    text-align:left;
}

.summary-table td{
    padding:15px;
    border-bottom:1px solid #eee;
}

.summary-table tr:hover{
    background:#f8fafc;
}

</style>


<h1 class="dashboard-title">
    Dashboard Admin Gudang
</h1>

<p class="dashboard-subtitle">
    Kelola data barang dan supplier SIGURESTO
</p>


<div class="card-container">

    <div class="stat-card">
        <h4>Total Barang</h4>
        <h2>{{ $totalBarang }}</h2>
    </div>

    <div class="stat-card">
        <h4>Total Supplier</h4>
        <h2>{{ $jumlahSupplier }}</h2>
    </div>

    <div class="stat-card">
        <h4>Stok Menipis</h4>
        <h2>{{ $stokMenipis }}</h2>
    </div>

    <div class="stat-card">
        <h4>Stok Habis</h4>
        <h2>{{ $stokHabis }}</h2>
    </div>

</div>


<div class="summary-card">

    <h2 class="summary-title">
        Ringkasan Data Gudang
    </h2>

    <table class="summary-table">

        <tr>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>

        <tr>
            <td>Total Barang</td>
            <td>{{ $totalBarang }}</td>
        </tr>

        <tr>
            <td>Total Supplier</td>
            <td>{{ $jumlahSupplier }}</td>
        </tr>

        <tr>
            <td>Stok Aman</td>
            <td>{{ $stokAman }}</td>
        </tr>

        <tr>
            <td>Stok Menipis</td>
            <td>{{ $stokMenipis }}</td>
        </tr>

        <tr>
            <td>Stok Habis</td>
            <td>{{ $stokHabis }}</td>
        </tr>

    </table>

</div>


<br><br>

<div class="summary-card">

    <h2 class="summary-title">
        Grafik Kondisi Stok
    </h2>

    <div style="height:350px">
        <canvas id="adminChart"></canvas>
    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    new Chart(document.getElementById('adminChart'), {

        type: 'bar',

        data: {

            labels: [
                'Stok Aman',
                'Stok Menipis',
                'Stok Habis'
            ],

            datasets: [{

                label: 'Jumlah Barang',

                data: [
                    {{ $stokAman }},
                    {{ $stokMenipis }},
                    {{ $stokHabis }}
                ],

                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#ef4444'
                ],

                borderRadius: 10

            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });

});

</script>

@endsection
