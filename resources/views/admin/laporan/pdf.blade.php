<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; color: #1e293b; }
        .section-title { background: #3b82f6; color: white; padding: 10px; margin-top: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px; text-align: left; }
        td { border: 1px solid #e2e8f0; padding: 8px; }
        tr:nth-child(even) { background: #f1f5f9; }
    </style>
</head>
<body>
    <h2>Laporan Lengkap Gudang SIGURESTO</h2>
    <p style="text-align: center;">Tanggal: {{ date('d-m-Y') }}</p>

    <div class="section-title">1. Data Permintaan Barang</div>
    <table>
        <thead>
            <tr><th>Tanggal</th><th>Barang</th><th>Jumlah</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($permintaanBarang as $item)
<tr>
    <td>{{ $item->created_at->format('d/m/Y') }}</td>
    <td>{{ $item->barang->nama}}</td>
    <td>{{ $item->jumlah_diminta }}</td>
    <td>{{ $item->status }}</td>
    ID Barang: {{ $item->barang_id }} <br>
    Data: {{ $item->barang ? 'Ada' : 'Tidak Ada' }}
</tr>               @endforeach
        </tbody>
    </table>

    <div class="section-title">2. Data Barang Masuk</div>
    <table>
        <thead>
            <tr><th>Tanggal</th><th>Barang</th><th>Supplier</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            @foreach($masuk as $item)
            <tr><td>{{ $item->created_at->format('d/m/Y') }}</td><td>{{ $item->barang->nama}}</td><td>{{ $item->supplier->nama ?? '-' }}</td><td>{{ $item->jumlah }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">3. Data Barang Keluar</div>
    <table>
        <thead>
            <tr><th>Tanggal</th><th>Barang</th><th>Tujuan</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            @foreach($keluar as $item)
            <tr><td>{{ $item->created_at->format('d/m/Y') }}</td><td>{{ $item->barang->nama}}</td><td>{{ $item->tujuan }}</td><td>{{ $item->jumlah }}</td></tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>