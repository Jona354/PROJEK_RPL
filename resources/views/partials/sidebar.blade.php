<div style="width:250px; height:100vh; position:fixed; background:#111827; color:white;">
    <div style="padding:25px; font-size:24px; font-weight:bold; border-bottom:1px solid #374151;">
        SIGURESTO
    </div>

    <div style="padding:15px;">
        <a href="{{ url('/dashboard') }}" style="display:block;padding:12px;color:white;text-decoration:none;">Dashboard</a>
        <a href="{{ route('barang.index') }}" style="display:block;padding:12px;color:white;text-decoration:none;">Barang</a>
        <a href="{{ route('supplier.index') }}" style="display:block;padding:12px;color:white;text-decoration:none;">Supplier</a>
        <a href="{{ route('barang-masuk.index') }}" style="display:block;padding:12px;color:white;text-decoration:none;">Barang Masuk</a>
        <a href="{{ route('barang-keluar.index') }}" style="display:block;padding:12px;color:white;text-decoration:none;">Barang Keluar</a>
        
        <a href="{{ route('permintaan.index') }}" style="display:block;padding:12px;color:white;text-decoration:none;">Permintaan Barang</a>
        
        <a href="#" style="display:block;padding:12px;color:white;text-decoration:none;">Laporan</a>
    </div>
</div>