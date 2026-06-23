@extends('layouts.app')

@section('content')

<style>

.detail-card{
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
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

.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.info-box{
    background:#f8fafc;
    border-radius:15px;
    padding:20px;
}

.info-box h4{
    color:#6b7280;
    margin-bottom:10px;
    font-size:15px;
}

.info-box h3{
    color:#111827;
    font-size:22px;
}

.btn-back{
    background:#2563eb;
    color:white;
    padding:12px 20px;
    border-radius:10px;
    text-decoration:none;
    display:inline-block;
    margin-top:30px;
}

.status-aman{
    color:#166534;
}

.status-menipis{
    color:#92400e;
}

.status-habis{
    color:#991b1b;
}

</style>


<h1 class="page-title">
    Detail Barang
</h1>

<p class="page-subtitle">
    Informasi lengkap data barang
</p>


<div class="detail-card">

    <div class="info-grid">

        <div class="info-box">
            <h4>Kode Barang</h4>
            <h3>{{ $barang->kode_barang }}</h3>
        </div>

        <div class="info-box">
            <h4>Nama Barang</h4>
            <h3>{{ $barang->nama }}</h3>
        </div>

        <div class="info-box">
            <h4>Kategori</h4>
            <h3>{{ $barang->kategori }}</h3>
        </div>

        <div class="info-box">
            <h4>Satuan</h4>
            <h3>{{ $barang->satuan }}</h3>
        </div>

        <div class="info-box">
            <h4>Supplier</h4>
            <h3>{{ $barang->supplier->nama ?? '-' }}</h3>
        </div>

        <div class="info-box">
            <h4>Harga Satuan</h4>
            <h3>
                Rp {{ number_format($barang->harga_satuan,0,',','.') }}
            </h3>
        </div>

        <div class="info-box">
            <h4>Stok Saat Ini</h4>

            @if($barang->stok_saat_ini <= 0)

                <h3 class="status-habis">
                    Habis ({{ $barang->stok_saat_ini }})
                </h3>

            @elseif($barang->stok_saat_ini <= $barang->stok_minimum)

                <h3 class="status-menipis">
                    Menipis ({{ $barang->stok_saat_ini }})
                </h3>

            @else

                <h3 class="status-aman">
                    Aman ({{ $barang->stok_saat_ini }})
                </h3>

            @endif

        </div>

        <div class="info-box">
            <h4>Stok Minimum</h4>
            <h3>{{ $barang->stok_minimum }}</h3>
        </div>

        <div class="info-box">
            <h4>Tanggal Kadaluarsa</h4>

            <h3>
                {{ $barang->tanggal_kadaluarsa
                ? $barang->tanggal_kadaluarsa->format('d-m-Y')
                : '-' }}
            </h3>
        </div>

    </div>


    <a href="{{ route('barang.index') }}"
       class="btn-back">
        ← Kembali
    </a>

</div>

@endsection
