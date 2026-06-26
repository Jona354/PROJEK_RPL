<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIGURESTO</title>

    <style>

        .password-box{
    position:relative;
}

.toggle-password{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    font-size:18px;
    color:#6b7280;
}

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#0f172a,#1d4ed8);
        }

        .container{
            width:1000px;
            max-width:95%;
            height:580px;
            background:white;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 20px 40px rgba(0,0,0,.25);
            display:flex;
        }

        .left{
            width:50%;
            background:linear-gradient(135deg,#1e3a8a,#2563eb);
            color:white;
            padding:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .logo{
            font-size:55px;
            margin-bottom:20px;
        }

        .left h1{
            font-size:55px;
            margin-bottom:20px;
            font-weight:700;
        }

        .left p{
            font-size:22px;
            line-height:40px;
            opacity:.9;
        }

        .right{
            width:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:50px;
        }

        .login-box{
            width:100%;
            max-width:380px;
        }

        .login-box h2{
            font-size:42px;
            color:#1f2937;
            margin-bottom:10px;
        }

        .login-box p{
            color:#6b7280;
            margin-bottom:40px;
            font-size:18px;
        }

        .form-group{
            margin-bottom:25px;
        }

        .form-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
            color:#111827;
        }

        .form-control{
            width:100%;
            height:55px;
            padding:0 18px;
            border:1px solid #d1d5db;
            border-radius:15px;
            outline:none;
            font-size:16px;
            transition:.3s;
        }

        .form-control:focus{
            border-color:#2563eb;
            box-shadow:0 0 10px rgba(37,99,235,.3);
        }

        .btn-login{
            width:100%;
            height:55px;
            border:none;
            border-radius:15px;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:white;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
            transition:.3s;
        }

        .btn-login:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 20px rgba(37,99,235,.3);
        }

        .alert{
            background:#fee2e2;
            color:#b91c1c;
            padding:15px;
            border-radius:12px;
            margin-bottom:25px;
        }

        .footer{
            margin-top:25px;
            text-align:center;
            color:#9ca3af;
            font-size:14px;
        }

        @media(max-width:850px){

            .container{
                flex-direction:column;
                height:auto;
            }

            .left,
            .right{
                width:100%;
            }

            .left{
                padding:40px;
            }

            .left h1{
                font-size:40px;
            }

            .left p{
                font-size:18px;
                line-height:32px;
            }

        }

    </style>
</head>
<body>

<div class="container">

    <div class="left">

        <div class="logo">
            📦
        </div>

        <h1>SIGURESTO</h1>

        <p>
            Sistem Informasi Gudang Restoran untuk mengelola supplier,
            stok barang, transaksi masuk, transaksi keluar,
            permintaan barang, dan laporan secara mudah dan efisien.
        </p>

    </div>

    <div class="right">

        <div class="login-box">

            <h2>Login</h2>

            <p>Silakan masuk ke sistem</p>

     @if(session('login_error'))
<div class="alert">
    Username atau password yang Anda masukkan tidak sesuai.
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
                        placeholder="Masukkan username"
                        required>

                </div>

              <div class="form-group">
    <label>Password</label>

    <div class="password-box">
        <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            placeholder="Masukkan password"
            required
        >

        <span class="toggle-password" onclick="togglePassword()">
            👁
        </span>
    </div>
</div>

                <button type="submit" class="btn-login">
                    Masuk
                </button>

            </form>

            <div class="footer">
                © 2026 SIGURESTO | Sistem Informasi Gudang Restoran
            </div>

        </div>

    </div>

</div>
<script>
function togglePassword() {

    let password = document.getElementById('password');

    if(password.type === "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }

}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('login_error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Login Gagal',
    text: 'Username atau password yang Anda masukkan tidak sesuai.',
    confirmButtonColor: '#2563eb',
    confirmButtonText: 'Coba Lagi'
});
</script>
@endif

</body>
</html>
