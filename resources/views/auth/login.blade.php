<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DIKLAT RS BALIMED DENPASAR</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="auth-body">
    <div class="auth-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div class="auth-wrapper">
        <div class="login-card">
            <div class="text-center">
                <div class="logo-box">
                    <img src="https://rsbalimed.com/wp-content/uploads/2022/09/logo-balimed-hospital.png"
                         alt="Logo BaliMed">
                </div>

                <h1 class="login-title">DIKLAT RS BALIMED DENPASAR</h1>
                <p class="login-subtitle">
                    Portal Internal Training, Webinar, dan External Training
                </p>
            </div>

            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="employee_id" class="form-label">ID Karyawan</label>
                    <input
                        id="employee_id"
                        name="employee_id"
                        type="text"
                        value="{{ old('employee_id') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="form-control"
                        placeholder="Masukkan ID Karyawan">
                    @error('employee_id')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="form-control"
                        placeholder="Password default: balimed1">
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    Login ke Sistem
                </button>
            </form>

            <div class="login-footer">
                Version 1.0.0 | © {{ date('Y') }} BaliMed Hospital
            </div>
        </div>
    </div>
</body>
</html>