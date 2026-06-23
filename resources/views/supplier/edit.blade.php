@extends('layouts.app')

@section('content')

<style>

.page-title{
    color:#1e3a8a;
    font-size:36px;
    font-weight:700;
    margin-bottom:8px;
}

.page-subtitle{
    color:#6b7280;
    margin-bottom:30px;
}

.form-card{
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    max-width:700px;
}

.form-group{
    margin-bottom:25px;
}

.form-label{
    display:block;
    font-weight:600;
    color:#374151;
    margin-bottom:10px;
}

.form-control{
    width:100%;
    padding:14px 16px;
    border:1px solid #d1d5db;
    border-radius:12px;
    outline:none;
    font-size:15px;
    transition:.3s;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.15);
}

.button-group{
    display:flex;
    gap:15px;
    margin-top:30px;
}

.btn-update{
    background:#10b981;
    color:white;
    border:none;
    padding:14px 24px;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    transition:.3s;
}

.btn-update:hover{
    background:#059669;
}

.btn-back{
    background:#ef4444;
    color:white;
    text-decoration:none;
    padding:14px 24px;
    border-radius:12px;
    font-weight:600;
    transition:.3s;
}

.btn-back:hover{
    background:#dc2626;
}

</style>


<h1 class="page-title">
    Edit Supplier
</h1>

<p class="page-subtitle">
    Perbarui data supplier pada sistem SIGURESTO
</p>


<div class="form-card">

    <form action="{{ route('supplier.update', $supplier->id) }}"
          method="POST">

        @csrf
        @method('PUT')


        <div class="form-group">

            <label class="form-label">
                Nama Supplier
            </label>

            <input
                type="text"
                name="nama"
                class="form-control"
                value="{{ $supplier->nama }}"
                required>

        </div>


        <div class="form-group">

            <label class="form-label">
                Kontak
            </label>

            <input
                type="text"
                name="kontak"
                class="form-control"
                value="{{ $supplier->kontak }}"
                required>

        </div>


        <div class="form-group">

            <label class="form-label">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="5"
                class="form-control"
                required>{{ $supplier->alamat }}</textarea>

        </div>


        <div class="button-group">

            <button type="submit"
                    class="btn-update">
                Update Supplier
            </button>

            <a href="{{ route('supplier.index') }}"
               class="btn-back">
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection
