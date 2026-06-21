@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-4">
    <h2 class="text-primary">Riwayat Barang Keluar</h2>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $t)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                       <td>
    <span class="badge bg-secondary">
        {{ ucfirst($t->tujuan) }}
    </span>
</td>
                        <td>{{ $t->barang->nama ?? 'Barang Dihapus' }}</td>
                        <td><strong>{{ $t->jumlah }}</strong></td>
                        <td class="text-center">
                            <form action="{{ route('barang-keluar.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
