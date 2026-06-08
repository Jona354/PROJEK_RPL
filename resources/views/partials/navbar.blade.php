<div class="navbar">

    Selamat Datang,

    <strong>
        {{ Auth::user()->nama }}
    </strong>

    |

    Role:

    <strong>
        {{ Auth::user()->role }}
    </strong>

</div>