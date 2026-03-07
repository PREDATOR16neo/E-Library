@extends('layouts.app')

@section('content')

    <div style="max-width:900px; margin:0 auto;">

        {{-- Breadcrumb --}}
        <div style="margin-bottom:20px; font-size:0.78rem; color:#94a3b8; display:flex; align-items:center; gap:8px;">
            <a href="{{ route('home') }}" style="color:#94a3b8; text-decoration:none; transition:color 0.15s;" onmouseover="this.style.color='#475569'" onmouseout="this.style.color='#94a3b8'">Home</a>
            <span style="color:#cbd5e1;">/</span>
            <a href="{{ route('books.index') }}" style="color:#94a3b8; text-decoration:none; transition:color 0.15s;" onmouseover="this.style.color='#475569'" onmouseout="this.style.color='#94a3b8'">Books</a>
            <span style="color:#cbd5e1;">/</span>
            <span style="color:#475569; font-weight:600;">{{ $detail->judul }}</span>
        </div>

        {{-- Main Card --}}
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:20px; overflow:hidden; box-shadow:0 4px 24px rgba(15,23,42,0.06);">
            <div style="display:flex; flex-wrap:wrap;">

                {{-- Left: Cover --}}
                <div style="width:100%; max-width:340px; background:#f8fafc; padding:32px; display:flex; align-items:center; justify-content:center; border-right:1px solid #f1f5f9;">
                    <div style="position:relative; width:100%;">
                        <img
                            src="{{ asset('storage/'.$detail->image) }}"
                            alt="Sampul Buku"
                            style="width:100%; height:auto; border-radius:14px; box-shadow:0 8px 32px rgba(15,23,42,0.12); border:1px solid #e2e8f0;"
                        >
                        <span style="position:absolute; top:12px; right:12px; background:rgba(59,130,246,0.92); color:#fff; font-size:0.68rem; font-weight:600; padding:4px 12px; border-radius:99px; backdrop-filter:blur(4px);">
                            {{ $detail->genre->name_genres }}
                        </span>
                    </div>
                </div>

                {{-- Right: Details --}}
                <div style="flex:1; min-width:280px; padding:32px; display:flex; flex-direction:column;">

                    {{-- Title & Author --}}
                    <div style="margin-bottom:18px;">
                        <h1 style="font-size:1.5rem; font-weight:700; color:#1e293b; line-height:1.3; font-family:'Lora',serif;">{{ $detail->judul }}</h1>
                        <p style="font-size:0.82rem; color:#94a3b8; margin-top:6px;">
                            by <span style="color:#3b82f6; font-weight:600;">{{ $detail->author->name_author }}</span>
                        </p>
                    </div>

                    {{-- Badges --}}
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:22px;">
                        <span style="background:#f1f5f9; border:1px solid #e2e8f0; color:#475569; font-size:0.75rem; font-weight:600; padding:4px 12px; border-radius:8px;">
                            {{ $detail->tahun_terbit }}
                        </span>
                        <span style="color:#cbd5e1;">•</span>
                        <span style="font-size:0.75rem; color:#94a3b8;">Umur {{ $detail->author->age }} tahun</span>
                    </div>

                    {{-- Synopsis --}}
                    <div style="margin-bottom:22px;">
                        <h2 style="font-size:0.68rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:8px;">Sinopsis</h2>
                        <p style="font-size:0.875rem; color:#475569; line-height:1.7;">{{ $detail->sinopsis }}</p>
                    </div>

                    {{-- Author Info --}}
                    <div style="border-top:1px solid #f1f5f9; padding-top:20px; margin-bottom:24px;">
                        <h2 style="font-size:0.68rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:12px;">Tentang Penulis</h2>
                        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:16px;">
                            <p style="font-size:0.875rem; font-weight:600; color:#1e293b; margin-bottom:6px;">
                                {{ $detail->author->name_author }}
                                <span style="color:#94a3b8; font-weight:400;">({{ $detail->author->age }} tahun)</span>
                            </p>
                            <p style="font-size:0.82rem; color:#64748b;">
                                <span style="color:#94a3b8; display:inline-block; width:60px;">Alamat:</span>
                                {{ $detail->author->alamat }}
                            </p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div style="display:flex; gap:10px; margin-top:auto;">
                        <a href="https://youtu.be/Aq5WXmQQooo?si=oJFJKOBhi7cl8hDO" style="flex:1; background:linear-gradient(135deg,#3b82f6,#60a5fa); color:#fff; font-weight:600; font-size:0.855rem; padding:11px 16px; border-radius:12px; text-align:center; text-decoration:none; box-shadow:0 4px 14px rgba(59,130,246,0.3); transition:opacity 0.17s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            Pinjam Buku
                        </a>
                        <a href="{{ route('home') }}" style="flex:1; background:#f8fafc; border:1px solid #e2e8f0; color:#475569; font-weight:600; font-size:0.855rem; padding:11px 16px; border-radius:12px; text-align:center; text-decoration:none; transition:all 0.17s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection