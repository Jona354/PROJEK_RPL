@extends('layouts.app')

@section('content')

<div style="margin-bottom:25px;">

    <h1 style="
    font-size:28px;
    color:#111827;
    margin-bottom:5px;
    ">
        Tambah Barang
    </h1>

    <p style="color:#6b7280;">
        Tambahkan data barang baru ke inventaris gudang.
    </p>

</div>

<div style="
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 2px 10px rgba(0,0,0,.08);
">

<form action="{{ route('barang.store') }}" method="POST">
    @csrf

    <div style="
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    ">

        <!-- Kode Barang -->
        <div>
            <label><strong>Kode Barang</strong></label>

            <input type="text"
                   name="kode_barang"
                   class="form-control">
        </div>

        <!-- Nama Barang -->
        <div>
            <label><strong>Nama Barang</strong></label>

            <input type="text"
                   name="nama"
                   class="form-control">
        </div>

<!-- Kategori -->
<div>
    <label><strong>Kategori</strong></label>

    <select name="kategori" class="form-control" required>

        <option value="">
            Pilih Kategori
        </option>

        <option value="Bahan Makanan">
            Bahan Makanan
        </option>

        <option value="Minuman">
            Minuman
        </option>

        <option value="Bumbu">
            Bumbu
        </option>

        <option value="Peralatan Dapur">
            Peralatan Dapur
        </option>

        <option value="Bahan Pembersih">
            Bahan Pembersih
        </option>

        <option value="Lainnya">
            Lainnya
        </option>

    </select>
</div>

        <!-- Satuan -->
        <div>
            <label><strong>Satuan</strong></label>

            <input type="text"
                   name="satuan"
                   class="form-control">
        </div>


        <!-- Stok Minimum -->
        <div>
            <label><strong>Stok Minimum</strong></label>

            <input type="number"
                   name="stok_minimum"
                   class="form-control">
        </div>

        <!-- Harga -->
        <div>
            <label><strong>Harga Satuan</strong></label>

            <input type="number"
                   name="harga_satuan"
                   class="form-control">
        </div>

        <!-- Kadaluarsa -->
        <div>
            <label><strong>Tanggal Kadaluarsa</strong></label>

            <input type="date"
                   name="tanggal_kadaluarsa"
                   class="form-control">
        </div>

    </div>

    <div style="
    margin-top:30px;
    display:flex;
    gap:15px;
    ">

        <button type="submit"
        style="
        background:#2563eb;
        color:white;
        border:none;
        padding:12px 25px;
        border-radius:8px;
        cursor:pointer;
        font-weight:600;
        ">
            Simpan Barang
        </button>

        <a href="{{ route('barang.index') }}"
        style="
        background:#e5e7eb;
        color:#111827;
        padding:12px 25px;
        border-radius:8px;
        text-decoration:none;
        font-weight:600;
        ">
            Kembali
        </a>

    </div>

</form>

</div>

<style>

.form-control{
    width:100%;
    margin-top:8px;
    padding:12px;
    border:1px solid #d1d5db;
    border-radius:8px;
    outline:none;
}

.form-control:focus{
    border-color:#2563eb;
}

</style>

@endsection
