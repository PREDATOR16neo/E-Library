<!DOCTYPE html>
<html lang="en" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>E-Library</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; min-height: 100vh; transition: background 0.3s; }

        :root {
            --bg:#f8fafc; --sidebar-bg:#fff; --sidebar-br:#e2e8f0;
            --topbar-bg:#fff; --topbar-br:#f1f5f9;
            --text-main:#1e293b; --text-muted:#94a3b8; --text-nav:#64748b;
            --nav-hover:#eff6ff; --nav-active:#eff6ff; --nav-active-text:#3b82f6;
            --label-color:#cbd5e1; --footer-br:#f1f5f9;
            --logout-color:#ef4444; --logout-bg:#fff5f5; --logout-br:#fecaca; --logout-hover:#fee2e2;
            --toggle-bg:#f1f5f9; --toggle-br:#e2e8f0;
            --modal-bg:#fff; --modal-br:#e2e8f0; --modal-overlay:rgba(15,23,42,0.4);
            --input-bg:#f8fafc; --input-br:#e2e8f0;
            --avatar-zone:#f8fafc; --avatar-zone-br:#e2e8f0;
        }
        html.dark {
            --bg:#0f172a; --sidebar-bg:#1e293b; --sidebar-br:#334155;
            --topbar-bg:#1e293b; --topbar-br:#334155;
            --text-main:#f1f5f9; --text-muted:#64748b; --text-nav:#94a3b8;
            --nav-hover:#1e3a5f; --nav-active:#1e3a5f; --nav-active-text:#60a5fa;
            --label-color:#475569; --footer-br:#334155;
            --logout-color:#f87171; --logout-bg:rgba(239,68,68,0.1); --logout-br:rgba(239,68,68,0.2); --logout-hover:rgba(239,68,68,0.18);
            --toggle-bg:#334155; --toggle-br:#475569;
            --modal-bg:#1e293b; --modal-br:#334155; --modal-overlay:rgba(0,0,0,0.6);
            --input-bg:#0f172a; --input-br:#334155;
            --avatar-zone:#0f172a; --avatar-zone-br:#334155;
        }

        body { background: var(--bg); }

        /* Sidebar */
        .sidebar { position:fixed; top:0; left:0; width:240px; height:100vh; background:var(--sidebar-bg); border-right:1px solid var(--sidebar-br); display:flex; flex-direction:column; z-index:100; transition:background 0.3s, border-color 0.3s; }
        .sidebar-logo { display:flex; align-items:center; gap:10px; padding:18px 20px; border-bottom:1px solid var(--sidebar-br); text-decoration:none; }
        .logo-icon { width:34px; height:34px; background:linear-gradient(135deg,#3b82f6,#6366f1); border-radius:10px; display:flex; align-items:center; justify-content:center; box-shadow:0 3px 10px rgba(59,130,246,0.28); flex-shrink:0; }
        .logo-icon svg { width:17px; height:17px; stroke:white; fill:none; }
        .logo-text { font-family:'Lora',serif; font-size:1.05rem; font-weight:700; color:var(--text-main); }
        .logo-text span { color:#3b82f6; }
        .sidebar-nav { flex:1; padding:16px 12px; display:flex; flex-direction:column; gap:2px; }
        .nav-section-label { font-size:0.6rem; text-transform:uppercase; letter-spacing:0.13em; color:var(--label-color); padding:0 10px; margin-bottom:6px; margin-top:4px; }
        .nav-link { display:flex; align-items:center; gap:10px; padding:9px 12px; border-radius:10px; font-size:0.855rem; font-weight:500; color:var(--text-nav); text-decoration:none; transition:all 0.15s; }
        .nav-link svg { width:16px; height:16px; stroke:currentColor; fill:none; flex-shrink:0; transition:color 0.15s; }
        .nav-link:hover { background:var(--nav-hover); color:var(--nav-active-text); }
        .nav-link.active { background:var(--nav-active); color:var(--nav-active-text); font-weight:600; }

        /* Sidebar footer - clickable for profile */
        .sidebar-footer { display:flex; align-items:center; gap:10px; padding:14px 16px; border-top:1px solid var(--footer-br); cursor:pointer; transition:background 0.15s; border-radius:0 0 0 0; }
        .sidebar-footer:hover { background:var(--nav-hover); }
        .user-avatar-wrap { position:relative; flex-shrink:0; }
        .user-avatar {
            width:36px; height:36px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            color:white; font-weight:700; font-size:0.78rem;
            background:linear-gradient(135deg,#3b82f6,#6366f1);
            overflow:hidden; border:2px solid transparent;
            transition:border-color 0.15s;
        }
        .user-avatar img { width:100%; height:100%; object-fit:cover; }
        .sidebar-footer:hover .user-avatar { border-color:#3b82f6; }
        .avatar-edit-badge {
            position:absolute; bottom:-1px; right:-1px;
            width:14px; height:14px;
            background:#3b82f6; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            border:2px solid var(--sidebar-bg);
        }
        .avatar-edit-badge svg { width:7px; height:7px; stroke:white; fill:none; }
        .user-name { font-size:0.78rem; font-weight:600; color:var(--text-main); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .user-role { font-size:0.65rem; color:var(--text-muted); }

        /* Topbar */
        .topbar { position:sticky; top:0; z-index:50; background:var(--topbar-bg); border-bottom:1px solid var(--topbar-br); padding:12px 24px; display:flex; align-items:center; justify-content:space-between; box-shadow:0 1px 6px rgba(15,23,42,0.04); transition:background 0.3s, border-color 0.3s; }
        .topbar-greeting { font-size:0.82rem; color:var(--text-muted); }
        .topbar-greeting span { color:var(--text-main); font-weight:600; }
        .topbar-right { display:flex; align-items:center; gap:10px; }
        .theme-toggle { width:36px; height:36px; background:var(--toggle-bg); border:1px solid var(--toggle-br); border-radius:9px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.15s; flex-shrink:0; }
        .theme-toggle:hover { border-color:#3b82f6; }
        .theme-toggle svg { width:15px; height:15px; stroke:var(--text-muted); fill:none; }
        .icon-sun { display:none; } .icon-moon { display:block; }
        html.dark .icon-sun { display:block; } html.dark .icon-moon { display:none; }
        .logout-btn { display:flex; align-items:center; gap:6px; font-size:0.8rem; font-weight:500; color:var(--logout-color); padding:7px 13px; border-radius:9px; background:var(--logout-bg); border:1px solid var(--logout-br); cursor:pointer; font-family:'Outfit',sans-serif; transition:all 0.15s; }
        .logout-btn:hover { background:var(--logout-hover); }
        .logout-btn svg { width:14px; height:14px; stroke:currentColor; fill:none; }

        .main-wrap { margin-left:240px; display:flex; flex-direction:column; min-height:100vh; }
        .page-content { padding:24px; flex:1; }

        /* ── Profile Modal ── */
        .modal-overlay { display:none; position:fixed; inset:0; background:var(--modal-overlay); z-index:200; align-items:center; justify-content:center; backdrop-filter:blur(4px); }
        .modal-overlay.open { display:flex; }
        .modal {
            background:var(--modal-bg); border:1px solid var(--modal-br);
            border-radius:20px; width:100%; max-width:400px; margin:16px;
            box-shadow:0 20px 60px rgba(0,0,0,0.15);
            animation:slideUp 0.2s ease;
        }
        @keyframes slideUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
        .modal-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px 0; }
        .modal-title { font-family:'Lora',serif; font-size:1rem; font-weight:700; color:var(--text-main); }
        .modal-close { width:30px; height:30px; background:var(--toggle-bg); border:1px solid var(--toggle-br); border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.15s; }
        .modal-close:hover { border-color:#ef4444; color:#ef4444; }
        .modal-close svg { width:14px; height:14px; stroke:var(--text-muted); fill:none; }
        .modal-body { padding:20px 24px 24px; }

        /* Avatar upload zone */
        .avatar-current {
            display:flex; flex-direction:column; align-items:center; gap:12px;
            margin-bottom:20px;
        }
        .avatar-big {
            width:90px; height:90px; border-radius:50%;
            background:linear-gradient(135deg,#3b82f6,#6366f1);
            display:flex; align-items:center; justify-content:center;
            color:white; font-weight:700; font-size:1.6rem;
            overflow:hidden; border:3px solid var(--modal-br);
            box-shadow:0 4px 16px rgba(59,130,246,0.2);
        }
        .avatar-big img { width:100%; height:100%; object-fit:cover; }
        .avatar-name { font-size:0.9rem; font-weight:600; color:var(--text-main); }
        .avatar-role { font-size:0.72rem; color:var(--text-muted); }

        .upload-zone {
            border:2px dashed var(--avatar-zone-br);
            border-radius:14px; background:var(--avatar-zone);
            padding:20px; text-align:center; cursor:pointer;
            transition:all 0.15s; margin-bottom:14px;
        }
        .upload-zone:hover { border-color:#3b82f6; background:rgba(59,130,246,0.04); }
        .upload-zone svg { width:28px; height:28px; stroke:#94a3b8; fill:none; margin:0 auto 8px; display:block; }
        .upload-zone p { font-size:0.8rem; color:var(--text-muted); }
        .upload-zone span { color:#3b82f6; font-weight:600; }
        .upload-zone input { display:none; }

        .preview-wrap { display:none; text-align:center; margin-bottom:14px; }
        .preview-img { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid #3b82f6; margin:0 auto 8px; display:block; }
        .preview-name { font-size:0.75rem; color:var(--text-muted); }

        .modal-actions { display:flex; gap:8px; }
        .btn-save {
            flex:1; background:linear-gradient(135deg,#3b82f6,#6366f1);
            color:#fff; font-family:'Outfit',sans-serif; font-size:0.85rem; font-weight:600;
            padding:10px; border-radius:10px; border:none; cursor:pointer;
            transition:opacity 0.15s; box-shadow:0 3px 12px rgba(59,130,246,0.3);
        }
        .btn-save:hover { opacity:0.9; }
        .btn-save:disabled { opacity:0.5; cursor:not-allowed; }
        .btn-remove {
            background:var(--logout-bg); color:var(--logout-color);
            border:1px solid var(--logout-br); font-family:'Outfit',sans-serif;
            font-size:0.85rem; font-weight:500; padding:10px 14px;
            border-radius:10px; cursor:pointer; transition:all 0.15s;
        }
        .btn-remove:hover { background:var(--logout-hover); }
    </style>
</head>
<body>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ title:"Berhasil!", text:"{{ session('success') }}", icon:"success", confirmButtonColor:"#3b82f6", timer:2200, timerProgressBar:true });
        });
    </script>
    @endif

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <a href="{{ route('home') }}" class="sidebar-logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                </svg>
            </div>
            <span class="logo-text">E-<span>Library</span></span>
        </a>

        <nav class="sidebar-nav">
            <p class="nav-section-label">Menu Utama</p>
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Home
            </a>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <p class="nav-section-label" style="margin-top:12px;">Kelola Data</p>
            <a href="{{ route('genre.index') }}" class="nav-link {{ request()->routeIs('genre*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                Genre
            </a>
            <a href="{{ route('penulis.index') }}" class="nav-link {{ request()->routeIs('penulis*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Author
            </a>
            <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                Books
            </a>
        </nav>

        {{-- Footer: klik untuk buka modal profil --}}
        <div class="sidebar-footer" onclick="openProfileModal()">
            <div class="user-avatar-wrap">
                <div class="user-avatar">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="avatar-edit-badge">
                    <svg viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </div>
            </div>
            <div style="flex:1; min-width:0;">
                <p class="user-name">{{ Auth::user()->name }}</p>
                <p class="user-role">{{ Auth::user()->role }} · Edit profil</p>
            </div>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-wrap">
        <nav class="topbar">
            <p class="topbar-greeting">Selamat datang, <span>{{ Auth::user()->name }}</span></p>
            <div class="topbar-right">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
        <main class="page-content">
            @yield('content')
        </main>
    </div>

    {{-- ── PROFILE MODAL ── --}}
    <div class="modal-overlay" id="profileModal" onclick="closeOnOverlay(event)">
        <div class="modal">
            <div class="modal-header">
                <p class="modal-title">Edit Foto Profil</p>
                <button class="modal-close" onclick="closeProfileModal()">
                    <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                {{-- Current avatar --}}
                <div class="avatar-current">
                    <div class="avatar-big" id="avatarBig">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar" id="currentAvatarImg">
                        @else
                            <span id="avatarInitial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="avatar-name">{{ Auth::user()->name }}</p>
                        <p class="avatar-role">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                {{-- Upload form --}}
                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                    @csrf
                    <div class="upload-zone" id="uploadZone" onclick="document.getElementById('avatarInput').click()">
                        <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        <p><span>Klik untuk upload</span> atau drag & drop</p>
                        <p style="font-size:0.7rem;margin-top:4px;">JPG, PNG, WEBP — maks. 2MB</p>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="previewAvatar(event)">
                    </div>

                    {{-- Preview --}}
                    <div class="preview-wrap" id="previewWrap">
                        <img id="previewImg" class="preview-img" src="" alt="preview">
                        <p class="preview-name" id="previewName"></p>
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn-save" id="btnSave" disabled>Simpan Foto</button>
                        @if(Auth::user()->avatar)
                        <form action="{{ route('profile.remove') }}" method="POST" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-remove" onclick="return confirm('Hapus foto profil?')">Hapus</button>
                        </form>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        // ── Profile Modal ──
        function openProfileModal() {
            document.getElementById('profileModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeProfileModal() {
            document.getElementById('profileModal').classList.remove('open');
            document.body.style.overflow = '';
        }
        function closeOnOverlay(e) {
            if (e.target === document.getElementById('profileModal')) closeProfileModal();
        }

        // ── Preview avatar ──
        function previewAvatar(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('previewName').textContent = file.name;
                document.getElementById('previewWrap').style.display = 'block';
                document.getElementById('uploadZone').style.display = 'none';
                document.getElementById('btnSave').disabled = false;
            };
            reader.readAsDataURL(file);
        }

        // ── Drag & drop ──
        const zone = document.getElementById('uploadZone');
        if (zone) {
            zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor = '#3b82f6'; });
            zone.addEventListener('dragleave', () => { zone.style.borderColor = ''; });
            zone.addEventListener('drop', e => {
                e.preventDefault(); zone.style.borderColor = '';
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    document.getElementById('avatarInput').files = dt.files;
                    previewAvatar({ target: { files: [file] } });
                }
            });
        }
    </script>
</body>
</html>