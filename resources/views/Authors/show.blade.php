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

    <div style="min-height:75vh; display:flex; flex-direction:column; align-items:center; justify-content:center;">

        {{-- Header --}}
        <div style="margin-bottom:24px; text-align:center;">
            <h1 style="font-size:1.25rem; font-weight:700; color:#1e293b;">Detail Author</h1>
            <p style="font-size:0.8rem; color:#94a3b8; margin-top:3px;">Informasi lengkap penulis</p>
        </div>

        {{-- Card --}}
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:18px; padding:32px; width:100%; max-width:420px; box-shadow:0 4px 24px rgba(15,23,42,0.06);">

            {{-- Avatar --}}
            <div style="display:flex; align-items:center; gap:16px; padding-bottom:20px; border-bottom:1px solid #f1f5f9; margin-bottom:20px;">
                <div style="width:52px; height:52px; background:linear-gradient(135deg,#3b82f6,#60a5fa); border-radius:14px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.3rem; font-weight:700; box-shadow:0 4px 14px rgba(59,130,246,0.25); flex-shrink:0;">
                    {{ strtoupper(substr($penulis->name_author, 0, 1)) }}
                </div>
                <div>
                    <p style="font-size:1rem; font-weight:700; color:#1e293b;">{{ $penulis->name_author }}</p>
                    <p style="font-size:0.75rem; color:#94a3b8; margin-top:2px;">Penulis</p>
                </div>
            </div>

            {{-- Detail rows --}}
            <div style="display:flex; flex-direction:column; gap:14px; margin-bottom:20px;">

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:0.8rem; color:#94a3b8;">Nama Penulis</span>
                    <span style="font-size:0.855rem; font-weight:600; color:#1e293b;">{{ $penulis->name_author }}</span>
                </div>

                <div style="height:1px; background:#f1f5f9;"></div>

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:0.8rem; color:#94a3b8;">Umur</span>
                    <span style="font-size:0.855rem; font-weight:600; color:#1e293b;">{{ $penulis->age }} tahun</span>
                </div>

                <div style="height:1px; background:#f1f5f9;"></div>

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:0.8rem; color:#94a3b8;">Alamat</span>
                    <span style="font-size:0.855rem; font-weight:600; color:#1e293b;">{{ $penulis->alamat }}</span>
                </div>

            </div>

            {{-- Back button --}}
            <div style="padding-top:16px; border-top:1px solid #f1f5f9;">
                <a href="{{ route('penulis.index') }}" style="display:inline-flex; align-items:center; gap:7px; font-size:0.82rem; font-weight:500; color:#64748b; padding:8px 14px; border-radius:10px; text-decoration:none; border:1px solid #e2e8f0; transition:all 0.17s;" onmouseover="this.style.background='#f8fafc';this.style.color='#1e293b';" onmouseout="this.style.background='transparent';this.style.color='#64748b';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

        </div>
    </div>

@endsection