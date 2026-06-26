
<div style="
height:80px;
background:white;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 35px;
border-bottom:1px solid #e5e7eb;
box-shadow:0 3px 15px rgba(0,0,0,.05);
">

    <!-- Judul -->
    <div>

        <h2 style="
        color:#1e3a8a;
        font-size:38px;
        font-weight:700;
        margin-bottom:3px;
        ">
            Siguresto
        </h2>

        <small style="
        color:#6b7280;
        font-size:14px;
        ">
            Hallo, Selamat datang diaplikasi Siguresto
        </small>

    </div>


    <!-- Area Kanan -->
    <div style="
    display:flex;
    align-items:center;
    gap:25px;
    ">

        <!-- Jam -->
        <div style="
        text-align:right;
        ">
            <div id="tanggalSekarang"
            style="
            color:#111827;
            font-weight:600;
            font-size:14px;
            ">
            </div>

            <div id="jamSekarang"
            style="
            color:#6b7280;
            font-size:13px;
            ">
            </div>
        </div>

<!-- Notifikasi -->
<div style="position:relative;">

    <div onclick="toggleNotif()"
    style="
    width:45px;
    height:45px;
    border-radius:50%;
    background:#f3f4f6;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    ">

        <i class="fa-solid fa-bell" style="color:#f59e0b"></i>

        @if(isset($jumlahNotif) && $jumlahNotif > 0)
        <span id="badgeNotif"
style="
position:absolute;
top:-5px;
right:-5px;
background:red;
color:white;
width:20px;
height:20px;
border-radius:50%;
font-size:12px;
display:flex;
align-items:center;
justify-content:center;
">
    {{ $jumlahNotif }}
</span>
        @endif

    </div>

    <div id="notifBox"
    style="
    display:none;
    position:absolute;
    right:0;
    top:55px;
    width:350px;
    background:white;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
    z-index:999;
    max-height:400px;
    overflow-y:auto;
    ">

        <div style="
        padding:15px;
        font-weight:bold;
        border-bottom:1px solid #eee;
        ">
            Notifikasi
        </div>

        @if(isset($notifikasi))
            @forelse($notifikasi as $n)

            <div style="
            padding:12px 15px;
            border-bottom:1px solid #eee;
            ">

                {{ $n->pesan }}

                <br>

                <small style="color:gray">
                    {{ $n->created_at->diffForHumans() }}
                </small>

            </div>

            @empty

            <div style="padding:15px">
                Tidak ada notifikasi
            </div>

            @endforelse
        @endif

    </div>

</div>


        <!-- User -->
        <div style="
        display:flex;
        align-items:center;
        gap:12px;
        ">

            <div style="
            width:50px;
            height:50px;
            border-radius:50%;
            background:linear-gradient(135deg,#1e3a8a,#2563eb);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            font-weight:bold;
            box-shadow:0 5px 15px rgba(37,99,235,.3);
            ">
                {{ strtoupper(substr(Auth::user()->nama ?? 'U',0,1)) }}
            </div>

            <div>

                <div style="
                font-size:18px;
                font-weight:700;
                color:#111827;
                ">
                    {{ Auth::user()->nama ?? '-' }}
                </div>

                <div style="
                color:#6b7280;
                font-size:13px;
                ">
                    {{ ucfirst(Auth::user()->role ?? '-') }}
                </div>

            </div>

        </div>


        <!-- Logout -->
        <form action="/logout" method="POST">
            @csrf

        <div class="user-info">
    <span>{{ Auth::user()->name }}</span>
    
    <button type="button" class="btn-logout">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
    </button>
</div>

        </form>

    </div>

</div>


<script>

function updateJam(){

    const sekarang = new Date();

    const tanggal = sekarang.toLocaleDateString('id-ID',{
        weekday:'long',
        day:'numeric',
        month:'long',
        year:'numeric'
    });

    const jam = sekarang.toLocaleTimeString('id-ID');

    document.getElementById('tanggalSekarang').innerHTML = tanggal;
    document.getElementById('jamSekarang').innerHTML = jam;

}

setInterval(updateJam,1000);

updateJam();

</script>

<script>
function toggleNotif()
{
    let box = document.getElementById('notifBox');

    if(box.style.display === 'block')
    {
        box.style.display = 'none';
    }
    else
    {
        box.style.display = 'block';

        fetch('/notifikasi/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {

            let badge = document.getElementById('badgeNotif');

            if(badge)
            {
                badge.style.display = 'none';
            }

        });
    }
}
</script>
