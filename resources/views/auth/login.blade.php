<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pay My Games</title>
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
            margin-bottom: 24px;
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
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        .checkbox-group input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }
        .checkbox-group label {
            font-size: 14px;
            color: #6b7280;
            cursor: pointer;
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
        .divider {
            text-align: center;
            margin: 24px 0;
            color: #9ca3af;
            font-size: 14px;
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
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <h1>🎮 Pay My Games</h1>
        <p>Top Up Game Tercepat & Termurah</p>
    </div>

    <div class="card">
        <h2>Selamat Datang Kembali!</h2>
        <p>Masuk ke akun Anda untuk melanjutkan</p>

        @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
        @endif

        @if (session('status'))
        <div class="alert" style="background: #d1fae5; border-color: #a7f3d0; color: #065f46;">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="nama@email.com"
                       required 
                       autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password"
                       placeholder="••••••••"
                       required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn">
                Masuk Sekarang
            </button>
        </form>

        <div class="divider">Atau</div>

        <div class="links">
            <a href="{{ route('register') }}">Belum punya akun? Daftar sekarang</a>
        </div>

        @if (Route::has('password.request'))
        <div class="links" style="margin-top: 12px;">
            <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>
        @endif
    </div>

    <div class="back-home">
        <a href="/">
            <span>←</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</div>

</body>
</html>