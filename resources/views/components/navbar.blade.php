<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>E-Library</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: #f8fafc; min-height: 100vh; }

        /* ── Navbar ── */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 12px rgba(15,23,42,0.06);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 3px 10px rgba(59,130,246,0.3);
        }
        .logo-icon svg { width: 18px; height: 18px; stroke: white; fill: none; }
        .logo-text {
            font-family: 'Lora', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
        }
        .logo-text span { color: #3b82f6; }

        /* Nav links */
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link {
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 9px;
            transition: all 0.15s;
        }
        .nav-link:hover { color: #1e293b; background: #f1f5f9; }
        .nav-link.active { color: #3b82f6; background: #eff6ff; font-weight: 600; }

        /* Auth area */
        .auth-area { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

        /* User chip */
        .user-chip {
            display: flex; align-items: center; gap: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 99px;
            padding: 4px 12px 4px 4px;
        }
        .user-avatar {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }
        .user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #1e293b;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Logout btn */
        .btn-logout {
            display: flex; align-items: center; gap: 6px;
            font-size: 0.8rem; font-weight: 600;
            color: #ef4444;
            background: #fff5f5;
            border: 1px solid #fecaca;
            padding: 7px 14px;
            border-radius: 9px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
            font-family: 'Outfit', sans-serif;
        }
        .btn-logout:hover { background: #fee2e2; }
        .btn-logout svg { width: 14px; height: 14px; stroke: currentColor; fill: none; }

        /* Login btn */
        .btn-login {
            display: flex; align-items: center; gap: 6px;
            font-size: 0.85rem; font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            padding: 8px 18px;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 3px 12px rgba(59,130,246,0.3);
            transition: opacity 0.15s;
        }
        .btn-login:hover { opacity: 0.9; }

        /* Page content */
        .page-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <span class="logo-text">E-<span>Library</span></span>
        </a>

        {{-- Nav Links --}}
        @auth
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            @if(Auth::user()->role == 'admin')
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('genre.index') }}" class="nav-link {{ request()->routeIs('genre*') ? 'active' : '' }}">Genre</a>
            <a href="{{ route('penulis.index') }}" class="nav-link {{ request()->routeIs('penulis*') ? 'active' : '' }}">Author</a>
            <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books*') ? 'active' : '' }}">Books</a>
            @endif
        </div>
        @endauth

        {{-- Auth Area --}}
        <div class="auth-area">
            @guest
                <a href="{{ route('login') }}" class="btn-login">
                    <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px;stroke:white;fill:none;">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                    </svg>
                    Login
                </a>
            @endguest

            @auth
                {{-- User chip --}}
                <div class="user-chip">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </div>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            @endauth
        </div>

    </div>
</nav>

{{-- Page Content --}}
<div class="page-content">
    @yield('content')
</div>

</body>
</html>