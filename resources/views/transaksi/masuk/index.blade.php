@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">

    <div>
        <h1 style="font-size:28px;color:#111827;">
            Riwayat Barang Masuk
        </h1>

        <p style="color:#6b7280;">
            Kelola seluruh transaksi barang masuk ke gudang.
        </p>
    </div>

    <a href="{{ route('barang-masuk.create') }}"
       class="btn-tambah">

        + Tambah Barang Masuk

    </a>

</div>


@if(session('success'))

<div class="alert-success">

    {{ session('success') }}

</div>

@endif



<div class="table-container">

<table class="table">

<thead>

<tr>

    <th>Tanggal Masuk</th>
    <th>No. Faktur</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
    <th>Tgl Kadaluarsa</th>
    <th width="150">Aksi</th>

</tr>

</thead>


<tbody>

@forelse($transaksi as $t)

<tr>

    <td>

        {{ date('d-m-Y', strtotime($t->tanggal)) }}

    </td>


    <td>

        <span class="badge-faktur">

            {{ $t->no_faktur }}

        </span>

    </td>


    <td>

        {{ $t->barang->nama ?? 'Barang Dihapus' }}

    </td>


    <td>

        <span class="badge-jumlah">

            {{ $t->jumlah }}

        </span>

    </td>


    <td>

        @if($t->barang && $t->barang->tanggal_kadaluarsa)

            {{ date('d-m-Y', strtotime($t->barang->tanggal_kadaluarsa)) }}

        @else

            -

        @endif

    </td>


    <td>

        <form
            action="{{ route('barang-masuk.destroy',$t->id) }}"
            method="POST"
            style="display:inline;">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Hapus transaksi ini?')"
                class="btn-delete">

                Hapus

            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="6"
        style="padding:30px;text-align:center;color:#6b7280;">

        Belum ada transaksi barang masuk.

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>



<style>

/* Alert */

.alert-success{
    background:#dcfce7;
    color:#166534;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}



/* Tombol tambah */

.btn-tambah{
    background:#2563eb;
    color:white;
    padding:12px 20px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}



/* Container tabel */

.table-container{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}



/* Tabel */

.table{
    width:100%;
    border-collapse:collapse;
}

.table thead tr{
    background:#2563eb;
    color:white;
}

.table th,
.table td{
    padding:15px;
}

.table tbody tr{
    border-bottom:1px solid #e5e7eb;
}

.table tbody tr:hover{
    background:#f8fafc;
}



/* Badge */

.badge-faktur{
    background:#e5e7eb;
    color:#374151;
    padding:5px 12px;
    border-radius:20px;
    font-size:14px;
}

.badge-jumlah{
    background:#dcfce7;
    color:#166534;
    padding:5px 12px;
    border-radius:20px;
    font-weight:600;
}



/* Tombol hapus */

.btn-delete{
    background:#ef4444;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.btn-delete:hover{
    background:#dc2626;
}

</style>

@endsection
