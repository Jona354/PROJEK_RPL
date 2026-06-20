@extends('layouts.app')

@section('content')

<div style="margin-bottom:25px;">

    <h1 style="
    font-size:28px;
    color:#111827;
    margin-bottom:5px;">
        Kelola User
    </h1>

    <p style="color:#6b7280;">
        Tambahkan akun Staff Gudang dan Chef.
    </p>

</div>


{{-- Pesan berhasil --}}
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif


{{-- Pesan error --}}
@if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card">

<form action="{{ route('register') }}" method="POST">

    @csrf


    <label><strong>Nama</strong></label>
    <input type="text"
           name="nama"
           class="form-control"
           value="{{ old('nama') }}"
           required>


    <label><strong>Username</strong></label>
    <input type="text"
           name="username"
           class="form-control"
           value="{{ old('username') }}"
           required>


    <label><strong>Password</strong></label>
    <input type="password"
           name="password"
           class="form-control"
           required>


    <label><strong>Role</strong></label>
    <select name="role"
            class="form-control"
            required>

        <option value="">
            -- Pilih Role --
        </option>

        <option value="staff_gudang"
            {{ old('role') == 'staff_gudang' ? 'selected' : '' }}>
            Staff Gudang
        </option>

        <option value="chef"
            {{ old('role') == 'chef' ? 'selected' : '' }}>
            Chef
        </option>

    </select>


    <div class="button-group">

        <button type="submit" class="btn-simpan">
            Simpan User
        </button>

        <a href="{{ route('dashboard') }}" class="btn-kembali">
            Kembali
        </a>

    </div>

</form>

</div>


<style>

.card{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    max-width:600px;
}


.form-control{
    width:100%;
    margin-top:8px;
    margin-bottom:20px;
    padding:12px;
    border:1px solid #d1d5db;
    border-radius:8px;
    outline:none;
}


.form-control:focus{
    border-color:#2563eb;
}


.button-group{
    display:flex;
    gap:10px;
}


.btn-simpan{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}


.btn-kembali{
    background:#e5e7eb;
    color:#111827;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
}


.alert-success{
    background:#dcfce7;
    color:#166534;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;
}


.alert-error{
    background:#fee2e2;
    color:#991b1b;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;
}


.alert-error ul{
    margin:0;
    padding-left:20px;
}

</style>

@endsection
