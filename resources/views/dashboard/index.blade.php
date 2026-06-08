@extends('layouts.app')

@section('content')

<h1>Dashboard SIGURESTO</h1>

<br>

<div style="
display:flex;
gap:20px;
flex-wrap:wrap;
">

    <div class="card-stat">
        <h4>Total Barang</h4>
        <h2>120</h2>
    </div>

    <div class="card-stat">
        <h4>Total Supplier</h4>
        <h2>15</h2>
    </div>

    <div class="card-stat">
        <h4>Stok Minimum</h4>
        <h2>7</h2>
    </div>

    <div class="card-stat">
        <h4>Kadaluarsa</h4>
        <h2>2</h2>
    </div>

</div>

<br><br>

<div style="
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 2px 5px rgba(0,0,0,.1);
">

    <h3>Grafik Barang Masuk & Keluar</h3>

    <br>

    <canvas id="stokChart" height="100"></canvas>

</div>

<style>
.card-stat{
    width:220px;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('stokChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sen','Sel','Rab','Kam','Jum'],
            datasets: [{
                label: 'Barang Masuk',
                data: [12,19,8,25,15],
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true
        }
    });

});
</script>

@endsection