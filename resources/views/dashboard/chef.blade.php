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
    margin-bottom:15px;
    font-weight:500;
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
    Dashboard Chef
</h1>

<p class="dashboard-subtitle">
    Monitoring permintaan bahan dan stok dapur
</p>


<div class="card-container">

    <div class="stat-card">
        <h4>Total Permintaan</h4>
        <h2>{{ $permintaanSaya }}</h2>
    </div>

    <div class="stat-card">
        <h4>Pending</h4>
        <h2>{{ $permintaanPending }}</h2>
    </div>

    <div class="stat-card">
        <h4>Disetujui</h4>
        <h2>{{ $permintaanDisetujui }}</h2>
    </div>

    <div class="stat-card">
        <h4>Ditolak</h4>
        <h2>{{ $permintaanDitolak }}</h2>
    </div>

</div>


<div class="summary-card">

    <h2 class="summary-title">
        Grafik Status Permintaan
    </h2>

    <canvas id="chefChart"></canvas>

</div>

<br><br>

<div class="summary-card">

    <h2 class="summary-title">
        Persentase Status Permintaan
    </h2>

    <div style="width:350px;margin:auto">
        <canvas id="pieChart"></canvas>
    </div>

</div>


<script>

document.addEventListener("DOMContentLoaded", function(){

    const ctx = document.getElementById('chefChart');

    new Chart(ctx, {

        type:'bar',

        data:{
            labels:[
                'Pending',
                'Disetujui',
                'Ditolak'
            ],

            datasets:[{
                data:[
                    {{ $permintaanPending }},
                    {{ $permintaanDisetujui }},
                    {{ $permintaanDitolak }}
                ],

                backgroundColor:[
                    '#f59e0b',
                    '#10b981',
                    '#ef4444'
                ],

                borderRadius:10
            }]
        },

        options:{
            responsive:true,
            plugins:{
                legend:{
                    display:false
                }
            }
        }

    });


    const pie = document.getElementById('pieChart');

    new Chart(pie,{

        type:'doughnut',

        data:{
            labels:[
                'Pending',
                'Disetujui',
                'Ditolak'
            ],

            datasets:[{
                data:[
                    {{ $permintaanPending }},
                    {{ $permintaanDisetujui }},
                    {{ $permintaanDitolak }}
                ],

                backgroundColor:[
                    '#f59e0b',
                    '#10b981',
                    '#ef4444'
                ]
            }]
        }

    });

});

</script>

@endsection
