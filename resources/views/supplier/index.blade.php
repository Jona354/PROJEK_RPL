@extends('layouts.app')

@section('content')

<h2>Data Supplier</h2>

<br>

<a href="{{ route('supplier.create') }}" class="btn-tambah">
    + Tambah Supplier
</a>

<br><br>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Kontak</th>
            <th>Alamat</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($suppliers as $supplier)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $supplier->nama }}</td>
            <td>{{ $supplier->kontak }}</td>
            <td>{{ $supplier->alamat }}</td>

            <td>

                <a href="{{ route('supplier.edit',$supplier->id) }}"
                    class="btn-edit">
                    Edit
                </a>

                <form
                    action="{{ route('supplier.destroy',$supplier->id) }}"
                    method="POST"
                    style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Hapus supplier ini?')"
                        class="btn-delete">

                        Hapus

                    </button>

                </form>

            </td>
        </tr>

        @empty

        <tr>
            <td colspan="5">
                Data supplier belum ada
            </td>
        </tr>

        @endforelse

    </tbody>
</table>

<style>

.table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

.table th,
.table td{
    border:1px solid #ddd;
    padding:12px;
}

.btn-tambah{
    background:#2563eb;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:6px;
}

.btn-edit{
    background:orange;
    color:white;
    padding:6px 10px;
    border-radius:5px;
    text-decoration:none;
}

.btn-delete{
    background:red;
    color:white;
    border:none;
    padding:6px 10px;
    border-radius:5px;
    cursor:pointer;
}

.alert-success{
    background:#dcfce7;
    padding:10px;
    margin-bottom:15px;
}

</style>

@endsection