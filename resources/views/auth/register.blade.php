<!DOCTYPE html>
<html>
<head>
    <title>Tambah User - SIGURESTO</title>
</head>
<body>

<h2>Tambah User Baru</h2>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf

    <label>Nama</label><br>
    <input type="text" name="nama" required>
    <br><br>

    <label>Username</label><br>
    <input type="text" name="username" required>
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>
    <br><br>

    <label>Role</label><br>
    <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin_gudang">Admin Gudang</option>
        <option value="staff_gudang">Staff Gudang</option>
        <option value="chef">Chef</option>
        <option value="owner">Owner</option>
    </select>
    <br><br>

    <button type="submit">
        Tambah User
    </button>

</form>

</body>
</html>
