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
        :root {
            --bg:#f8fafc; --navbar-bg:#ffffff; --navbar-br:#e2e8f0;
            --text-main:#1e293b; --text-muted:#64748b;
            --nav-hover:#f1f5f9; --nav-active-bg:#eff6ff; --nav-active-c:#3b82f6;
            --chip-bg:#f8fafc; --chip-br:#e2e8f0;
            --logout-bg:#fff5f5; --logout-br:#fecaca; --logout-c:#ef4444; --logout-hover:#fee2e2;
            --toggle-bg:#f1f5f9; --toggle-br:#e2e8f0;
            --modal-bg:#ffffff; --modal-br:#e2e8f0; --modal-ov:rgba(15,23,42,0.4);
            --zone-bg:#f8fafc; --zone-br:#e2e8f0;
        }
        html.dark {
            --bg:#0f172a; --navbar-bg:#1e293b; --navbar-br:#334155;
            --text-main:#f1f5f9; --text-muted:#94a3b8;
            --nav-hover:#1e293b; --nav-active-bg:#1e3a5f; --nav-active-c:#60a5fa;
            --chip-bg:#0f172a; --chip-br:#334155;
            --logout-bg:rgba(239,68,68,0.1); --logout-br:rgba(239,68,68,0.2); --logout-c:#f87171; --logout-hover:rgba(239,68,68,0.18);
            --toggle-bg:#334155; --toggle-br:#475569;
            --modal-bg:#1e293b; --modal-br:#334155; --modal-ov:rgba(0,0,0,0.6);
            --zone-bg:#0f172a; --zone-br:#334155;
        }

        body { font-family:'Outfit',sans-serif; background:var(--bg); min-height:100vh; transition:background 0.3s; }
        .navbar { background:var(--navbar-bg); border-bottom:1px solid var(--navbar-br); position:sticky; top:0; z-index:100; box-shadow:0 1px 12px rgba(15,23,42,0.06); transition:background 0.3s, border-color 0.3s; }
        .navbar-inner { max-width:1200px; margin:0 auto; padding:0 24px; height:64px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .logo { display:flex; align-items:center; gap:10px; text-decoration:none; flex-shrink:0; }
        .logo-icon { width:36px; height:36px; background:linear-gradient(135deg,#3b82f6,#6366f1); border-radius:10px; display:flex; align-items:center; justify-content:center; box-shadow:0 3px 10px rgba(59,130,246,0.3); }
        .logo-icon svg { width:18px; height:18px; stroke:white; fill:none; }
        .logo-text { font-family:'Lora',serif; font-size:1.15rem; font-weight:700; color:var(--text-main); transition:color 0.3s; }
        .logo-text span { color:#3b82f6; }
        .nav-links { display:flex; align-items:center; gap:4px; }
        .nav-link { font-size:0.85rem; font-weight:500; color:var(--text-muted); text-decoration:none; padding:7px 14px; border-radius:9px; transition:all 0.15s; }
        .nav-link:hover { color:var(--text-main); background:var(--nav-hover); }
        .nav-link.active { color:var(--nav-active-c); background:var(--nav-active-bg); font-weight:600; }
        .auth-area { display:flex; align-items:center; gap:10px; flex-shrink:0; }
        .icon-sun { display:none; } .icon-moon { display:block; }
        html.dark .icon-sun { display:block; } html.dark .icon-moon { display:none; }
        .user-chip { display:flex; align-items:center; gap:8px; background:var(--chip-bg); border:1px solid var(--chip-br); border-radius:99px; padding:4px 12px 4px 4px; cursor:pointer; transition:all 0.15s; }
        .user-chip:hover { border-color:#3b82f6; }
        .user-avatar { width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,#3b82f6,#6366f1); display:flex; align-items:center; justify-content:center; font-size:0.72rem; font-weight:700; color:white; flex-shrink:0; overflow:hidden; }
        .user-avatar img { width:100%; height:100%; object-fit:cover; }
        .user-name { font-size:0.8rem; font-weight:600; color:var(--text-main); max-width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .edit-hint { font-size:0.65rem; color:var(--text-muted); display:block; line-height:1; }
        .btn-logout { display:flex; align-items:center; gap:6px; font-size:0.8rem; font-weight:600; color:var(--logout-c); background:var(--logout-bg); border:1px solid var(--logout-br); padding:7px 14px; border-radius:9px; cursor:pointer; font-family:'Outfit',sans-serif; transition:all 0.15s; }
        .btn-logout:hover { background:var(--logout-hover); }
        .btn-logout svg { width:14px; height:14px; stroke:currentColor; fill:none; }
        .btn-login { display:flex; align-items:center; gap:6px; font-size:0.85rem; font-weight:600; color:#fff; background:linear-gradient(135deg,#3b82f6,#6366f1); padding:8px 18px; border-radius:10px; text-decoration:none; box-shadow:0 3px 12px rgba(59,130,246,0.3); transition:opacity 0.15s; }
        .btn-login:hover { opacity:0.9; }
        .page-content { max-width:1200px; margin:0 auto; padding:32px 24px; }

        /* Modal */
        .modal-overlay { display:none; position:fixed; inset:0; background:var(--modal-ov); z-index:200; align-items:center; justify-content:center; backdrop-filter:blur(4px); }
        .modal-overlay.open { display:flex; }
        .modal { background:var(--modal-bg); border:1px solid var(--modal-br); border-radius:20px; width:100%; max-width:380px; margin:16px; box-shadow:0 20px 60px rgba(0,0,0,0.15); animation:slideUp 0.2s ease; }
        @keyframes slideUp { from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);} }
        .modal-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px 0; }
        .modal-title { font-family:'Lora',serif; font-size:1rem; font-weight:700; color:var(--text-main); }
        .modal-close { width:30px; height:30px; background:var(--toggle-bg); border:1px solid var(--toggle-br); border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.15s; }
        .modal-close:hover { border-color:#ef4444; }
        .modal-close svg { width:14px; height:14px; stroke:var(--text-muted); fill:none; }
        .modal-body { padding:20px 24px 24px; }
        .avatar-current { display:flex; flex-direction:column; align-items:center; gap:10px; margin-bottom:18px; }
        .avatar-big { width:86px; height:86px; border-radius:50%; background:linear-gradient(135deg,#3b82f6,#6366f1); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:1.6rem; overflow:hidden; border:3px solid var(--modal-br); box-shadow:0 4px 16px rgba(59,130,246,0.2); }
        .avatar-big img { width:100%; height:100%; object-fit:cover; }
        .avatar-uname { font-size:0.88rem; font-weight:600; color:var(--text-main); }
        .avatar-role { font-size:0.7rem; color:var(--text-muted); }
        .upload-zone { border:2px dashed var(--zone-br); border-radius:14px; background:var(--zone-bg); padding:18px; text-align:center; cursor:pointer; transition:all 0.15s; margin-bottom:12px; }
        .upload-zone:hover { border-color:#3b82f6; background:rgba(59,130,246,0.04); }
        .upload-zone svg { width:26px; height:26px; stroke:#94a3b8; fill:none; margin:0 auto 8px; display:block; }
        .upload-zone p { font-size:0.78rem; color:var(--text-muted); }
        .upload-zone span { color:#3b82f6; font-weight:600; }
        .preview-wrap { display:none; text-align:center; margin-bottom:12px; }
        .preview-img { width:76px; height:76px; border-radius:50%; object-fit:cover; border:3px solid #3b82f6; margin:0 auto 6px; display:block; }
        .preview-fname { font-size:0.72rem; color:var(--text-muted); }
        .modal-actions { display:flex; gap:8px; }
        .btn-save { flex:1; background:linear-gradient(135deg,#3b82f6,#6366f1); color:#fff; font-family:'Outfit',sans-serif; font-size:0.85rem; font-weight:600; padding:10px; border-radius:10px; border:none; cursor:pointer; box-shadow:0 3px 12px rgba(59,130,246,0.3); transition:opacity 0.15s; }
        .btn-save:hover { opacity:0.9; }
        .btn-save:disabled { opacity:0.45; cursor:not-allowed; }
        .btn-remove { background:var(--logout-bg); color:var(--logout-c); border:1px solid var(--logout-br); font-family:'Outfit',sans-serif; font-size:0.85rem; font-weight:500; padding:10px 14px; border-radius:10px; cursor:pointer; transition:all 0.15s; white-space:nowrap; }
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
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({ title:"Gagal!", text:"{{ session('error') }}", icon:"error", confirmButtonColor:"#3b82f6" });
    });
</script>
@endif
@if($errors->has('avatar'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({ title:"Upload Gagal!", text:"{{ $errors->first('avatar') }}", icon:"error", confirmButtonColor:"#3b82f6" });
        openProfileModal();
    });
</script>
@endif

<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                </svg>
            </div>
            <span class="logo-text">E-<span>Library</span></span>
        </a>

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

        <div class="auth-area">
            <button class="theme-toggle" onclick="toggleTheme()" title="Toggle dark mode">
                <svg class="icon-moon" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
                <svg class="icon-sun" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
            </button>

            @guest
                <a href="{{ route('login') }}" class="btn-login">Login</a>
            @endguest

            @auth
                <div class="user-chip" onclick="openProfileModal()" title="Edit foto profil">
                    <div class="user-avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="edit-hint">edit profil</span>
                    </div>
                </div>

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

{{-- ── PROFILE MODAL ── --}}
@auth

{{-- Form upload — DI LUAR modal div supaya tidak nested --}}
<form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm" style="display:none;">
    @csrf
    <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="previewAvatar(event)">
</form>

{{-- Form hapus — terpisah dari form upload --}}
<form action="{{ route('profile.remove') }}" method="POST" id="removeForm" style="display:none;">
    @csrf
    @method('DELETE')
</form>

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

            {{-- Avatar saat ini --}}
            <div class="avatar-current">
                <div class="avatar-big" id="avatarBigModal">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <div style="text-align:center;">
                    <p class="avatar-uname">{{ Auth::user()->name }}</p>
                    <p class="avatar-role">{{ Auth::user()->role }}</p>
                </div>
            </div>

            {{-- Upload zone --}}
            <div class="upload-zone" id="uploadZone" onclick="document.getElementById('avatarInput').click()">
                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                <p><span>Klik untuk upload</span> atau drag & drop</p>
                <p style="font-size:0.68rem;margin-top:3px;color:#94a3b8;">JPG, PNG, WEBP · maks. 2MB</p>
            </div>

            {{-- Preview --}}
            <div class="preview-wrap" id="previewWrap">
                <img id="previewImg" class="preview-img" src="" alt="preview">
                <p class="preview-fname" id="previewFname"></p>
                {{-- Tombol ganti ulang --}}
                <button type="button" onclick="resetUpload()" style="font-size:0.72rem;color:#94a3b8;background:none;border:none;cursor:pointer;margin-top:4px;text-decoration:underline;">Pilih foto lain</button>
            </div>

            {{-- Actions --}}
            <div class="modal-actions">
                <button type="button" class="btn-save" id="btnSave" disabled onclick="document.getElementById('avatarForm').submit()">
                    Simpan Foto
                </button>
                @if(Auth::user()->avatar)
                <button type="button" class="btn-remove" onclick="confirmRemove()">Hapus</button>
                @endif
            </div>

        </div>
    </div>
</div>
@endauth

<div class="page-content">
    @yield('content')
</div>

<script>

    // ── Modal ──
    function openProfileModal() {
        document.getElementById('profileModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeProfileModal() {
        document.getElementById('profileModal').classList.remove('open');
        document.body.style.overflow = '';
        resetUpload();
    }
    function closeOnOverlay(e) {
        if (e.target === document.getElementById('profileModal')) closeProfileModal();
    }

    // ── Preview ──
    function previewAvatar(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('previewFname').textContent = file.name;
            document.getElementById('previewWrap').style.display = 'block';
            document.getElementById('uploadZone').style.display = 'none';
            document.getElementById('btnSave').disabled = false;
        };
        reader.readAsDataURL(file);
    }

    function resetUpload() {
        document.getElementById('previewWrap').style.display = 'none';
        document.getElementById('uploadZone').style.display = 'block';
        document.getElementById('btnSave').disabled = true;
        document.getElementById('avatarInput').value = '';
    }

    // ── Hapus avatar ──
    function confirmRemove() {
        Swal.fire({
            title: 'Hapus foto profil?',
            text: 'Foto profil kamu akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('removeForm').submit();
            }
        });
    }

    // ── Drag & drop ──
    const zone = document.getElementById('uploadZone');
    if (zone) {
        zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor='#3b82f6'; });
        zone.addEventListener('dragleave', () => { zone.style.borderColor=''; });
        zone.addEventListener('drop', e => {
            e.preventDefault(); zone.style.borderColor='';
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