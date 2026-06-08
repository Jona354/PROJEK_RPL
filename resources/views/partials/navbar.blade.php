<div style="
height:70px;
background:white;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 30px;
box-shadow:0 2px 5px rgba(0,0,0,.1);
">

    <h2>Dashboard</h2>

    <div>

        <strong>
            {{ Auth::user()->nama }}
        </strong>

        ({{ Auth::user()->role }})

        <form action="/logout" method="POST" style="display:inline;">
            @csrf

            <button type="submit"
            style="
            margin-left:15px;
            background:#ef4444;
            border:none;
            color:white;
            padding:10px 15px;
            border-radius:5px;
            cursor:pointer;
            ">
                Logout
            </button>

        </form>

    </div>

</div>