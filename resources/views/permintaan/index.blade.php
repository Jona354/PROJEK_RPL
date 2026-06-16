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
                <h3>Daftar Permintaan Barang</h3>
                @if(auth()->user()->role === 'chef')
                    <a href="{{ route('permintaan.create') }}" class="btn btn-primary">+ Buat Permintaan</a>
                @endif
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Chef/Bar</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        {{-- Header Aksi hanya muncul untuk Admin --}}
                        @if(auth()->user()->role === 'admin_gudang')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($permintaans as $p)
                    <tr>
                        <td>{{ $p->user->nama ?? 'N/A' }}</td>
                        <td>{{ $p->barang->nama ?? 'N/A' }}</td>
                        <td>{{ $p->jumlah_diminta }}</td>
                        <td>{{ $p->status }}</td>
                        
                        {{-- Kolom Aksi hanya muncul untuk Admin --}}
                        @if(auth()->user()->role === 'admin_gudang')
                            <td>
                                @if($p->status === 'pending')
                                    <form action="{{ route('permintaan.approve', $p->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                @else
                                    <span class="badge bg-secondary">{{ $p->status }}</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection