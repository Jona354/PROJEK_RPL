@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h2>Tambah Barang Masuk</h2>
    <form action="{{ route('barang-masuk.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Barang:</label>
            <select name="barang_id" style="width: 100%; padding: 8px;" required>
                <option value="">-- Pilih Barang --</option>
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
        <div class="mb-3">
    <label class="form-label">Pilih Supplier:</label>
    <select name="supplier_id" class="form-control" required>
        <option value="">-- Pilih Supplier --</option>
        @foreach($suppliers as $s)
            <option value="{{ $s->id }}">{{ $s->nama }}</option>
        @endforeach
    </select>
</div>
        <div style="margin-bottom: 15px;">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" style="width: 100%; padding: 8px;" required>
        </div>
        <button type="submit" style="background: blue; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor:pointer;">Simpan Transaksi</button>
        <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection 