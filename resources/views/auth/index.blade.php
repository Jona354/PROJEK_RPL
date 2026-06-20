@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">

    <div>
        <h1 style="font-size:28px;color:#111827;">
            Kelola User
        </h1>

        <p style="color:#6b7280;">
            Kelola akun Staff Gudang dan Chef.
        </p>
    </div>


    <a href="{{ route('register.create') }}"
       style="
       background:#2563eb;
       color:white;
       padding:12px 20px;
       border-radius:10px;
       text-decoration:none;
       font-weight:600;
       ">
        + Tambah User
    </a>

</div>


@if(session('success'))

<div style="
    background:#dcfce7;
    color:#166534;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
">
    {{ session('success') }}
</div>

@endif


<div style="
background:white;
border-radius:12px;
overflow:hidden;
box-shadow:0 2px 10px rgba(0,0,0,.05);
">

<table style="
width:100%;
border-collapse:collapse;
">

    <thead>

        <tr style="background:#2563eb;color:white;">

            <th style="padding:15px;">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th width="180">Aksi</th>

        </tr>

    </thead>


    <tbody>

    @forelse($users as $user)

        <tr style="border-bottom:1px solid #e5e7eb;">

            <td style="padding:15px;">
                {{ $loop->iteration }}
            </td>


            <td>
                {{ $user->nama }}
            </td>


            <td>
                {{ $user->username }}
            </td>


            <td>

                @if($user->role == 'staff_gudang')

                    <span class="badge-staff">
                        Staff Gudang
                    </span>

                @elseif($user->role == 'chef')

                    <span class="badge-chef">
                        Chef
                    </span>

                @endif

            </td>


            <td>

                <button class="btn-edit">
                    Edit
                </button>


                <button class="btn-delete">
                    Hapus
                </button>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5"
                style="padding:30px;text-align:center;color:#6b7280;">

                Belum ada data user.

            </td>

        </tr>

    @endforelse


    </tbody>

</table>

</div>


<style>

table tbody tr:hover {
    background:#f8fafc;
}


.badge-staff {
    background:#dbeafe;
    color:#1e40af;
    padding:5px 12px;
    border-radius:20px;
}


.badge-chef {
    background:#fef3c7;
    color:#92400e;
    padding:5px 12px;
    border-radius:20px;
}


.btn-edit {
    background:#f59e0b;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}


.btn-delete {
    background:#ef4444;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}

</style>

@endsection
