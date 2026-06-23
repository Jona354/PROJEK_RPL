@extends('layouts.app')

@section('content')

<div style="max-width:800px;margin:auto;">

    <div style="margin-bottom:25px;">

        <h1 style="font-size:28px;color:#111827;">
            Tambah Barang Masuk
        </h1>

        <p style="color:#6b7280;">
            Tambahkan transaksi barang masuk ke gudang.
        </p>

    </div>


    @if ($errors->any())

    <div class="alert-error">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif


    <div class="card-form">

        <form action="{{ route('barang-masuk.store') }}" method="POST">

            @csrf


            <label>Barang</label>

            <select name="barang_id" class="form-control" required>

                <option value="">
                    -- Pilih Barang --
                </option>

                @foreach($barang as $b)

                <option value="{{ $b->id }}">

                    {{ $b->nama }}

                </option>

                @endforeach

            </select>



            <label>Jumlah</label>

            <input
                type="number"
                name="jumlah"
                class="form-control"
                required>



            <label>No Faktur</label>

            <input
                type="text"
                name="no_faktur"
                class="form-control"
                required>



            <label>Supplier</label>

            <select name="supplier_id" class="form-control" required>

                <option value="">
                    -- Pilih Supplier --
                </option>

                @foreach($suppliers as $s)

                <option value="{{ $s->id }}">

                    {{ $s->nama }}

                </option>

                @endforeach

            </select>



            <label>Tanggal Masuk</label>

            <input
                type="date"
                name="tanggal"
                class="form-control"
                required>



            <label>Tanggal Kadaluarsa</label>

            <input
                type="date"
                name="tanggal_kadaluarsa"
                class="form-control">



            <div class="button-group">

                <button type="submit" class="btn-simpan">

                    Simpan Transaksi

                </button>


                <a href="{{ route('barang-masuk.index') }}"
                   class="btn-kembali">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>



<style>

.card-form{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.form-control{
    width:100%;
    padding:12px;
    border:1px solid #d1d5db;
    border-radius:10px;
    margin-top:8px;
    margin-bottom:20px;
    outline:none;
}

.form-control:focus{
    border-color:#2563eb;
}

.button-group{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.btn-simpan{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.btn-kembali{
    background:#6b7280;
    color:white;
    padding:12px 20px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}

.alert-error{
    background:#fee2e2;
    color:#991b1b;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

.alert-error ul{
    margin:0;
}

</style>

@endsection
