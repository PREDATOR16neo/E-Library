<!DOCTYPE html>
<html lang="en" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>E-Library — Register</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #f0f4ff;
            --card-bg:  #ffffff;
            --card-br:  #e2e8f0;
            --text:     #1e293b;
            --text-sub: #94a3b8;
            --label:    #475569;
            --input-bg: #f8fafc;
            --input-br: #e2e8f0;
            --input-focus-br: #3b82f6;
            --input-focus-bg: #ffffff;
            --toggle-bg:#f1f5f9;
            --toggle-br:#e2e8f0;
            --divider:  #f1f5f9;
            --blob1: rgba(59,130,246,0.12);
            --blob2: rgba(99,102,241,0.10);
            --blob3: rgba(16,185,129,0.08);
            --error-br: #fca5a5;
            --error-bg: #fff5f5;
        }

        html.dark {
            --bg:       #0f172a;
            --card-bg:  #1e293b;
            --card-br:  #334155;
            --text:     #f1f5f9;
            --text-sub: #64748b;
            --label:    #94a3b8;
            --input-bg: #0f172a;
            --input-br: #334155;
            --input-focus-br: #3b82f6;
            --input-focus-bg: #1e293b;
            --toggle-bg:#334155;
            --toggle-br:#475569;
            --divider:  #334155;
            --blob1: rgba(59,130,246,0.08);
            --blob2: rgba(99,102,241,0.07);
            --blob3: rgba(16,185,129,0.05);
            --error-br: #ef4444;
            --error-bg: rgba(239,68,68,0.1);
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background: var(--bg);
            display: flex; align-items: center; justify-content: center;
            padding: 24px 16px;
            position: relative; overflow: hidden;
            transition: background 0.3s;
        }

        .blob { position:absolute; border-radius:50%; filter:blur(80px); pointer-events:none; z-index:0; transition:background 0.3s; }
        .blob-1 { width:400px; height:400px; background:var(--blob1); top:-100px; right:-100px; }
        .blob-2 { width:350px; height:350px; background:var(--blob2); bottom:-80px; left:-80px; }
        .blob-3 { width:250px; height:250px; background:var(--blob3); top:50%; left:50%; transform:translate(-50%,-50%); }

        .wrapper { position:relative; z-index:1; width:100%; max-width:420px; }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-br);
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 8px 40px rgba(15,23,42,0.08);
            transition: background 0.3s, border-color 0.3s;
        }

        .theme-toggle {
            position: absolute; top: 16px; right: 16px;
            width: 36px; height: 36px;
            background: var(--toggle-bg); border: 1px solid var(--toggle-br);
            border-radius: 10px; display:flex; align-items:center; justify-content:center;
            cursor:pointer; transition:all 0.15s; z-index:10;
        }
        .theme-toggle:hover { border-color:#3b82f6; }
        .theme-toggle svg { width:15px; height:15px; stroke:var(--label); fill:none; }
        .icon-sun  { display:none; }
        .icon-moon { display:block; }
        html.dark .icon-sun  { display:block; }
        html.dark .icon-moon { display:none; }

        .logo-wrap { text-align:center; margin-bottom:26px; }
        .logo-icon {
            width:52px; height:52px;
            background: linear-gradient(135deg,#3b82f6,#6366f1);
            border-radius:15px;
            display:inline-flex; align-items:center; justify-content:center;
            box-shadow:0 6px 20px rgba(59,130,246,0.3);
            margin-bottom:12px;
        }
        .logo-icon svg { width:24px; height:24px; stroke:white; fill:none; }
        .logo-title { font-family:'Lora',serif; font-size:1.5rem; font-weight:700; color:var(--text); }
        .logo-title span { color:#3b82f6; }
        .logo-sub { font-size:0.8rem; color:var(--text-sub); margin-top:4px; }

        .form-group { margin-bottom:16px; }
        .form-label {
            display:block; font-size:0.75rem; font-weight:600;
            color:var(--label); margin-bottom:7px;
            text-transform:uppercase; letter-spacing:0.06em;
        }
        .input-wrap { position:relative; display:flex; align-items:center; }
        .form-input {
            width:100%; background:var(--input-bg);
            border:1px solid var(--input-br); color:var(--text);
            border-radius:12px; padding:11px 42px 11px 14px;
            font-size:0.9rem; font-family:'Outfit',sans-serif;
            outline:none; transition:border 0.18s, background 0.18s, box-shadow 0.18s;
        }
        .form-input::placeholder { color:#cbd5e1; }
        .form-input:focus {
            border-color:var(--input-focus-br);
            background:var(--input-focus-bg);
            box-shadow:0 0 0 3px rgba(59,130,246,0.1);
        }
        .form-input.is-error { border-color:var(--error-br) !important; background:var(--error-bg) !important; }

        .icon-btn {
            position:absolute; right:12px;
            background:none; border:none; cursor:pointer;
            color:var(--label); padding:0;
            display:flex; align-items:center; justify-content:center;
            transition:color 0.15s;
        }
        .icon-btn:hover { color:#3b82f6; }
        .icon-btn svg { width:17px; height:17px; stroke:currentColor; fill:none; }

        .error-msg { font-size:0.72rem; color:#ef4444; margin-top:5px; }

        .btn-submit {
            width:100%;
            background:linear-gradient(135deg,#3b82f6,#6366f1);
            color:#fff; font-family:'Outfit',sans-serif;
            font-size:0.9rem; font-weight:600; padding:12px;
            border-radius:12px; border:none; cursor:pointer;
            box-shadow:0 4px 16px rgba(59,130,246,0.35);
            transition:opacity 0.18s, transform 0.18s;
            margin-top:6px;
        }
        .btn-submit:hover { opacity:0.92; transform:translateY(-1px); }

        .login-row { text-align:center; font-size:0.82rem; color:var(--text-sub); margin-top:20px; }
        .login-row a { color:#3b82f6; font-weight:600; text-decoration:none; }
        .login-row a:hover { color:#2563eb; }
        .divider { height:1px; background:var(--divider); margin:20px 0; transition:background 0.3s; }
    </style>
</head>
<body>

    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({ title:'Pendaftaran Gagal!', text:'{{ $errors->first() }}', icon:'error', confirmButtonColor:'#3b82f6' });
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({ title:'Error!', text:"{{ session('error') }}", icon:'error', confirmButtonColor:'#3b82f6' });
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
                        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                </div>
                <p class="logo-title">E-<span>Library</span></p>
                <p class="logo-sub">Buat akun baru untuk mulai membaca</p>
            </div>

            <form action="{{ route('action.register') }}" method="POST">
                @csrf

                {{-- Username --}}
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div class="input-wrap">
                        <input id="usernameInput" type="text" name="username" required
                            value="{{ old('username') }}"
                            placeholder="Username kamu"
                            class="form-input {{ $errors->has('username') ? 'is-error' : '' }}"/>
                        <button type="button" class="icon-btn" id="clearUsername" style="display:none;" title="Hapus">
                            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    @error('username')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrap">
                        <input id="emailInput" type="email" name="email" required
                            value="{{ old('email') }}"
                            placeholder="kamu@email.com"
                            class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"/>
                        <button type="button" class="icon-btn" id="clearEmail" style="display:none;" title="Hapus">
                            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    @error('email')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <input id="passwordInput" type="password" name="password" required
                            placeholder="Min. 8 karakter"
                            class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"/>
                        <button type="button" class="icon-btn" id="toggleBtn" title="Lihat password">
                            <svg id="iconEye" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="iconEyeOff" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-submit">Buat Akun</button>
            </form>

            <div class="divider"></div>
            <p class="login-row">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        </div>
    </div>

    <script>

        // ── Toggle password ──
        var pwInput    = document.getElementById('passwordInput');
        var toggleBtn  = document.getElementById('toggleBtn');
        var iconEye    = document.getElementById('iconEye');
        var iconEyeOff = document.getElementById('iconEyeOff');
        toggleBtn.addEventListener('click', function () {
            if (pwInput.type === 'password') {
                pwInput.type = 'text';
                iconEye.style.display = 'none';
                iconEyeOff.style.display = 'block';
            } else {
                pwInput.type = 'password';
                iconEye.style.display = 'block';
                iconEyeOff.style.display = 'none';
            }
        });

        // ── Clear username ──
        var usernameInput = document.getElementById('usernameInput');
        var clearUsername = document.getElementById('clearUsername');
        usernameInput.addEventListener('input', function () {
            clearUsername.style.display = this.value.length > 0 ? 'flex' : 'none';
        });
        clearUsername.addEventListener('click', function () {
            usernameInput.value = '';
            clearUsername.style.display = 'none';
            usernameInput.focus();
        });

        // ── Clear email ──
        var emailInput = document.getElementById('emailInput');
        var clearEmail = document.getElementById('clearEmail');
        emailInput.addEventListener('input', function () {
            clearEmail.style.display = this.value.length > 0 ? 'flex' : 'none';
        });
        clearEmail.addEventListener('click', function () {
            emailInput.value = '';
            clearEmail.style.display = 'none';
            emailInput.focus();
        });
    </script>

</body>
</html>