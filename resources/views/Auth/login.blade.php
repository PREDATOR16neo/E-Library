<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>E-Library — Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background: #f0f4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
            overflow: hidden;
        }
        .blob { position:absolute; border-radius:50%; filter:blur(80px); pointer-events:none; z-index:0; }
        .blob-1 { width:400px; height:400px; background:rgba(59,130,246,0.12); top:-100px; left:-100px; }
        .blob-2 { width:350px; height:350px; background:rgba(99,102,241,0.1); bottom:-80px; right:-80px; }
        .blob-3 { width:250px; height:250px; background:rgba(16,185,129,0.08); top:50%; left:50%; transform:translate(-50%,-50%); }
        .wrapper { position:relative; z-index:1; width:100%; max-width:420px; }
        .card { background:#fff; border:1px solid #e2e8f0; border-radius:24px; padding:40px 36px; box-shadow:0 8px 40px rgba(15,23,42,0.08); }
        .logo-wrap { text-align:center; margin-bottom:28px; }
        .logo-icon { width:56px; height:56px; background:linear-gradient(135deg,#3b82f6,#6366f1); border-radius:16px; display:inline-flex; align-items:center; justify-content:center; box-shadow:0 6px 20px rgba(59,130,246,0.3); margin-bottom:14px; }
        .logo-icon svg { width:26px; height:26px; stroke:white; fill:none; }
        .logo-title { font-family:'Lora',serif; font-size:1.6rem; font-weight:700; color:#1e293b; }
        .logo-title span { color:#3b82f6; }
        .logo-sub { font-size:0.82rem; color:#94a3b8; margin-top:4px; }
        .form-group { margin-bottom:18px; }
        .form-label { display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em; }
        .input-wrap { position:relative; display:flex; align-items:center; }
        .form-input { width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:12px; padding:11px 42px 11px 14px; font-size:0.9rem; font-family:'Outfit',sans-serif; outline:none; transition:border 0.18s, background 0.18s, box-shadow 0.18s; }
        .form-input::placeholder { color:#cbd5e1; }
        .form-input:focus { border-color:#3b82f6; background:#fff; box-shadow:0 0 0 3px rgba(59,130,246,0.1); }
        .icon-btn { position:absolute; right:12px; background:none; border:none; cursor:pointer; color:#94a3b8; padding:0; display:flex; align-items:center; justify-content:center; transition:color 0.15s; }
        .icon-btn:hover { color:#3b82f6; }
        .icon-btn svg { width:17px; height:17px; stroke:currentColor; fill:none; }
        .label-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:7px; }
        .forgot-link { font-size:0.75rem; color:#3b82f6; text-decoration:none; font-weight:500; }
        .forgot-link:hover { color:#2563eb; }
        .btn-submit { width:100%; background:linear-gradient(135deg,#3b82f6,#6366f1); color:#fff; font-family:'Outfit',sans-serif; font-size:0.9rem; font-weight:600; padding:12px; border-radius:12px; border:none; cursor:pointer; transition:opacity 0.18s, transform 0.18s; box-shadow:0 4px 16px rgba(59,130,246,0.35); margin-top:6px; }
        .btn-submit:hover { opacity:0.92; transform:translateY(-1px); }
        .register-row { text-align:center; font-size:0.82rem; color:#94a3b8; margin-top:22px; }
        .register-row a { color:#3b82f6; font-weight:600; text-decoration:none; }
        .divider { height:1px; background:#f1f5f9; margin:22px 0; }
    </style>
</head>
<body>

    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Login Gagal!',
                text: 'Email atau password salah. Silakan coba lagi.',
                icon: 'error',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'Coba Lagi'
            });
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3b82f6',
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
    @endif

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="wrapper">
        <div class="card">

            <div class="logo-wrap">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <p class="logo-title">E-<span>Library</span></p>
                <p class="logo-sub">Masuk ke akunmu untuk melanjutkan</p>
            </div>

            <form action="{{ route('auth.actionLogin') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-wrap">
                        <input
                            id="emailInput"
                            type="email"
                            name="email"
                            required
                            autocomplete="email"
                            placeholder="kamu@email.com"
                            class="form-input"
                        />
                        <button type="button" class="icon-btn" id="clearBtn" style="display:none;" title="Hapus email">
                            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <div class="label-row">
                        <label for="passwordInput" class="form-label" style="margin-bottom:0;">Password</label>
                        <a href="#" class="forgot-link">Lupa password?</a>
                    </div>
                    <div class="input-wrap">
                        <input
                            id="passwordInput"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="form-input"
                        />
                        <button type="button" class="icon-btn" id="toggleBtn" title="Lihat password">
                            <svg id="iconEye" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="iconEyeOff" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Masuk</button>
            </form>

            <div class="divider"></div>

            <p class="register-row">
                Belum punya akun?
                <a href="{{ route('auth.register') }}">Daftar sekarang</a>
            </p>

        </div>
    </div>

    <script>
        // ── Toggle password ──
        var pwInput  = document.getElementById('passwordInput');
        var toggleBtn = document.getElementById('toggleBtn');
        var iconEye   = document.getElementById('iconEye');
        var iconEyeOff = document.getElementById('iconEyeOff');

        toggleBtn.addEventListener('click', function () {
            if (pwInput.type === 'password') {
                pwInput.type = 'text';
                iconEye.style.display    = 'none';
                iconEyeOff.style.display = 'block';
            } else {
                pwInput.type = 'password';
                iconEye.style.display    = 'block';
                iconEyeOff.style.display = 'none';
            }
        });

        // ── Clear email ──
        var emailInput = document.getElementById('emailInput');
        var clearBtn   = document.getElementById('clearBtn');

        emailInput.addEventListener('input', function () {
            clearBtn.style.display = this.value.length > 0 ? 'flex' : 'none';
        });

        clearBtn.addEventListener('click', function () {
            emailInput.value = '';
            clearBtn.style.display = 'none';
            emailInput.focus();
        });
    </script>

</body>
</html>