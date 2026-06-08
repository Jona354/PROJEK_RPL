<!DOCTYPE html>
<html lang="en">
<head>
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
///
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

///

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

///
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

///

.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background:#111827;
    color:white;
}

.logo{
    padding:25px;
    font-size:24px;
    font-weight:700;
    border-bottom:1px solid #374151;
}

.menu{
    padding:15px;
}

.menu a{
    display:block;
    color:#d1d5db;
    text-decoration:none;
    padding:14px 18px;
    margin-bottom:8px;
    border-radius:10px;
    transition:.3s;
}

.menu a:hover{
    background:#2563eb;
    color:white;
}

//////

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
    margin-left:250px;
}

.main-content{
    padding:25px;
}

</style>

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
 
</body>
</html>