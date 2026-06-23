@extends('layouts.app')

@section('content')

<div style="margin-bottom:25px;">


<h1 style="
font-size:28px;
color:#111827;
margin-bottom:5px;">
    Edit User
</h1>

<p style="color:#6b7280;">
    Perbarui data akun Staff Gudang atau Chef.
</p>

</div>

{{-- Error --}}
@if ($errors->any())

<div class="alert-error">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">

<form action="{{ route('register.update',$user->id) }}"
      method="POST">


@csrf
@method('PUT')


<label><strong>Nama</strong></label>
<input type="text"
       name="nama"
       class="form-control"
       value="{{ old('nama',$user->nama) }}"
       required>


<label><strong>Username</strong></label>
<input type="text"
       name="username"
       class="form-control"
       value="{{ old('username',$user->username) }}"
       required>


<label><strong>Password Baru</strong></label>
<input type="password"
       name="password"
       class="form-control">

<small style="color:#6b7280;">
    Kosongkan jika tidak ingin mengubah password.
</small>


<br><br>


<label><strong>Role</strong></label>

<select name="role"
        class="form-control"
        required>

    <option value="staff_gudang"
        {{ $user->role=='staff_gudang' ? 'selected' : '' }}>
        Staff Gudang
    </option>

    <option value="chef"
        {{ $user->role=='chef' ? 'selected' : '' }}>
        Chef
    </option>

</select>


<div class="button-group">

    <button type="submit"
            class="btn-simpan">

        Update User

    </button>


    <a href="{{ route('register') }}"
       class="btn-kembali">

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
    max-width:650px;
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


.alert-error{
    background:#fee2e2;
    color:#991b1b;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}


.alert-error ul{
    margin:0;
    padding-left:20px;
}

</style>

@endsection
