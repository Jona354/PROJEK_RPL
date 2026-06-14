@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="text-primary mb-4">Daftar Permintaan Barang</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Chef/Bar</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permintaan as $p)
                    <tr>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->barang->nama }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>
                            <span class="badge {{ $p->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'pending')
                                <form action="{{ route('permintaan.approve', $p->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection