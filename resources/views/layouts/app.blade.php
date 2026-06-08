<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SIGURESTO</title>

<style>

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