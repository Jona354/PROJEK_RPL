@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">

    <div>
        <h1 style="font-size:28px;color:#111827;">
            Data Supplier
        </h1>

        <p style="color:#6b7280;">
            Kelola seluruh data supplier untuk kebutuhan inventaris gudang.
        </p>
    </div>

    <a href="{{ route('supplier.create') }}"
       style="
       background:#2563eb;
       color:white;
       padding:12px 20px;
       border-radius:10px;
       text-decoration:none;
       font-weight:600;
       ">
       + Tambah Supplier
    </a>

</div>


{{-- Pesan sukses --}}
@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif


{{-- Pesan error --}}
@if(session('error'))
<div class="alert-error">
    {{ session('error') }}
</div>
@endif


{{-- Statistik --}}
<div class="card-stat">
    <h4>Total Supplier</h4>
    <h2>{{ $totalSupplier }}</h2>
</div>


{{-- Pencarian --}}
<form action="{{ route('supplier.index') }}"
      method="GET"
      style="margin-bottom:20px;">

    <div class="search-box">

        <input
            type="text"
            name="search"
            placeholder="Cari nama atau kontak supplier..."
            value="{{ request('search') }}"
            class="input-search">

        <button type="submit" class="btn-cari">
            Cari
        </button>

        <a href="{{ route('supplier.index') }}"
           class="btn-reset">
            Reset
        </a>

    </div>

</form>


<div class="table-container">

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

    <td>
        {{ $supplier->nama }}
    </td>

    <td>
        {{ $supplier->kontak }}
    </td>

    <td>
        {{ $supplier->alamat }}
    </td>

    <td>

        <a href="{{ route('supplier.edit',$supplier->id) }}"
            class="btn-edit">

            Edit

        </a>


        <form
    action="{{ route('supplier.destroy',$supplier->id) }}"
    method="POST"
    style="display:inline;"
    class="delete-form">

    @csrf
    @method('DELETE')

    <button
        type="button"
        class="btn-delete delete-btn">

        Hapus

    </button>

</form>

    </td>

</tr>


@empty

<tr>

<td colspan="5"
    style="padding:30px;text-align:center;color:#6b7280;">

    Data supplier tidak ditemukan.

</td>

</tr>

@endforelse


</tbody>

</table>

</div>



<style>


/* Statistik */

.card-stat{
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:20px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.card-stat h4{
    color:#6b7280;
    margin-bottom:10px;
}

.card-stat h2{
    color:#111827;
}



/* Alert */

.alert-success{
    background:#dcfce7;
    color:#166534;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}


.alert-error{
    background:#fee2e2;
    color:#991b1b;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}



/* Pencarian */

.search-box{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);

    display:flex;
    gap:10px;
}


.input-search{
    flex:1;
    padding:10px;
    border:1px solid #d1d5db;
    border-radius:8px;
}


.btn-cari{
    background:#2563eb;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:8px;
    cursor:pointer;
}


.btn-reset{
    background:#6b7280;
    color:white;
    padding:10px 20px;
    border-radius:8px;
    text-decoration:none;
}



/* Tabel */

.table-container{
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}


.table{
    width:100%;
    border-collapse:collapse;
}


.table thead tr{
    background:#2563eb;
    color:white;
}


.table th,
.table td{
    padding:15px;
}


.table tbody tr{
    border-bottom:1px solid #e5e7eb;
}


.table tbody tr:hover{
    background:#f8fafc;
}



/* Tombol */

.btn-edit{
    background:#f59e0b;
    color:white;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
}


.btn-delete{
    background:#ef4444;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}


</style>
<script>

document.querySelectorAll('.delete-btn').forEach(button => {

    button.addEventListener('click', function(){

        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Hapus Supplier?',
            text: 'Data supplier yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});

</script>

@endsection
