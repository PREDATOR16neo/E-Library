@extends('layouts.app')

@section('content')

  @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ title: "Berhasil!", text: "{{ session('success') }}", icon: "success", confirmButtonColor: "#3b82f6", timer: 2200, timerProgressBar: true });
        });
    </script>
    @endif

    @if ($errors->any())
        <div style="margin-bottom:20px; background:#fff5f5; border:1px solid #fecaca; border-radius:12px; padding:14px 18px;">
            <ul style="list-style:none; display:flex; flex-direction:column; gap:6px;">
                @foreach ($errors->all() as $item)
                    <li style="font-size:0.8rem; color:#ef4444; display:flex; align-items:center; gap:8px;">
                        <span style="width:5px; height:5px; background:#ef4444; border-radius:50%; flex-shrink:0; display:inline-block;"></span>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="min-height:75vh; display:flex; flex-direction:column; align-items:center; justify-content:center;">

        {{-- Header --}}
        <div style="margin-bottom:24px; text-align:center;">
            <h1 style="font-size:1.25rem; font-weight:700; color:#1e293b;">Edit Buku</h1>
            <p style="font-size:0.8rem; color:#94a3b8; margin-top:3px;">Ubah informasi buku yang sudah ada</p>
        </div>

        {{-- Card Form --}}
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:18px; padding:32px; width:100%; max-width:640px; box-shadow:0 4px 24px rgba(15,23,42,0.06);">
            <form action="{{ route('books.update', $books->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Judul Buku</label>
                    <input type="text" name="judul" id="Judul" value="{{ $books->judul }}" required
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';" />
                </div>

                {{-- Sinopsis --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Sinopsis</label>
                    <input type="text" name="sinopsis" id="Sinopsis" value="{{ $books->sinopsis }}" required
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';" />
                </div>

                {{-- Tahun Terbit --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="TahunTerbit" value="{{ $books->tahun_terbit }}" required
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';" />
                </div>

                {{-- Genre --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Genre</label>
                    <select name="genre_id" id="genre"
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif; cursor:pointer;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';">
                        <option value="">-- Pilih Genre --</option>
                        @foreach ($genres as $item)
                            <option value="{{ $item->id }}" {{ $books->genre_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name_genres }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Author --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Author</label>
                    <select name="author_id" id="author"
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif; cursor:pointer;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';">
                        <option value="">-- Pilih Author --</option>
                        @foreach ($authors as $key)
                            <option value="{{ $key->id }}" {{ $books->author_id == $key->id ? 'selected' : '' }}>
                                {{ $key->name_author }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cover Buku --}}
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Cover Buku</label>

                    {{-- Current cover preview --}}
                    @if($books->image)
                    <div style="margin-bottom:10px;">
                        <p style="font-size:0.72rem; color:#94a3b8; margin-bottom:6px;">Cover saat ini:</p>
                        <img src="{{ asset('storage/' . $books->image) }}" alt="Cover" style="width:80px; height:110px; object-fit:cover; border-radius:10px; border:1px solid #e2e8f0;">
                    </div>
                    @endif

                    <label style="display:flex; align-items:center; gap:10px; background:#f8fafc; border:1px dashed #cbd5e1; border-radius:11px; padding:12px 14px; cursor:pointer; transition:border 0.17s;" onmouseover="this.style.borderColor='#3b82f6'" onmouseout="this.style.borderColor='#cbd5e1'">
                        <svg style="width:18px;height:18px;color:#94a3b8;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span style="font-size:0.82rem; color:#94a3b8;" id="fileLabel">Klik untuk pilih gambar baru</span>
                        <input type="file" name="image" id="imgInput" style="display:none;" accept="image/*">
                    </label>
                    <img src="" id="previewImg" alt="Preview" style="margin-top:10px; width:80px; height:110px; object-fit:cover; border-radius:10px; border:1px solid #e2e8f0; display:none;" />
                </div>

                {{-- Buttons --}}
                <div style="display:flex; align-items:center; gap:10px; padding-top:4px;">
                    <button type="submit" style="background:linear-gradient(135deg,#3b82f6,#60a5fa); color:#fff; font-weight:600; font-size:0.855rem; padding:10px 22px; border-radius:11px; border:none; cursor:pointer; box-shadow:0 4px 14px rgba(59,130,246,0.3); transition:opacity 0.17s; font-family:'Outfit',sans-serif;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('books.index') }}" style="font-size:0.855rem; color:#94a3b8; padding:10px 18px; border-radius:11px; text-decoration:none; border:1px solid #e2e8f0; transition:all 0.17s;" onmouseover="this.style.background='#f8fafc';this.style.color='#475569';" onmouseout="this.style.background='transparent';this.style.color='#94a3b8';">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        const imgInput  = document.getElementById('imgInput');
        const previewImg = document.getElementById('previewImg');
        const fileLabel  = document.getElementById('fileLabel');

        imgInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                previewImg.src = URL.createObjectURL(file);
                previewImg.style.display = 'block';
                fileLabel.textContent = file.name;
            }
        });
    </script>

@endsection