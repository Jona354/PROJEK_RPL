@extends('layouts.app')

@section('content')

<h2>Tambah Supplier</h2>

<br>

<form action="{{ route('supplier.store') }}" method="POST">

    @csrf

    <label>Nama Supplier</label>
    <br>
    <input type="text" name="nama" required>
    <br><br>

    <label>Kontak</label>
    <br>
    <input type="text" name="kontak" required>
    <br><br>

    <label>Alamat</label>
    <br>
    <textarea name="alamat" rows="4" required></textarea>
    <br><br>

    <button type="submit">
        Simpan
    </button>

    <a href="{{ route('supplier.index') }}">
        Kembali
    </a>

</form>

@endsection