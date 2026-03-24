<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - SMK Negeri 11 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary-blue: #1e3c72; 
            --secondary-blue: #2a5298; 
            --accent-teal: #00c9b1; 
        }
        body {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: white; 
            border-radius: 25px; 
            padding: 2.5rem;
            width: 100%; 
            max-width: 420px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .login-header { 
            text-align: center; 
            margin-bottom: 2rem; 
        }
        .login-header i { 
            font-size: 3rem; 
            color: var(--primary-blue); 
            margin-bottom: 1rem; 
        }
        .login-header h4 { 
            font-weight: 700; 
            color: #333; 
            margin-bottom: 0.5rem; 
        }
        .login-header p {
            color: #666;
            margin: 0;
        }
        .form-control:focus { 
            border-color: var(--primary-blue); 
            box-shadow: 0 0 0 0.25rem rgba(30,60,114,0.25); 
        }
        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }
        .input-group .form-control {
            border-left: none;
        }
        .btn-login {
            background: var(--primary-blue); 
            color: white; 
            border: none;
            padding: 0.75rem; 
            font-weight: 600; 
            border-radius: 25px; 
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover { 
            background: var(--secondary-blue); 
            transform: translateY(-2px);
        }
        .alert-error {
            background: #fee; 
            border: 1px solid #fcc; 
            color: #900;
            padding: 0.75rem 1rem; 
            border-radius: 12px; 
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background: #efe; 
            border: 1px solid #cfc; 
            color: #090;
            padding: 0.75rem 1rem; 
            border-radius: 12px; 
            margin-bottom: 1.5rem;
        }
        a { 
            color: var(--primary-blue); 
            text-decoration: none; 
        }
        a:hover { 
            color: var(--secondary-blue); 
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <i class="fas fa-user-shield"></i>
            <h4>Admin Login</h4>
            <p>SMK Negeri 11 Bandung</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                <i class="fas fa-times-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Login Form - ⚠️ @csrf ADA DI SINI (PENTING!) -->
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf  <!-- ✅ TOKEN CSRF - JANGAN DIHAPUS! -->
            
            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="admin@smkn11bandung.sch.id"
                        required 
                        autofocus
                    >
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••"
                        required
                    >
                    <button 
                        type="button" 
                        class="btn btn-outline-secondary" 
                        onclick="togglePassword()"
                    >
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="remember" 
                        id="remember"
                    >
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
        </form>

        <!-- Footer Link -->
        <p class="text-center text-muted small mt-4 mb-0">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </p>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>