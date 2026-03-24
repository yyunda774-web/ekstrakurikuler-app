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
--primary:#4361ee;
--secondary:#3a0ca3;
--student:#0ea5e9;
--admin:#ef4444;
}

body{
font-family:'Figtree',sans-serif;
background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
min-height:100vh;
display:flex;
flex-direction:column;
}

.login-container{
flex:1;
display:flex;
align-items:center;
justify-content:center;
padding:20px;
}

.login-card{
background:white;
border-radius:20px;
box-shadow:0 25px 70px rgba(0,0,0,0.15);
width:100%;
max-width:470px;
overflow:hidden;
}

.login-header{
background:linear-gradient(135deg,var(--primary),var(--secondary));
color:white;
padding:2rem;
text-align:center;
}

.login-header h2{
font-weight:700;
}

.login-body{
padding:2rem;
}

.login-type{
display:flex;
gap:10px;
margin-bottom:20px;
}

.login-option{
flex:1;
padding:10px;
border-radius:10px;
font-size:0.9rem;
font-weight:600;
text-align:center;
background:#f1f5f9;
}

.login-option.admin{
color:var(--admin);
}

.login-option.siswa{
color:var(--student);
}

.form-control{
border-radius:10px;
border:2px solid #e2e8f0;
padding:12px 15px;
font-size:0.95rem;
}

.form-control:focus{
border-color:var(--primary);
box-shadow:0 0 0 3px rgba(67,97,238,0.1);
}

.btn-login{
background:linear-gradient(135deg,var(--primary),var(--secondary));
color:white;
border:none;
padding:12px;
font-weight:600;
border-radius:10px;
width:100%;
transition:.3s;
}

.btn-login:hover{
transform:translateY(-2px);
box-shadow:0 6px 18px rgba(0,0,0,0.15);
}

.footer{
background:rgba(255,255,255,0.9);
backdrop-filter:blur(10px);
border-top:1px solid rgba(0,0,0,0.08);
padding:1rem;
text-align:center;
font-size:.85rem;
color:#666;
}

.footer small{
color:#888;
}

</style>
</head>

<body>

<div class="login-container">

<div class="login-card">

<div class="login-header">

<h2 class="mb-1">
<i class="fas fa-school me-2"></i>
Sistem Ekstrakurikuler
</h2>

<p class="opacity-75 mb-0">
Pendaftaran Ekstrakurikuler Online
</p>

</div>


<div class="login-body">

<!-- pembeda login -->
<div class="login-type">

<div class="login-option siswa">
<i class="fas fa-user-graduate"></i>
Login Siswa
</div>

<div class="login-option admin">
<i class="fas fa-user-shield"></i>
Login Admin
</div>

</div>


<!-- FORM LOGIN -->
@yield('content')


<div class="text-center mt-4 pt-3 border-top">

<p class="text-muted mb-2">
Belum punya akun?
<a href="{{ route('register') }}" class="fw-semibold text-primary">
Daftar di sini
</a>
</p>

<a href="{{ route('password.request') }}" class="text-muted">
Lupa password?
</a>

<span class="mx-2">|</span>

<a href="{{ route('home') }}" class="text-muted">
Kembali ke beranda
</a>

</div>

</div>
</div>
</div>


<footer class="footer">

<p class="mb-0">
&copy; {{ date('Y') }} Sistem Pendaftaran Ekstrakurikuler
</p>

<small>
SMK Contoh Sekolah • admin@sekolah.sch.id
</small>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>