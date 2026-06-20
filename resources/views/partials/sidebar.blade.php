<div style="width:250px; height:100vh; position:fixed; background:#111827; color:white;">
    <div style="padding:25px; font-size:24px; font-weight:bold; border-bottom:1px solid #374151;">
        SIGURESTO
    </div>

    <div style="padding:15px;">

        {{-- Dashboard untuk semua role --}}
        <a href="{{ url('/dashboard') }}"
           style="display:block;padding:12px;color:white;text-decoration:none;">
           Dashboard
        </a>


        {{-- ADMIN GUDANG --}}
        @if(auth()->user()->role === 'admin_gudang')

            <a href="{{ route('barang.index') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Data Barang
            </a>

            <a href="{{ route('supplier.index') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Supplier
            </a>

            <a href="{{ route('register') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Kelola User
            </a>

            <a href="{{ route('laporan.index') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Laporan
            </a>

        @endif


        {{-- STAFF GUDANG --}}
        @if(auth()->user()->role === 'staff_gudang')

            <a href="{{ route('barang-masuk.index') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Barang Masuk
            </a>

            <a href="{{ route('barang-keluar.index') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Barang Keluar
            </a>

            <a href="{{ route('permintaan.index') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Permintaan Barang
            </a>

        @endif


        {{-- CHEF --}}
        @if(auth()->user()->role === 'chef')

            <a href="{{ route('permintaan.create') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Buat Permintaan Barang
            </a>

        @endif


        {{-- OWNER --}}
        @if(auth()->user()->role === 'owner')

            <a href="{{ route('owner.laporan') }}"
               style="display:block;padding:12px;color:white;text-decoration:none;">
               Laporan
            </a>

        @endif

    </div>
</div>
