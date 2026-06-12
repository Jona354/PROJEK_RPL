@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 20px auto; background: white; padding: 20px; border-radius: 8px;">
    <h2>Tambah Barang Masuk</h2>
    <form action="{{ route('barang-masuk.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Barang:</label>
            <select name="barang_id" style="width: 100%; padding: 8px;">
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" style="width: 100%; padding: 8px;" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>No Faktur:</label>
            <input type="text" name="no_faktur" style="width: 100%; padding: 8px;" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" style="width: 100%; padding: 8px;" required>
        </div>
        <button type="submit" style="background: blue; color: white; padding: 10px 20px; border: none; border-radius: 4px;">Simpan Transaksi</button>
    </form>
</div>
@endsection