<!DOCTYPE html>
<html>
<head>
    <title>SIGURESTO</title>

    <style>

        body{
            margin:0;
            font-family:Arial, sans-serif;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:250px;
            background:#2c3e50;
            color:white;
            padding:20px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            margin-bottom:10px;
        }

        .sidebar a:hover{
            color:#f1c40f;
        }

        .content{
            flex:1;
        }

        .navbar{
            background:#34495e;
            color:white;
            padding:15px;
        }

        .main-content{
            padding:20px;
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

</body>
</html>