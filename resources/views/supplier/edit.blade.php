@extends('layouts.app')

@section('content')

<h2>Edit Supplier</h2>

<br>

<form action="{{ route('supplier.update',$supplier->id) }}" method="POST">

    @csrf
    @method('PUT')

    <label>Nama Supplier</label>
    <br>
    <input
        type="text"
        name="nama"
        value="{{ $supplier->nama }}"
        required>
    <br><br>

    <label>Kontak</label>
    <br>
    <input
        type="text"
        name="kontak"
        value="{{ $supplier->kontak }}"
        required>
    <br><br>

    <label>Alamat</label>
    <br>
    <textarea
        name="alamat"
        rows="4"
        required>{{ $supplier->alamat }}</textarea>

    <br><br>

    <button type="submit">
        Update
    </button>

    <a href="{{ route('supplier.index') }}">
        Kembali
    </a>

</form>

@endsection