@extends('layouts.app')

@section('content')

<div class="card">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">
        <h2 style="color:#111827;">Laporan Gudang</h2>

        <div>

            <a href="{{ route('admin.laporan.export', ['jenis' => request('jenis'), 'format' => 'pdf']) }}"
               class="btn-danger">
                Export PDF
            </a>
        </div>
    </div>


    {{-- FILTER --}}
    <form action="{{ route('admin.laporan.index') }}"
          method="GET"
          style="display:flex;gap:10px;align-items:center;margin-bottom:25px;flex-wrap:wrap;">

        <select name="jenis"
                style="padding:8px;border:1px solid #ddd;border-radius:8px;">
            <option value="masuk"
                {{ request('jenis')=='masuk' ? 'selected' : '' }}>
                Barang Masuk
            </option>

            <option value="keluar"
                {{ request('jenis')=='keluar' ? 'selected' : '' }}>
                Barang Keluar
            </option>

            <option value="permintaan"
                {{ request('jenis')=='permintaan' ? 'selected' : '' }}>
                Permintaan Barang
            </option>
        </select>

        <label>Dari :</label>
        <input type="date"
               name="start_date"
               value="{{ request('start_date') }}"
               style="padding:8px;border:1px solid #ddd;border-radius:8px;">

        <label>Sampai :</label>
        <input type="date"
               name="end_date"
               value="{{ request('end_date') }}"
               style="padding:8px;border:1px solid #ddd;border-radius:8px;">

        <button type="submit" class="btn-primary">
            Filter
        </button>

        <a href="{{ route('admin.laporan.index') }}"
           class="btn-danger"
           style="text-decoration:none;">
            Reset
        </a>

    </form>


    {{-- LAPORAN BARANG MASUK --}}
    @if(request('jenis','masuk') == 'masuk')

<table class="table-modern">
    <thead>
<tr>
    <th>Tanggal</th>
    <th>No Faktur</th>
    <th>Barang</th>
    <th>Supplier</th>
    <th>Tgl Kadaluarsa</th>
    <th>Jumlah</th>
</tr>
</thead>

    <tbody>

    @foreach($barangMasuk as $l)
    <tr>
    <td>{{ date('d-m-Y', strtotime($l->tanggal)) }}</td>

    <td>{{ $l->no_faktur }}</td>

    <td>{{ $l->barang->nama ?? '-' }}</td>

    <td>
    {{ $l->supplier->nama ?? '-' }}
</td>

    <td>

        @if($l->barang && $l->barang->tanggal_kadaluarsa)

            @php
                $expired = \Carbon\Carbon::parse($l->barang->tanggal_kadaluarsa);
                $today = now();
            @endphp

            @if($expired->isPast())

                <span style="
                    background:#fee2e2;
                    color:#991b1b;
                    padding:5px 10px;
                    border-radius:20px;
                    font-size:12px;
                    font-weight:bold;
                ">
                    {{ $expired->format('d-m-Y') }}
                </span>

            @elseif($expired->diffInDays($today) <= 30)

                <span style="
                    background:#fef3c7;
                    color:#92400e;
                    padding:5px 10px;
                    border-radius:20px;
                    font-size:12px;
                    font-weight:bold;
                ">
                    {{ $expired->format('d-m-Y') }}
                </span>

            @else

                <span style="
                    background:#dcfce7;
                    color:#166534;
                    padding:5px 10px;
                    border-radius:20px;
                    font-size:12px;
                    font-weight:bold;
                ">
                    {{ $expired->format('d-m-Y') }}
                </span>

            @endif

        @else

            -

        @endif

    </td>

    <td>{{ $l->jumlah }}</td>

</tr>
    @endforeach

    </tbody>
</table>

@endif



    {{-- LAPORAN BARANG KELUAR --}}
    @if(request('jenis') == 'keluar')

<table class="table-modern">
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Tujuan</th>
    </tr>
    </thead>

    <tbody>

    @foreach($barangKeluar as $l)
    <tr>
        <td>{{ date('d-m-Y', strtotime($l->tanggal)) }}</td>
        <td>{{ $l->barang->nama ?? '-' }}</td>
        <td>{{ $l->jumlah }}</td>
        <td>{{ ucfirst($l->tujuan) }}</td>
    </tr>
    @endforeach

    </tbody>
</table>

@endif



    {{-- LAPORAN PERMINTAAN --}}
    @if(request('jenis') == 'permintaan')

<table class="table-modern">
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Chef</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Status</th>
    </tr>
    </thead>

    <tbody>

    @foreach($permintaans as $l)
    <tr>
        <td>{{ $l->created_at->format('d-m-Y') }}</td>
        <td>{{ $l->requester->nama ?? '-' }}</td>
        <td>{{ $l->barang->nama ?? '-' }}</td>
        <td>{{ $l->jumlah_diminta }}</td>
        <td>
            <span style="
                padding:5px 12px;
                border-radius:20px;
                font-size:12px;
                font-weight:bold;
                background:
                {{ $l->status=='disetujui'
                    ? '#dcfce7'
                    : ($l->status=='ditolak'
                        ? '#fee2e2'
                        : '#fef9c3') }};
                color:
                {{ $l->status=='disetujui'
                    ? '#166534'
                    : ($l->status=='ditolak'
                        ? '#991b1b'
                        : '#854d0e') }};
            ">
                {{ ucfirst($l->status) }}
            </span>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>

@endif

</div>

@endsection
