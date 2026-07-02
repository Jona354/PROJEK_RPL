@extends('layouts.app')

@section('content')

<style>

.form-card{
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.page-title{
    color:#1e3a8a;
    font-size:32px;
    margin-bottom:8px;
}

.page-subtitle{
    color:#6b7280;
    margin-bottom:30px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:#374151;
    font-weight:600;
}

.form-control{
    width:100%;
    padding:14px;
    border:1px solid #d1d5db;
    border-radius:12px;
    outline:none;
    transition:.3s;
    font-size:15px;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.15);
}

.button-group{
    margin-top:30px;
}

.btn-update{
    background:#2563eb;
    color:white;
    padding:12px 20px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-size:15px;
    font-weight:600;
}

.btn-kembali{
    background:#6b7280;
    color:white;
    padding:12px 20px;
    border-radius:10px;
    text-decoration:none;
    margin-left:10px;
}

</style>


<h1 class="page-title">
    Edit Barang
</h1>

<p class="page-subtitle">
    Perbarui informasi data barang SIGURESTO
</p>

<div class="form-card">

@if ($errors->any())
<div style="
background:#fee2e2;
color:#991b1b;
padding:15px;
border-radius:10px;
margin-bottom:20px;
">
    <ul style="margin:0;padding-left:18px;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('barang.update',$barang->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text"
               name="kode_barang"
               value="{{ $barang->kode_barang }}"
               class="form-control">
    </div>


    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text"
               name="nama"
               value="{{ $barang->nama }}"
               class="form-control">
    </div>


    <div class="form-group">
        <label>Kategori</label>

        <select name="kategori"
                class="form-control">

            <option value="Bahan Makanan"
            {{ $barang->kategori == 'Bahan Makanan' ? 'selected' : '' }}>
                Bahan Makanan
            </option>

            <option value="Minuman"
            {{ $barang->kategori == 'Minuman' ? 'selected' : '' }}>
                Minuman
            </option>

            <option value="Bumbu"
            {{ $barang->kategori == 'Bumbu' ? 'selected' : '' }}>
                Bumbu
            </option>

            <option value="Peralatan Dapur"
            {{ $barang->kategori == 'Peralatan Dapur' ? 'selected' : '' }}>
                Peralatan Dapur
            </option>

            <option value="Bahan Pembersih"
            {{ $barang->kategori == 'Bahan Pembersih' ? 'selected' : '' }}>
                Bahan Pembersih
            </option>

            <option value="Lainnya"
            {{ $barang->kategori == 'Lainnya' ? 'selected' : '' }}>
                Lainnya
            </option>

        </select>

    </div>

    <div class="form-group">
    <label>Satuan</label>

    <input type="text"
           name="satuan"
           value="{{ old('satuan', $barang->satuan) }}"
           class="form-control">
</div>


    <div class="form-group">
        <label>Stok Minimum</label>

        <input type="number"
               name="stok_minimum"
               value="{{ $barang->stok_minimum }}"
               class="form-control">
    </div>


    <div class="form-group">
        <label>Harga Satuan</label>

        <input type="number"
               name="harga_satuan"
               value="{{ $barang->harga_satuan }}"
               class="form-control">
    </div>


    <div class="form-group">
        <label>Tanggal Kadaluarsa</label>

        <input type="date"
               name="tanggal_kadaluarsa"
               value="{{ $barang->tanggal_kadaluarsa }}"
               class="form-control">
    </div>


    <div class="button-group">

        <button type="submit"
                class="btn-update">

            Update Barang

        </button>

        <a href="{{ route('barang.index') }}"
           class="btn-kembali">

            Kembali

        </a>

    </div>

</form>

</div>

@endsection
