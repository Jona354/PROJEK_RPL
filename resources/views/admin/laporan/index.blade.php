@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #111827;">Laporan Permintaan Barang</h2>
    </div>

    <form action="{{ route('laporan.index') }}" method="GET" style="display:flex; gap:10px; margin-bottom:25px; align-items:center;">
        <label>Dari:</label>
        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" style="padding: 8px; border-radius: 8px; border: 1px solid #ddd;">
        
        <label>Sampai:</label>
        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" style="padding: 8px; border-radius: 8px; border: 1px solid #ddd;">
        
        <button type="submit" class="btn-primary" style="cursor:pointer;">Filter</button>
        <a href="{{ route('laporan.index') }}" class="btn-danger" style="text-decoration:none;">Reset</a>
    </form>

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
            @foreach($permintaans as $p)
            <tr>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                <td>{{ $p->user->name ?? 'Chef' }}</td>
                <td>{{ $p->barang->nama ?? 'Barang' }}</td>
                <td>{{ $p->jumlah_diminta }}</td>
                <td>
                <span style="padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; display: inline-block;
    {{ $p->status == 'disetujui' ? 'background: #dcfce7; color: #166534;' : 'background: #fee2e2; color: #991b1b;' }}">
    {{ ucfirst($p->status) }}
</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection