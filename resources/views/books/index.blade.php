@extends('layouts.app')

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    @if (session('success'))
        <script>
            Swal.fire({ title: "Berhasil!", text: "{{ session('success') }}", icon: "success", confirmButtonColor: "#3b82f6", timer: 2000, timerProgressBar: true });
        </script>
    @endif

    {{-- Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.25rem; font-weight:700; color:#1e293b;">Buku</h1>
            <p style="font-size:0.8rem; color:#94a3b8; margin-top:2px;">Kelola semua koleksi buku</p>
        </div>
        <a href="{{ route('books.create') }}" style="display:flex; align-items:center; gap:8px; background:linear-gradient(135deg,#3b82f6,#60a5fa); color:#fff; font-size:0.82rem; font-weight:600; padding:9px 18px; border-radius:11px; text-decoration:none; box-shadow:0 4px 14px rgba(59,130,246,0.3);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Buku
        </a>
    </div>

    {{-- Grid Cards --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px,1fr)); gap:18px;">
        @foreach ($books as $book)
            <div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; overflow:hidden; transition:transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(15,23,42,0.1)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none';">

                {{-- Book Cover --}}
                <div style="position:relative; height:200px; background:#f1f5f9; overflow:hidden;">
                    <img
                        src="{{ asset('storage/' . $book->image) }}"
                        alt="{{ $book->judul }}"
                        style="width:100%; height:100%; object-fit:cover; transition:transform 0.3s;"
                        onmouseover="this.style.transform='scale(1.05)'"
                        onmouseout="this.style.transform='scale(1)'"
                    >
                    <div style="position:absolute; top:10px; right:10px;">
                        <span style="background:rgba(59,130,246,0.9); color:#fff; font-size:0.65rem; font-weight:600; padding:3px 10px; border-radius:99px; backdrop-filter:blur(4px);">
                            {{ $book->genre->name_genres }}
                        </span>
                    </div>
                </div>

                {{-- Book Info --}}
                <div style="padding:14px;">
                    <div style="margin-bottom:8px;">
                        <h2 style="font-size:0.875rem; font-weight:600; color:#1e293b; line-height:1.35;">{{ $book->judul }}</h2>
                        <p style="font-size:0.72rem; color:#94a3b8; margin-top:3px;">{{ $book->author->name_author }} · {{ $book->tahun_terbit }}</p>
                    </div>
                    <p style="font-size:0.72rem; color:#94a3b8; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; margin-bottom:12px;">{{ $book->sinopsis }}</p>

                    {{-- Actions --}}
                    <div style="display:flex; align-items:center; gap:6px;">
                        <a href="{{ route('books.detail', $book->id) }}" style="flex:1; text-align:center; font-size:0.75rem; font-weight:500; color:#3b82f6; background:#eff6ff; border:1px solid #bfdbfe; padding:6px 0; border-radius:8px; text-decoration:none; transition:all 0.15s;" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                            Detail
                        </a>
                        <a href="{{ route('books.edit', $book->id) }}" style="flex:1; text-align:center; font-size:0.75rem; font-weight:500; color:#475569; background:#f8fafc; border:1px solid #e2e8f0; padding:6px 0; border-radius:8px; text-decoration:none; transition:all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            Edit
                        </a>
                        <form action="{{ route('books.delete', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="tombol(this)" style="display:flex; align-items:center; justify-content:center; color:#ef4444; background:#fff5f5; border:1px solid #fecaca; padding:6px 10px; border-radius:8px; cursor:pointer; transition:all 0.15s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function tombol(btn) {
            Swal.fire({
                title: "Hapus buku ini?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#94a3b8",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }
    </script>

@endsection