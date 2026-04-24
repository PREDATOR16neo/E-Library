<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>E-Library</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: #f8fafc; min-height: 100vh; }

        .page-wrap { max-width: 1200px; margin: 0 auto; padding: 32px 24px; }

        /* ── Hero ── */
        .hero {
            background: linear-gradient(135deg, #eff6ff 0%, #f0f4ff 60%, #faf5ff 100%);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 36px 36px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; right: -50px; top: -50px;
            width: 260px; height: 260px;
            background: rgba(99,102,241,0.06);
            border-radius: 50%;
        }
        .hero-title {
            font-family: 'Lora', serif;
            font-size: 1.65rem; font-weight: 700;
            color: #1e293b; line-height: 1.3;
            margin-bottom: 8px;
        }
        .hero-title span { color: #3b82f6; }
        .hero-sub { font-size: 0.875rem; color: #64748b; margin-bottom: 18px; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #fff; border: 1px solid #e2e8f0;
            border-radius: 99px; padding: 6px 14px;
            font-size: 0.75rem; font-weight: 600; color: #475569;
        }
        .hero-badge svg { width: 13px; height: 13px; stroke: #3b82f6; fill: none; }
        .hero-icon {
            width: 76px; height: 76px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 24px rgba(59,130,246,0.25);
            flex-shrink: 0;
        }
        .hero-icon svg { width: 36px; height: 36px; stroke: white; fill: none; }

        /* ── Toolbar ── */
        .toolbar {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 24px;
        }
        .search-wrap { position: relative; flex: 1; }
        .search-input {
            width: 100%; background: #fff;
            border: 1px solid #e2e8f0; border-radius: 12px;
            padding: 11px 16px 11px 42px;
            font-size: 0.875rem; font-family: 'Outfit', sans-serif;
            color: #1e293b; outline: none;
            transition: border 0.18s, box-shadow 0.18s;
        }
        .search-input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .search-input::placeholder { color: #cbd5e1; }
        .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; stroke: #94a3b8; fill: none; pointer-events: none; }

        /* ── Section header ── */
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 20px;
        }
        .section-title { font-family: 'Lora', serif; font-size: 1.1rem; font-weight: 700; color: #1e293b; }
        .section-sub { font-size: 0.75rem; color: #94a3b8; margin-top: 2px; }
        .books-count {
            font-size: 0.75rem; font-weight: 600; color: #3b82f6;
            background: #eff6ff; border: 1px solid #bfdbfe;
            padding: 4px 12px; border-radius: 99px;
        }

        /* ── Book grid ── */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 20px;
        }

        /* ── Book card ── */
        .book-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            overflow: hidden;
            text-decoration: none;
            display: flex; flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 36px rgba(15,23,42,0.1);
            border-color: #bfdbfe;
        }
        .book-cover-wrap {
            position: relative;
            height: 220px;
            background: #f1f5f9;
            overflow: hidden;
        }
        .book-cover {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .book-card:hover .book-cover { transform: scale(1.05); }
        .cover-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(15,23,42,0.45) 0%, transparent 55%);
        }
        .cover-placeholder {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #eff6ff, #f0f4ff);
            display: flex; align-items: center; justify-content: center;
        }
        .cover-placeholder svg { width: 44px; height: 44px; stroke: #bfdbfe; fill: none; }
        .genre-badge {
            position: absolute; top: 10px; right: 10px;
            background: rgba(59,130,246,0.92);
            color: #fff; font-size: 0.62rem; font-weight: 700;
            padding: 3px 10px; border-radius: 99px;
            text-transform: uppercase; letter-spacing: 0.05em;
            backdrop-filter: blur(4px);
        }
        .year-badge {
            position: absolute; bottom: 10px; left: 10px;
            color: rgba(255,255,255,0.85); font-size: 0.72rem; font-weight: 500;
        }

        .book-info { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
        .book-title {
            font-size: 0.875rem; font-weight: 700; color: #1e293b;
            line-height: 1.35;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            transition: color 0.15s;
        }
        .book-card:hover .book-title { color: #3b82f6; }
        .book-sinopsis {
            font-size: 0.75rem; color: #94a3b8; line-height: 1.55;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .book-author {
            display: flex; align-items: center; gap: 5px;
            font-size: 0.75rem; color: #64748b; margin-top: auto; padding-top: 6px;
        }
        .book-author svg { width: 12px; height: 12px; stroke: #94a3b8; fill: none; flex-shrink: 0; }
        .book-footer {
            padding: 10px 14px;
            border-top: 1px solid #f1f5f9;
        }
        .btn-detail {
            display: flex; align-items: center; justify-content: center; gap: 5px;
            font-size: 0.78rem; font-weight: 600; color: #3b82f6;
            background: #eff6ff; border: 1px solid #bfdbfe;
            border-radius: 9px; padding: 7px;
            text-decoration: none; transition: all 0.15s;
        }
        .btn-detail:hover { background: #dbeafe; color: #2563eb; }
        .btn-detail svg { width: 12px; height: 12px; stroke: currentColor; fill: none; }

        /* ── Empty ── */
        .empty-state { text-align: center; padding: 60px 24px; color: #94a3b8; grid-column: 1/-1; }
        .empty-state svg { width: 48px; height: 48px; stroke: #cbd5e1; fill: none; margin: 0 auto 14px; display: block; }
        .empty-state p { font-size: 0.875rem; }
    </style>
</head>
<body>

    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ title: "Gagal!", text: "{{ session('error') }}", icon: "error", confirmButtonColor: "#3b82f6" });
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ title: "Berhasil!", text: "{{ session('success') }}", icon: "success", confirmButtonColor: "#3b82f6", timer: 2000, timerProgressBar: true });
        });
    </script>
    @endif

    <x-navbar></x-navbar>

    <div class="page-wrap">

        {{-- Hero --}}
        <div class="hero">
            <div>
                <p class="hero-title">Koleksi<br><span>Perpustakaan Digital</span></p>
                <p class="hero-sub">Temukan dan pinjam buku favoritmu dari koleksi kami.</p>
                <div class="hero-badge">
                    <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                    {{ $books->count() }} Buku Tersedia
                </div>
            </div>
            <div class="hero-icon">
                <svg viewBox="0 0 24 24" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                </svg>
            </div>
        </div>

        {{-- Search --}}
        <div class="toolbar">
            <div class="search-wrap">
                <svg class="search-icon" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari judul buku atau nama author..." oninput="filterBooks()">
            </div>
        </div>

        {{-- Section header --}}
        <div class="section-header">
            <div>
                <p class="section-title">Semua Buku</p>
                <p class="section-sub">Klik buku untuk melihat detail lengkap</p>
            </div>
            <span class="books-count" id="booksCount">{{ $books->count() }} buku</span>
        </div>

        {{-- Grid --}}
        <div class="books-grid" id="booksGrid">
            @forelse ($books as $book)
            <a href="{{ route('books.detail', $book->id) }}" class="book-card"
            data-title="{{ strtolower($book->judul) }}"
            data-author="{{ strtolower($book->author->name_author ?? '') }}">

                <div class="book-cover-wrap">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}" class="book-cover">
                        <div class="cover-overlay"></div>
                    @else
                        <div class="cover-placeholder">
                            <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                        </div>
                    @endif
                    @if($book->genre)
                        <span class="genre-badge">{{ $book->genre->name_genres }}</span>
                    @endif
                    <span class="year-badge">{{ $book->tahun_terbit }}</span>
                </div>

                <div class="book-info">
                    <p class="book-title">{{ $book->judul }}</p>
                    <p class="book-sinopsis">{{ $book->sinopsis }}</p>
                    <div class="book-author">
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        {{ $book->author->name_author ?? '-' }}
                    </div>
                </div>

                <div class="book-footer">
                    <div class="btn-detail">
                        Lihat Detail
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

            </a>
            @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                </svg>
                <p>Belum ada buku tersedia saat ini.</p>
            </div>
            @endforelse
        </div>

        {{-- No result --}}
        <div id="noResult" style="display:none;" class="empty-state">
            <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <p>Buku tidak ditemukan. Coba kata kunci lain.</p>
        </div>

    </div>

    <script>
        function filterBooks() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('#booksGrid .book-card');
            let visible = 0;

            cards.forEach(card => {
                const match = card.dataset.title.includes(q) || card.dataset.author.includes(q);
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            document.getElementById('booksCount').textContent = visible + ' buku';
            document.getElementById('noResult').style.display = (visible === 0 && q.length > 0) ? 'block' : 'none';
        }
    </script>

</body>
</html>