@extends('layouts.app')

@section('content')

  @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ title: "Berhasil!", text: "{{ session('success') }}", icon: "success", confirmButtonColor: "#3b82f6", timer: 2200, timerProgressBar: true });
        });
    </script>
    @endif
    
    <div style="min-height:75vh; display:flex; flex-direction:column; align-items:center; justify-content:center;">

        {{-- Header --}}
        <div style="margin-bottom:24px; text-align:center;">
            <h1 style="font-size:1.25rem; font-weight:700; color:#1e293b;">Edit Author</h1>
            <p style="font-size:0.8rem; color:#94a3b8; margin-top:3px;">Mengedit data {{ $edit->name_author }}</p>
        </div>

        {{-- Card Form --}}
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:18px; padding:32px; width:100%; max-width:420px; box-shadow:0 4px 24px rgba(15,23,42,0.06);">
            <form action="{{ route('penulis.update', $edit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Nama Author</label>
                    <input
                        type="text"
                        name="name_author"
                        value="{{ $edit->name_author }}"
                        required
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';"
                    />
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Umur</label>
                    <input
                        type="number"
                        name="age"
                        value="{{ $edit->age }}"
                        required
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';"
                    />
                </div>

                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:0.78rem; font-weight:600; color:#475569; margin-bottom:7px; text-transform:uppercase; letter-spacing:0.06em;">Alamat</label>
                    <input
                        type="text"
                        name="alamat"
                        value="{{ $edit->alamat }}"
                        required
                        style="width:100%; background:#f8fafc; border:1px solid #e2e8f0; color:#1e293b; border-radius:11px; padding:10px 14px; font-size:0.875rem; outline:none; transition:border 0.17s; font-family:'Outfit',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                        onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';"
                    />
                </div>

                <div style="display:flex; align-items:center; gap:10px;">
                    <button type="submit" style="background:linear-gradient(135deg,#3b82f6,#60a5fa); color:#fff; font-weight:600; font-size:0.855rem; padding:10px 22px; border-radius:11px; border:none; cursor:pointer; box-shadow:0 4px 14px rgba(59,130,246,0.3); transition:opacity 0.17s; font-family:'Outfit',sans-serif;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('penulis.index') }}" style="font-size:0.855rem; color:#94a3b8; padding:10px 18px; border-radius:11px; text-decoration:none; border:1px solid #e2e8f0; transition:all 0.17s;" onmouseover="this.style.background='#f8fafc';this.style.color='#475569';" onmouseout="this.style.background='transparent';this.style.color='#94a3b8';">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </div>

@endsection