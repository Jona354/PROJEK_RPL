@extends('layouts.app')

@section('content')

<h2>Edit Barang</h2>

<form action="{{ route('barang.update',$barang->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <br>

    <label>Kode Barang</label>
    <input type="text"
           name="kode_barang"
           value="{{ $barang->kode_barang }}"
           class="form-control">

    <br>

    <label>Nama Barang</label>
    <input type="text"
           name="nama"
           value="{{ $barang->nama }}"
           class="form-control">

    <br>

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

    <br>

    <label>Satuan</label>
    <input type="text"
           name="satuan"
           value="{{ $barang->satuan }}"
           class="form-control">

    <br>

    <label>Supplier</label>

    <select name="supplier_id"
            class="form-control">

        @foreach($suppliers as $supplier)

        <option value="{{ $supplier->id }}"
            {{ $barang->supplier_id == $supplier->id ? 'selected' : '' }}>

            {{ $supplier->nama }}

        </option>

        @endforeach

    </select>

    <br>

    <label>Stok Minimum</label>
    <input type="number"
           name="stok_minimum"
           value="{{ $barang->stok_minimum }}"
           class="form-control">

    <br>

    <label>Harga Satuan</label>
    <input type="number"
           name="harga_satuan"
           value="{{ $barang->harga_satuan }}"
           class="form-control">

    <br>

    <label>Tanggal Kadaluarsa</label>
    <input type="date"
           name="tanggal_kadaluarsa"
           value="{{ $barang->tanggal_kadaluarsa }}"
           class="form-control">

    <br>

    <button type="submit"
            class="btn-simpan">

        Update

    </button>

</form>

@endsection
