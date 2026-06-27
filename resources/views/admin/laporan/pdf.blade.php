<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            font-family: Helvetica, sans-serif;
            font-size:12px;
            color:#333;
        }

        h2{
            text-align:center;
            color:#1e293b;
        }

        .section-title{
            background:#3b82f6;
            color:white;
            padding:8px;
            margin-top:20px;
            font-weight:bold;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-bottom:20px;
        }

        th{
            background:#f1f5f9;
            border:1px solid #ddd;
            padding:8px;
        }

        td{
            border:1px solid #ddd;
            padding:8px;
        }
    </style>
</head>

<body>

<h2>Laporan Lengkap Gudang SIGURESTO</h2>

<p style="text-align:center;">
    Dicetak pada : {{ date('d-m-Y') }}
</p>


<!-- ========================= -->
<!-- PERMINTAAN -->
<!-- ========================= -->

<div class="section-title">
    1. Data Permintaan Barang
</div>

<table>

<thead>

<tr>
    <th>Tanggal</th>
    <th>Barang</th>
    <th>Jumlah</th>
    <th>Status</th>
</tr>

</thead>

<tbody>

@foreach($permintaanBarang as $item)

<tr>

<td>

{{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}

</td>

<td>

{{ $item->barang->nama ?? '-' }}

</td>

<td>

{{ $item->jumlah_diminta }}

</td>

<td>

{{ ucfirst($item->status) }}

</td>

</tr>

@endforeach

</tbody>

</table>



<!-- ========================= -->
<!-- BARANG MASUK -->
<!-- ========================= -->

<div class="section-title">
    2. Data Barang Masuk
</div>

<table>

<thead>

<tr>

<th>Tanggal</th>
<th>Barang</th>
<th>Supplier</th>
<th>Tgl Kadaluarsa</th>
<th>Jumlah</th>

</tr>

</thead>

<tbody>

@foreach($masuk as $item)

<tr>

<td>

{{ $item->tanggal ? $item->tanggal->format('d/m/Y') : '-' }}

</td>

<td>

{{ $item->barang->nama ?? '-' }}

</td>

<td>

{{ $item->supplier->nama ?? '-' }}

</td>

<td>

@if($item->barang && $item->barang->tanggal_kadaluarsa)

{{ $item->barang->tanggal_kadaluarsa->format('d/m/Y') }}

@else

-

@endif

</td>

<td>

{{ $item->jumlah }}

</td>

</tr>

@endforeach

</tbody>

</table>



<!-- ========================= -->
<!-- BARANG KELUAR -->
<!-- ========================= -->

<div class="section-title">
    3. Data Barang Keluar
</div>

<table>

<thead>

<tr>

<th>Tanggal</th>
<th>Barang</th>
<th>Tujuan</th>
<th>Jumlah</th>

</tr>

</thead>

<tbody>

@foreach($keluar as $item)

<tr>

<td>

{{ $item->tanggal ? $item->tanggal->format('d/m/Y') : '-' }}

</td>

<td>

{{ $item->barang->nama ?? '-' }}

</td>

<td>

{{ ucfirst($item->tujuan) }}

</td>

<td>

{{ $item->jumlah }}

</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>
