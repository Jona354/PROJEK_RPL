<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIGURESTO</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f4f6f9;
        }

        .container{
            width:950px;
            height:550px;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
            display:flex;
        }

        .left{
            width:50%;
            background:linear-gradient(135deg,#1e3a8a,#2563eb);
            color:white;
            padding:50px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .left h1{
            font-size:42px;
            margin-bottom:15px;
        }

        .left p{
            font-size:18px;
            line-height:30px;
            opacity:.9;
        }

        .right{
            width:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px;
        }

        .login-box{
            width:100%;
            max-width:350px;
        }

        .login-box h2{
            margin-bottom:10px;
            color:#1f2937;
        }

        .login-box p{
            color:#6b7280;
            margin-bottom:30px;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
        }

        .form-control{
            width:100%;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:8px;
            outline:none;
        }

        .form-control:focus{
            border-color:#2563eb;
        }

        .btn-login{
            width:100%;
            padding:12px;
            border:none;
            background:#2563eb;
            color:white;
            font-size:16px;
            font-weight:bold;
            border-radius:8px;
            cursor:pointer;
            transition:.3s;
        }

        .btn-login:hover{
            background:#1d4ed8;
        }

        .alert{
            background:#fee2e2;
            color:#b91c1c;
            padding:10px;
            border-radius:8px;
            margin-bottom:20px;
        }

    </style>
</head>
<body>

<div class="container">

    <div class="left">
        <h1>SIGURESTO</h1>

        <p>
            Sistem Informasi Gudang Restoran
            untuk mengelola supplier,
            stok barang, transaksi masuk,
            transaksi keluar, dan laporan.
        </p>
    </div>

    <div class="right">

        <div class="login-box">

            <h2>Login</h2>

            <p>Silakan masuk ke sistem</p>

            @if(session('error'))
                <div class="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST">

                @csrf

                <div class="form-group">
                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>

                <button type="submit" class="btn-login">
                    Masuk
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>