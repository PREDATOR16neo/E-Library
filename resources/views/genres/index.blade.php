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
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 style="font-size:1.25rem; font-weight:700; color:#1e293b;">Genre</h1>
            <p style="font-size:0.8rem; color:#94a3b8; margin-top:2px;">Kelola semua genre buku</p>
        </div>
        <a href="{{ route('genre.create') }}" style="display:flex; align-items:center; gap:8px; background:linear-gradient(135deg,#3b82f6,#60a5fa); color:#fff; font-size:0.82rem; font-weight:600; padding:9px 18px; border-radius:11px; text-decoration:none; box-shadow:0 4px 14px rgba(59,130,246,0.3); transition:opacity 0.17s;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Genre
        </a>
    </div>

    {{-- Table --}}
    <div style="background:#fff; border:1px solid #e2e8f0; border-radius:16px; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <th style="padding:14px 20px; text-align:left; font-size:0.68rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.08em; width:48px;">#</th>
                    <th style="padding:14px 20px; text-align:left; font-size:0.68rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.08em;">Nama Genre</th>
                    <th style="padding:14px 20px; text-align:left; font-size:0.68rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.08em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $item)
                    <tr style="border-bottom:1px solid #f8fafc; transition:background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding:14px 20px; font-size:0.82rem; color:#94a3b8;">{{ $no++ }}</td>
                        <td style="padding:14px 20px; font-size:0.875rem; color:#1e293b; font-weight:500;">{{ $item->name_genres }}</td>
                        <td style="padding:14px 20px;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <a href="{{ route('genre.edit', $item->id) }}" style="display:flex; align-items:center; gap:6px; font-size:0.78rem; font-weight:500; color:#475569; background:#f8fafc; border:1px solid #e2e8f0; padding:6px 12px; border-radius:8px; text-decoration:none; transition:all 0.15s;" onmouseover="this.style.background='#eff6ff';this.style.borderColor='#bfdbfe';this.style.color='#3b82f6';" onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('genre.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="tombol(this)" style="display:flex; align-items:center; gap:6px; font-size:0.78rem; font-weight:500; color:#ef4444; background:#fff5f5; border:1px solid #fecaca; padding:6px 12px; border-radius:8px; cursor:pointer; transition:all 0.15s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function tombol(btn) {
            Swal.fire({
                title: "Hapus genre ini?",
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