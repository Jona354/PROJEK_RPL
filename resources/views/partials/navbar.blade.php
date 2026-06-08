<div style="
height:75px;
background:white;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 30px;
border-bottom:1px solid #e5e7eb;
">

    <!-- Judul Halaman -->
    <div>

        <h2 style="
        color:#111827;
        font-size:24px;
        font-weight:700;
        ">
            Dashboard
        </h2>

        <small style="
        color:#6b7280;
        ">
            Sistem Gudang Restoran
        </small>

    </div>

    <!-- User Area -->
    <div style="
    display:flex;
    align-items:center;
    gap:20px;
    ">

        <!-- Notifikasi -->
        <div style="
        width:42px;
        height:42px;
        border-radius:50%;
        background:#f3f4f6;
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        font-size:18px;
        ">
            🔔
        </div>

        <!-- Profil User -->
        <div style="
        display:flex;
        align-items:center;
        gap:12px;
        ">

            <div style="
            width:45px;
            height:45px;
            border-radius:50%;
            background:#2563eb;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
            font-size:18px;
            ">
                {{ strtoupper(substr(Auth::user()->nama ?? 'U',0,1)) }}
            </div>

            <div>

                <div style="
                font-weight:600;
                color:#111827;
                ">
                    {{ Auth::user()->nama ?? '-' }}
                </div>

                <div style="
                font-size:13px;
                color:#6b7280;
                ">
                    {{ ucfirst(Auth::user()->role ?? '-') }}
                </div>

            </div>

        </div>

        <!-- Logout -->
        <form action="/logout" method="POST">
            @csrf

            <button type="submit"
            style="
            background:#ef4444;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
            font-weight:600;
            ">
                Logout
            </button>

        </form>

    </div>

</div>