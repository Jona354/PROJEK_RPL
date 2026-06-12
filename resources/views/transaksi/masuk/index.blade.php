@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">
    <div>
        <h1 style="font-size:28px;color:#111827;">Riwayat Barang Masuk</h1>
        <p style="color:#6b7280;">Daftar seluruh transaksi masuk ke gudang</p>
    </div>
</div>

<div style="background:white;border-radius:12px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.05);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#2563eb;color:white;">
                <th style="padding:15px;text-align:left;">Tanggal</th>
                <th style="text-align:left;">No. Faktur</th>
                <th style="text-align:left;">Barang</th>
                <th style="text-align:left;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
            <tr style="border-bottom:1px solid #e5e7eb;">
                <td style="padding:15px;">{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                <td>{{ $item->no_faktur }}</td>
                <td>{{ $item->barang->nama ?? 'Barang Dihapus' }}</td>
                <td>
                    <span style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:20px;font-size:12px;">
                        + {{ $item->jumlah }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding:30px;text-align:center;color:#6b7280;">Belum ada data transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection