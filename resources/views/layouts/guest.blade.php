<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Login') - Sistem Ekstrakurikuler</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

:root{
--primary:#4f46e5;
--dark:#111827;
--light:#f9fafb;
--border:#e5e7eb;
}

/* RESET */
body{
margin:0;
font-family:'Figtree',sans-serif;
background:#f3f4f6;
}

/* LAYOUT */
.auth-wrapper{
display:flex;
min-height:100vh;
}

/* LEFT SIDE */
.auth-left{
flex:1;
background:linear-gradient(135deg,#4f46e5,#7c3aed);
color:white;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
padding:40px;
text-align:center;
}

.auth-left h1{
font-size:2rem;
font-weight:700;
margin-bottom:10px;
}

.auth-left p{
opacity:0.85;
max-width:300px;
}

/* RIGHT SIDE */
.auth-right{
flex:1;
display:flex;
justify-content:center;
align-items:center;
padding:30px;
}

/* CARD */
.auth-card{
background:white;
padding:35px;
border-radius:16px;
width:100%;
max-width:380px;
box-shadow:0 10px 40px rgba(0,0,0,0.08);
}

/* TITLE */
.auth-card h3{
font-weight:600;
margin-bottom:20px;
}

/* INPUT */
.form-control{
border-radius:10px;
border:1px solid var(--border);
padding:12px;
font-size:0.9rem;
}

.form-control:focus{
border-color:var(--primary);
box-shadow:none;
}

/* BUTTON */
.btn-login{
background:var(--primary);
color:white;
border:none;
padding:12px;
border-radius:10px;
font-weight:600;
width:100%;
transition:.2s;
}

.btn-login:hover{
background:#4338ca;
}

/* FOOT */
.auth-footer{
text-align:center;
margin-top:20px;
font-size:0.85rem;
}

.auth-footer a{
text-decoration:none;
color:var(--primary);
}

/* RESPONSIVE */
@media(max-width:768px){
.auth-left{
display:none;
}
}

</style>
</head>

<body>

<div class="auth-wrapper">

    <!-- LEFT -->
    <div class="auth-left">
        <h1>
            <i class="fas fa-school"></i><br>
            Sistem Ekstrakurikuler
        </h1>
        <p>
            Kelola dan daftar kegiatan ekstrakurikuler sekolah secara online dengan mudah dan cepat.
        </p>
    </div>

    <!-- RIGHT -->
    <div class="auth-right">

        <div class="auth-card">

            <h3 class="text-center">Login</h3>

            @yield('content')

            <div class="auth-footer">
                <p>
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar</a>
                </p>

                <a href="{{ route('password.request') }}">Lupa password?</a>
                <br>
                <a href="{{ route('home') }}">← Kembali</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>