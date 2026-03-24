{{-- resources/views/layouts/simple.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Pendaftaran Ekstrakurikuler')</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
    --primary: #4f46e5;
    --primary-soft: #6366f1;
    --accent: #0ea5e9;

    --bg: #f8fafc;
    --surface: #ffffff;

    --text-main: #0f172a;
    --text-muted: #64748b;

    --border: #e5e7eb;

    --radius: 14px;

    --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
    --shadow-md: 0 6px 12px rgba(0,0,0,0.08);
}

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--text-main);
    line-height: 1.6;
}

/* ================= NAVBAR ================= */
.navbar {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    border-bottom: 1px solid var(--border);
    padding: 10px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* efek scroll */
.navbar.scrolled {
    background: #ffffff;
    box-shadow: var(--shadow-sm);
}

/* container */
.navbar-content {
    max-width: 1100px;
    margin: auto;
    padding: 0 16px;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* brand */
.navbar-brand {
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 8px;

    background: linear-gradient(90deg, #4f46e5, #0ea5e9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* collapse */
.navbar-collapse {
    flex-grow: 0;
}

/* menu */
.navbar-nav {
    display: flex;
    align-items: center;
    gap: 6px;
}

/* link */
.nav-link {
    font-size: 14px;
    font-weight: 500;
    padding: 6px 12px !important;
    border-radius: 8px;
    color: var(--text-main) !important;
    transition: all 0.2s ease;
}

.nav-link:hover {
    background: rgba(79, 70, 229, 0.08);
    color: var(--primary) !important;
}

.nav-link.active {
    background: rgba(79, 70, 229, 0.12);
    color: var(--primary) !important;
}

/* logout */
.logout-btn {
    background: #ef4444 !important;
    color: white !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    border: none;
    font-size: 14px;
}

.logout-btn:hover {
    background: #dc2626 !important;
}

/* toggler */
.navbar-toggler {
    border: none;
}

/* mobile */
@media (max-width: 768px) {
    .navbar-collapse {
        margin-top: 10px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 10px;
    }

    .navbar-nav {
        align-items: stretch;
    }

    .nav-link {
        width: 100%;
    }

    .logout-btn {
        width: 100%;
        margin-top: 6px;
    }
}

/* ================= LAYOUT ================= */
main {
    padding: 40px 0;
}

.container {
    max-width: 1100px;
}

.section {
    margin-bottom: 32px;
}

.row > * {
    margin-bottom: 20px;
}

/* ================= CARD ================= */
.card {
    background: var(--surface);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    transition: 0.3s;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.card-header {
    padding: 16px 20px;
    font-size: 16px;
    font-weight: 600;
    background: var(--primary);
    color: white;
}

.card-body {
    padding: 20px;
}

.card-body + .card-body {
    border-top: 1px solid var(--border);
}

/* ================= BUTTON ================= */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-primary {
    background: var(--primary);
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
    font-size: 14px;
    box-shadow: var(--shadow-sm);
    transition: 0.2s;
}

.btn-primary:hover {
    background: var(--primary-soft);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn + .btn {
    margin-left: 8px;
}

/* ================= FORM ================= */
.form-group {
    margin-bottom: 18px;
}

label {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-muted);
    margin-bottom: 6px;
    display: block;
}

.form-control,
.form-select {
    border-radius: 10px;
    border: 1px solid var(--border);
    height: 42px;
    font-size: 14px;
    padding: 8px 12px;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(79,70,229,0.15);
}

/* ================= TABLE ================= */
.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
}

/* header */
.table th {
    background: #f1f5f9;
    color: var(--text-main);
    font-weight: 600;
    font-size: 14px;
    text-align: left;
    padding: 14px 16px;
    border-bottom: 2px solid var(--border);
}

/* body */
.table td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    font-size: 14px;
}

/* garis vertikal */
.table th:not(:last-child),
.table td:not(:last-child) {
    border-right: 1px solid var(--border);
}

/* hover */
.table tbody tr:hover {
    background: #f8fafc;
}

/* zebra */
.table tbody tr:nth-child(even) {
    background: #fafafa;
}

/* last row */
.table tbody tr:last-child td {
    border-bottom: none;
}

/* ================= ALERT ================= */
.alert {
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 14px;
    box-shadow: var(--shadow-sm);
}

/* ================= BADGE ================= */
.badge {
    border-radius: 20px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 600;
}

/* ================= DIVIDER ================= */
.divider {
    height: 1px;
    background: var(--border);
    margin: 20px 0;
}

/* ================= FOOTER ================= */
footer {
    background: #0f172a;
    color: #cbd5f5;
    padding: 20px 0;
    margin-top: 40px;
    text-align: center;
    font-size: 14px;
}

/* ================= SCROLLBAR ================= */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 10px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .card {
        margin: 0 10px;
    }

    .card-body {
        padding: 16px;
    }
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="navbar-content">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-graduation-cap"></i>
            EKSKUL ONLINE
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fas fa-bars text-primary"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- Guest --}}
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                @endguest

                {{-- Auth --}}
                @auth
                {{-- Admin --}}
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cek-status') }}">
                        <i class="fas fa-search"></i> Cek Status
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.mapping') }}">
                        <i class="fas fa-project-diagram"></i> Mapping Ekskul
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>

                {{-- Siswa --}}
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cek-status') }}">
                        <i class="fas fa-search"></i> Cek Status
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<main class="py-5">
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- FOOTER -->
<footer>
    <div class="footer-content">
        <i class="fas fa-heart text-danger me-2"></i>
        &copy; {{ date('Y') }} Sistem Pendaftaran Ekstrakurikuler. Dibuat dengan ❤️
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    // Auto hide alerts
    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000);

    // Navbar scroll effect
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('scrolled');
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });
});
</script>

@yield('scripts')

</body>
</html>