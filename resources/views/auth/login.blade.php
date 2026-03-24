@extends('layouts.guest')

@section('title', 'Login')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">
            <i class="fas fa-envelope me-1"></i>Email
        </label>
        <input type="email" 
               id="email" 
               name="email" 
               class="form-control"
               value="{{ old('email') }}"
               placeholder="nama@email.com"
               required
               autofocus>
    </div>
    
    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">
            <i class="fas fa-lock me-1"></i>Password
        </label>
        <input type="password" 
               id="password" 
               name="password" 
               class="form-control"
               placeholder="Masukkan password"
               required>
    </div>
    
    <!-- Remember Me -->
    <div class="mb-3 form-check">
        <input type="checkbox" 
               id="remember" 
               name="remember" 
               class="form-check-input">
        <label for="remember" class="form-check-label">
            Ingat saya
        </label>
    </div>
    
    <!-- Submit Button -->
    <button type="submit" class="btn btn-login mb-3">
        <i class="fas fa-sign-in-alt me-2"></i>Login
    </button>
    
    <!-- Login sebagai Guest/Demo -->
    <div class="text-center">
        <small class="text-muted">
            Atau login sebagai:
            <br>
            <a href="#" onclick="fillDemo('admin')" class="badge bg-primary me-1">Admin</a>
            <a href="#" onclick="fillDemo('siswa')" class="badge bg-success">Siswa</a>
        </small>
    </div>
</form>

<script>
    function fillDemo(role) {
        if (role === 'admin') {
            document.getElementById('email').value = 'admin@example.com';
            document.getElementById('password').value = 'password';
        } else if (role === 'siswa') {
            document.getElementById('email').value = 'siswa@example.com';
            document.getElementById('password').value = 'password';
        }
    }
</script>
@endsection