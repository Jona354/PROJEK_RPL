<div class="sidebar">

    <div class="logo">

        <div style="font-size:32px;margin-bottom:8px">
            <i class="fa-solid fa-warehouse"></i>
        </div>

        <div style="font-size:24px;font-weight:700">
            SIGURESTO
        </div>

        <div style="
        font-size:13px;
        opacity:.8;
        margin-top:5px;">
            Sistem Gudang Restoran
        </div>

    </div>


    <div class="menu">

        {{-- Dashboard --}}
        <a href="{{ url('/dashboard') }}">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>


        {{-- ADMIN GUDANG --}}
        @if(auth()->user()->role === 'admin_gudang')

            <a href="{{ route('barang.index') }}">
                <i class="fa-solid fa-boxes-stacked"></i>
                Data Barang
            </a>

            <a href="{{ route('supplier.index') }}">
                <i class="fa-solid fa-truck-field"></i>
                Supplier
            </a>

            <a href="{{ route('register') }}">
                <i class="fa-solid fa-users"></i>
                Kelola User
            </a>

            <a href="{{ route('admin.laporan.index') }}">
                <i class="fa-solid fa-file-lines"></i>
                Laporan
            </a>

        @endif


        {{-- STAFF GUDANG --}}
        @if(auth()->user()->role === 'staff_gudang')

            <a href="{{ route('barang-masuk.index') }}">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                Barang Masuk
            </a>

            <a href="{{ route('barang-keluar.index') }}">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Barang Keluar
            </a>

            <a href="{{ route('permintaan.index') }}">
                <i class="fa-solid fa-clipboard-list"></i>
                Permintaan Barang
            </a>

        @endif


        {{-- CHEF --}}
@if(auth()->user()->role === 'chef')

    <a href="{{ route('permintaan.index') }}">
        <i class="fa-solid fa-utensils"></i>
        Permintaan Barang
    </a>

@endif


        {{-- OWNER --}}
        @if(auth()->user()->role === 'owner')

            <a href="{{ route('owner.laporan.index') }}">
                <i class="fa-solid fa-chart-pie"></i>
                Laporan
            </a>

        @endif

    </div>

</div>
