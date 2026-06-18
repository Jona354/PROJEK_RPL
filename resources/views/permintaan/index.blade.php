@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="text-primary mb-4">Daftar Permintaan Barang</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="header-permintaan" style="display: flex; justify-content: space-between; align-items: center;">
                <h3></h3>
                @if(auth()->user()->role === 'chef')
                    <a href="{{ route('permintaan.create') }}" class="btn btn-primary">+ Buat Permintaan</a>
                @endif
            </div>

            <div style="background:white; border-radius:15px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,.08); margin-top:20px;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="background:#2563eb;color:white;">
                            <th style="padding:15px;">Chef/Bar</th>
                            <th>Barang</th>
                            <th>Catatan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            @if(auth()->user()->role == 'admin_gudang')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permintaans as $p)
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td style="padding:15px;">{{ $p->user->nama ?? '-' }}</td>
                                <td>{{ $p->barang->nama ?? '-' }}</td>
                                <td style="padding:15px; font-style: italic; color: #555;">{{ $p->keterangan ?? '-' }}</td>
                                <td style="text-align:center;">{{ $p->jumlah_diminta }}</td>
                                <td style="text-align:center;">
                                    @if($p->status == 'pending')
                                        <span style="background:#fef3c7; color:#92400e; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">Pending</span>
                                    @elseif($p->status == 'disetujui')
                                        <span style="background:#dcfce7; color:#166534; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">Disetujui</span>
                                    @else
                                        <span style="background:#fee2e2; color:#991b1b; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">Ditolak</span>
                                    @endif
                                </td>

                                @if(auth()->user()->role == 'admin_gudang')
                                    <td style="text-align:center;">
                                        @if($p->status == 'pending')
                                            <div style="display:flex;gap:8px;justify-content:center;">
                                                <form action="{{ route('permintaan.approve',$p->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" style="background:#16a34a; color:white; border:none; padding:8px 12px; border-radius:8px; cursor:pointer;">✓ Setujui</button>
                                                </form>
                                                <form action="{{ route('permintaan.reject',$p->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" style="background:#dc2626; color:white; border:none; padding:8px 12px; border-radius:8px; cursor:pointer;">✕ Tolak</button>
                                                </form>
                                            </div>
                                        @else
                                            <span style="color:#6b7280;">Selesai</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding:30px; text-align:center; color:#6b7280;">
                                    Belum ada permintaan barang
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    tbody tr:hover{ background:#f9fafb; transition:.2s; }
</style>
@endsection