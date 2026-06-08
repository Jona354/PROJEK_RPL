@extends('layouts.app')

@section('content')

<div>
    <h1>Dashboard SIGURESTO</h1>

```
<hr>

<h3>
    Selamat Datang, {{ Auth::user()->nama }}
</h3>

<p>
    Anda login sebagai:
    <strong>{{ Auth::user()->role }}</strong>
</p>

<br>

<div style="display:flex; gap:20px; flex-wrap:wrap;">

    <div style="padding:20px; border:1px solid #ddd; width:200px;">
        <h4>Total Barang</h4>
        <h2>0</h2>
    </div>

    <div style="padding:20px; border:1px solid #ddd; width:200px;">
        <h4>Total Supplier</h4>
        <h2>0</h2>
    </div>

    <div style="padding:20px; border:1px solid #ddd; width:200px;">
        <h4>Barang Hampir Habis</h4>
        <h2>0</h2>
    </div>

    <div style="padding:20px; border:1px solid #ddd; width:200px;">
        <h4>Barang Kadaluarsa</h4>
        <h2>0</h2>
    </div>

</div>
```

</div>

@endsection
