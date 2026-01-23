<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pay My Games</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 450px;
        }
        .logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .logo h1 {
            color: white;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 8px;
        }
        .logo p {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        .card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .card h2 {
            font-size: 28px;
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 8px;
        }
        .card p {
            color: #6b7280;
            margin-bottom: 32px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
        }
        .alert {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }
        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }
        .strength-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 6px;
            overflow: hidden;
        }
        .strength-bar-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s;
        }
        .btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 8px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        .links {
            margin-top: 24px;
            text-align: center;
        }
        .links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .back-home {
            text-align: center;
            margin-top: 24px;
        }
        .back-home a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .back-home a:hover {
            text-decoration: underline;
        }
        .info-box {
            background: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
        }
        .info-box p {
            color: #1e40af;
            font-size: 13px;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <h1>🎮 Pay My Games</h1>
        <p>Top Up Game Tercepat & Termurah</p>
    </div>

    <div class="card">
        <h2>Daftar Sekarang</h2>
        <p>Buat akun untuk mulai top up game favorit</p>

        <div class="info-box">
            <p>✨ Dapatkan akses ke berbagai game populer dan promo menarik!</p>
        </div>

        @if ($errors->any())
        <div class="alert">
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom: 4px;">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       placeholder="John Doe"
                       required 
                       autofocus>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="nama@email.com"
                       required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password"
                       placeholder="Minimal 8 karakter"
                       required
                       onkeyup="checkPasswordStrength(this.value)">
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-bar-fill" id="strength-bar"></div>
                    </div>
                    <span id="strength-text" style="color: #6b7280;"></span>
                </div>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation"
                       placeholder="Ulangi password"
                       required>
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Daftar Sekarang
            </button>
        </form>

        <div class="links">
            <a href="{{ route('login') }}">Sudah punya akun? Masuk di sini</a>
        </div>
    </div>

    <div class="back-home">
        <a href="/">
            <span>←</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</div>

<script>
function checkPasswordStrength(password) {
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');
    
    let strength = 0;
    
    if (password.length >= 8) strength += 25;
    if (password.match(/[a-z]/)) strength += 25;
    if (password.match(/[A-Z]/)) strength += 25;
    if (password.match(/[0-9]/)) strength += 25;
    
    strengthBar.style.width = strength + '%';
    
    if (strength === 0) {
        strengthBar.style.background = '#e5e7eb';
        strengthText.textContent = '';
    } else if (strength <= 25) {
        strengthBar.style.background = '#ef4444';
        strengthText.textContent = 'Lemah';
        strengthText.style.color = '#ef4444';
    } else if (strength <= 50) {
        strengthBar.style.background = '#f59e0b';
        strengthText.textContent = 'Cukup';
        strengthText.style.color = '#f59e0b';
    } else if (strength <= 75) {
        strengthBar.style.background = '#3b82f6';
        strengthText.textContent = 'Baik';
        strengthText.style.color = '#3b82f6';
    } else {
        strengthBar.style.background = '#10b981';
        strengthText.textContent = 'Kuat';
        strengthText.style.color = '#10b981';
    }
}
</script>

</body>
</html>