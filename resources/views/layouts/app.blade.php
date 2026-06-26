<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIGURESTO</title>

    <style>
        .btn-primary{
            background:#2563eb;
            color:white;
            padding:10px 18px;
            border-radius:8px;
            text-decoration:none;
        }

        .btn-warning{
            background:#f59e0b;
            color:white;
            padding:8px 12px;
            border:none;
            border-radius:8px;
        }

        .btn-danger{
            background:#ef4444;
            color:white;
            padding:8px 12px;
            border:none;
            border-radius:8px;
        }

        .table-modern{
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .table-modern th{
            background:#2563eb;
            color:white;
            padding:15px;
            text-align:left;
        }

        .table-modern td{
            padding:15px;
            border-bottom:1px solid #eee;
        }

        .stats{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .card h4{
            color:#6b7280;
            margin-bottom:10px;
        }

        .card h2{
            font-size:32px;
        }

        .navbar{
            height:75px;
            background:white;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 30px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .user-info{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .btn-logout{
            background:#ef4444;
            border:none;
            color:white;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
        }

        .sidebar{
            width:270px;
            height:100vh;
            position:fixed;
            background:linear-gradient(180deg,#1e3a8a,#2563eb);
            color:white;
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .logo{
            padding:30px;
            border-bottom:1px solid rgba(255,255,255,.15);
        }

        .menu{
            padding:20px;
        }

        .menu a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 20px;
            margin-bottom:12px;
            border-radius:15px;
            transition:.3s;
            font-weight:500;
        }

        .menu a:hover{
            background:rgba(255,255,255,.18);
            transform:translateX(8px);
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .content{
            flex:1;
            margin-left:270px;
        }

        .main-content{
            padding:25px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="wrapper">

    @include('partials.sidebar')

    <div class="content">

        @include('partials.navbar')

        <div class="main-content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('click', function (e) {
        // Deteksi jika elemen yang diklik memiliki class '.btn-logout' 
        // atau berada di dalam tombol/link logout
        const logoutBtn = e.target.closest('.btn-logout, [href*="logout"]');
        
        if (logoutBtn) {
            e.preventDefault(); // Menghentikan redirect atau submit instan bawaan browser

            Swal.fire({
                title: 'Konfirmasi Keluar',
                text: 'Apakah Anda yakin ingin mengakhiri sesi di SIGURESTO?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb', // Menyesuaikan warna tema biru primer Anda
                cancelButtonColor: '#ef4444',  // Menyesuaikan warna merah .btn-danger Anda
                confirmButtonText: '<i class="fa fa-sign-out-alt"></i> Ya, Logout',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading screen transisi
                    Swal.fire({
                        title: 'Mengakhiri Sesi...',
                        text: 'Harap tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Cari form logout terdekat, jika tidak ada cari form id #logout-form global
                    const associatedForm = logoutBtn.closest('form') || document.getElementById('logout-form');
                    
                    if (associatedForm) {
                        associatedForm.submit();
                    } else {
                        // Jalankan skenario fallback jika tombol berupa link murni tanpa penampung form
                        const fallbackForm = document.createElement('form');
                        fallbackForm.method = 'POST';
                        fallbackForm.action = "{{ route('logout') }}";
                        
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        
                        fallbackForm.appendChild(csrfInput);
                        document.body.appendChild(fallbackForm);
                        fallbackForm.submit();
                    }
                }
            });
        }
    });
</script>
@if(session('login_success'))
<script>
document.addEventListener('DOMContentLoaded', function(){

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session("message") }}',
        showConfirmButton: false,
        timer:  3500,
        timerProgressBar: true
    });

});
</script>
@endif

@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session("message") }}',
    showConfirmButton: false,
    timer: 1800,
    timerProgressBar: true
});
</script>
@endif
</body>
</html>