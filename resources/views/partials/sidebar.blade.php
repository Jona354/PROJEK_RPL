<div class="sidebar">

    <h2>SIGURESTO</h2>

    <p>
        {{ Auth::user()->nama }}
    </p>

    <hr>

    <a href="/dashboard">
        Dashboard
    </a>

    {{-- Owner dan Admin Gudang --}}
    @if(in_array(auth()->user()->role, ['owner', 'admin_gudang']))

        <a href="#">
            Supplier
        </a>

    @endif

    {{-- Selain Chef --}}
    @if(auth()->user()->role != 'chef')

        <a href="#">
            Barang
        </a>

            <a href="#">
                Transaksi Masuk
            </a>

            <a href="#">
                Transaksi Keluar
            </a>

    @endif

    {{-- Chef --}}
    @if(auth()->user()->role == 'chef')

        <a href="#">
            Permintaan Barang
        </a>

    @endif

    {{-- Owner dan Admin --}}
    @if(in_array(auth()->user()->role, ['owner', 'admin_gudang']))

        <a href="#">
            Laporan
        </a>

    @endif

    <hr>

    <form action="/logout" method="POST">
        @csrf

        <button
            type="submit"
            style="
                width:100%;
                padding:10px;
                border:none;
                cursor:pointer;
            "
        >
            Logout
        </button>
    </form>

</div>