@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">

    <div>
        <h1 style="font-size:28px;color:#111827;">
            Data Barang
        </h1>
        <p style="color:#6b7280;">
            Kelola seluruh data inventaris gudang
        </p>
    </div>

    <a href="{{ route('barang.create') }}"
       style="
       background:#2563eb;
       color:white;
       padding:12px 20px;
       border-radius:10px;
       text-decoration:none;
       font-weight:600;
       ">
        + Tambah Barang
    </a>

</div>

<!-- Statistik -->

<div style="
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:25px;
">

    <div class="card-stat">
        <h4>Total Barang</h4>
        <h2>{{ $totalBarang }}</h2>
    </div>

    <div class="card-stat">
        <h4>Stok Aman</h4>
        <h2>{{ $stokAman }}</h2>
    </div>

    <div class="card-stat">
        <h4>Stok Menipis</h4>
        <h2>{{ $stokMenipis }}</h2>
    </div>

    <div class="card-stat">
        <h4>Habis</h4>
        <h2>{{ $stokHabis }}</h2>
    </div>

</div>

<!-- Search -->

<div style="
background:white;
padding:20px;
border-radius:12px;
margin-bottom:20px;
box-shadow:0 2px 10px rgba(0,0,0,.05);
">

    <input type="text"
           placeholder="Cari barang..."
           style="
           width:300px;
           padding:10px;
           border:1px solid #ddd;
           border-radius:8px;
           ">

</div>

<!-- Table -->

<div style="
background:white;
border-radius:12px;
overflow:hidden;
box-shadow:0 2px 10px rgba(0,0,0,.05);
">

<table style="
width:100%;
border-collapse:collapse;
">

    <thead>

        <tr style="background:#2563eb;color:white;">

            <th style="padding:15px;">Kode</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Stok</th>
            <th>Harga</th>
            <th width="180">Aksi</th>

        </tr>

    </thead>

   <tbody>

@forelse($barang as $item)

<tr style="border-bottom:1px solid #e5e7eb;">

    <td style="padding:15px;">
        {{ $item->kode_barang }}
    </td>

    <td>
        {{ $item->nama }}
    </td>

    <td>
        {{ $item->kategori }}
    </td>

    <td>
        {{ $item->supplier->nama ?? '-' }}
    </td>

    <td>

        @if($item->stok_saat_ini <= 0)

            <span style="
            background:#fee2e2;
            color:#991b1b;
            padding:5px 10px;
            border-radius:20px;
            ">
                Habis ({{ $item->stok_saat_ini }})
            </span>

        @elseif($item->stok_saat_ini <= $item->stok_minimum)

            <span style="
            background:#fef3c7;
            color:#92400e;
            padding:5px 10px;
            border-radius:20px;
            ">
                Menipis ({{ $item->stok_saat_ini }})
            </span>

        @else

            <span style="
            background:#dcfce7;
            color:#166534;
            padding:5px 10px;
            border-radius:20px;
            ">
                {{ $item->stok_saat_ini }}
            </span>

        @endif

    </td>

    <td>
        Rp {{ number_format($item->harga_satuan,0,',','.') }}
    </td>

    <td>

        <a href="{{ route('barang.edit',$item->id) }}"
           style="
           background:#f59e0b;
           color:white;
           padding:8px 12px;
           border-radius:6px;
           text-decoration:none;
           ">
            Edit
        </a>

        <form action="{{ route('barang.destroy',$item->id) }}"
              method="POST"
              style="display:inline;">

            @csrf
            @method('DELETE')

            <button type="submit"
                    onclick="return confirm('Yakin hapus data?')"
                    style="
                    background:#ef4444;
                    color:white;
                    border:none;
                    padding:8px 12px;
                    border-radius:6px;
                    cursor:pointer;
                    ">
                Hapus
            </button>

        </form>

    </td>

</tr>

@empty

<tr>
    <td colspan="7"
        style="
        padding:30px;
        text-align:center;
        color:#6b7280;
        ">
        Belum ada data barang
    </td>
</tr>

@endforelse

</tbody>

</table>

</div>



<style>

table tbody tr:hover{
    background:#f8fafc;
}



.card-stat{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.card-stat h4{
    color:#6b7280;
    margin-bottom:10px;
}

.card-stat h2{
    color:#111827;
}

</style>

@endsection