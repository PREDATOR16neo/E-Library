@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* ══ LIGHT ══ */
    :root {
        --dash-text:    #1e293b;
        --dash-sub:     #94a3b8;
        --card-bg:      #ffffff;
        --card-br:      #e2e8f0;
        --card-shadow:  rgba(15,23,42,0.06);
        --badge-bg:     #f8fafc;
        --badge-br:     #e2e8f0;
        --badge-text:   #94a3b8;
        --chart-grid:   #f1f5f9;
        --chart-tick:   #94a3b8;
        --chart-label:  #64748b;
        --legend-text:  #64748b;
        --legend-val:   #1e293b;
    }
    html.dark {
        --dash-text:    #f1f5f9;
        --dash-sub:     #64748b;
        --card-bg:      #1e293b;
        --card-br:      #334155;
        --card-shadow:  rgba(0,0,0,0.2);
        --badge-bg:     #0f172a;
        --badge-br:     #334155;
        --badge-text:   #64748b;
        --chart-grid:   #334155;
        --chart-tick:   #64748b;
        --chart-label:  #94a3b8;
        --legend-text:  #94a3b8;
        --legend-val:   #f1f5f9;
    }

    .dash-title { font-family:'Lora',serif; font-size:1.3rem; font-weight:700; color:var(--dash-text); transition:color 0.3s; }
    .dash-sub   { font-size:0.78rem; color:var(--dash-sub); margin-top:3px; transition:color 0.3s; }
    .dash-badge {
        font-size:0.72rem; color:var(--badge-text);
        background:var(--badge-bg); border:1px solid var(--badge-br);
        padding:5px 12px; border-radius:99px;
        transition:all 0.3s;
    }

    /* Stat cards */
    .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:28px; }
    .stat-card {
        background:var(--card-bg);
        border:1px solid var(--card-br);
        border-radius:16px; padding:22px;
        position:relative; overflow:hidden;
        box-shadow:0 2px 12px var(--card-shadow);
        transition:transform 0.2s, box-shadow 0.2s, background 0.3s, border-color 0.3s;
    }
    .stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 28px var(--card-shadow); }
    .stat-card::after {
        content:''; position:absolute; bottom:-20px; right:-20px;
        width:90px; height:90px; border-radius:50%; opacity:0.07;
    }
    .card-blue::after   { background:#3b82f6; }
    .card-green::after  { background:#10b981; }
    .card-purple::after { background:#8b5cf6; }

    .stat-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:14px; }
    .stat-icon svg { width:20px; height:20px; stroke:currentColor; fill:none; }
    .card-blue   .stat-icon { background:#eff6ff; color:#3b82f6; }
    .card-green  .stat-icon { background:#ecfdf5; color:#10b981; }
    .card-purple .stat-icon { background:#f5f3ff; color:#8b5cf6; }
    html.dark .card-blue   .stat-icon { background:rgba(59,130,246,0.15); color:#60a5fa; }
    html.dark .card-green  .stat-icon { background:rgba(16,185,129,0.15); color:#34d399; }
    html.dark .card-purple .stat-icon { background:rgba(139,92,246,0.15); color:#a78bfa; }

    .stat-label { font-size:0.68rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--dash-sub); font-weight:600; transition:color 0.3s; }
    .stat-value { font-family:'Lora',serif; font-size:2.2rem; font-weight:700; color:var(--dash-text); line-height:1; margin:8px 0 4px; transition:color 0.3s; }
    .stat-desc  { font-size:0.72rem; color:var(--dash-sub); transition:color 0.3s; }

    /* Chart */
    .chart-grid  { display:grid; grid-template-columns:2fr 1fr; gap:18px; }
    .chart-card  {
        background:var(--card-bg); border:1px solid var(--card-br);
        border-radius:16px; padding:22px;
        box-shadow:0 2px 12px var(--card-shadow);
        transition:background 0.3s, border-color 0.3s;
    }
    .chart-title { font-size:0.875rem; font-weight:700; color:var(--dash-text); margin-bottom:4px; transition:color 0.3s; }
    .chart-sub   { font-size:0.72rem; color:var(--dash-sub); margin-bottom:18px; transition:color 0.3s; }

    .legend-row {
        display:flex; align-items:center; justify-content:space-between;
        padding:6px 0; border-bottom:1px solid var(--card-br);
        transition:border-color 0.3s;
    }
    .legend-row:last-child { border-bottom:none; }
    .legend-dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; }
    .legend-label { font-size:0.78rem; color:var(--legend-text); transition:color 0.3s; }
    .legend-val   { font-size:0.78rem; font-weight:700; color:var(--legend-val); transition:color 0.3s; }
</style>

{{-- Header --}}
<div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:24px;">
    <div>
        <p class="dash-title">Dashboard</p>
        <p class="dash-sub">Ringkasan data perpustakaan digital</p>
    </div>
    <span class="dash-badge">Data dari database</span>
</div>

{{-- Stat Cards --}}
<div class="stats-grid">
    <div class="stat-card card-blue">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
            </svg>
        </div>
        <p class="stat-label">Total Buku</p>
        <p class="stat-value">{{ $totalBuku }}</p>
        <p class="stat-desc">Koleksi buku terdaftar</p>
    </div>
    <div class="stat-card card-green">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </div>
        <p class="stat-label">Total Genre</p>
        <p class="stat-value">{{ $totalGenre }}</p>
        <p class="stat-desc">Kategori genre tersedia</p>
    </div>
    <div class="stat-card card-purple">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <p class="stat-label">Total Author</p>
        <p class="stat-value">{{ $totalPenulis }}</p>
        <p class="stat-desc">Penulis terdaftar</p>
    </div>
</div>

{{-- Charts --}}
<div class="chart-grid">
    <div class="chart-card">
        <p class="chart-title">Ringkasan Data</p>
        <p class="chart-sub">Perbandingan jumlah buku, genre, dan author</p>
        <canvas id="barChart" height="110"></canvas>
    </div>
    <div class="chart-card">
        <p class="chart-title">Proporsi Data</p>
        <p class="chart-sub">Distribusi koleksi perpustakaan</p>
        <canvas id="doughnutChart" height="180"></canvas>
        <div style="margin-top:16px; display:flex; flex-direction:column; gap:0;">
            <div class="legend-row">
                <div style="display:flex;align-items:center;gap:8px;">
                    <span class="legend-dot" style="background:#3b82f6;"></span>
                    <span class="legend-label">Buku</span>
                </div>
                <span class="legend-val">{{ $totalBuku }}</span>
            </div>
            <div class="legend-row">
                <div style="display:flex;align-items:center;gap:8px;">
                    <span class="legend-dot" style="background:#10b981;"></span>
                    <span class="legend-label">Genre</span>
                </div>
                <span class="legend-val">{{ $totalGenre }}</span>
            </div>
            <div class="legend-row">
                <div style="display:flex;align-items:center;gap:8px;">
                    <span class="legend-dot" style="background:#8b5cf6;"></span>
                    <span class="legend-label">Author</span>
                </div>
                <span class="legend-val">{{ $totalPenulis }}</span>
            </div>
        </div>
    </div>
</div>

<script>
    const totalBuku    = {{ $totalBuku }};
    const totalGenre   = {{ $totalGenre }};
    const totalPenulis = {{ $totalPenulis }};
    const isDark = () => document.getElementById('htmlRoot').classList.contains('dark');

    function getChartColors() {
        return {
            grid:  isDark() ? '#334155' : '#f1f5f9',
            tick:  isDark() ? '#64748b' : '#94a3b8',
            label: isDark() ? '#94a3b8' : '#64748b',
        };
    }

    // ── Bar Chart ──
    const barCtx = document.getElementById('barChart');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Total Buku', 'Total Genre', 'Total Author'],
            datasets: [{
                label: 'Jumlah',
                data: [totalBuku, totalGenre, totalPenulis],
                backgroundColor: [
                    'rgba(59,130,246,0.18)',
                    'rgba(16,185,129,0.18)',
                    'rgba(139,92,246,0.18)'
                ],
                borderColor: ['#3b82f6','#10b981','#8b5cf6'],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => ' ' + ctx.parsed.y + ' data' } }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize:1, font:{family:'Outfit',size:11}, color: getChartColors().tick },
                    grid: { color: getChartColors().grid },
                    border: { display: false }
                },
                x: {
                    ticks: { font:{family:'Outfit',size:11}, color: getChartColors().label },
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });

    // ── Doughnut Chart ──
    const doughnutChart = new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Buku', 'Genre', 'Author'],
            datasets: [{
                data: [totalBuku, totalGenre, totalPenulis],
                backgroundColor: ['#3b82f6','#10b981','#8b5cf6'],
                borderColor: isDark() ? '#1e293b' : '#ffffff',
                borderWidth: 3,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => ' ' + ctx.label + ': ' + ctx.parsed } }
            }
        }
    });

    // ── Update chart colors on theme toggle ──
    const originalToggle = window.toggleTheme;
    window.toggleTheme = function() {
        if (originalToggle) originalToggle();
        setTimeout(() => {
            const c = getChartColors();
            barChart.options.scales.y.ticks.color = c.tick;
            barChart.options.scales.y.grid.color  = c.grid;
            barChart.options.scales.x.ticks.color = c.label;
            barChart.data.datasets[0].borderColor = isDark() ? '#1e293b' : '#ffffff';
            barChart.update();
            doughnutChart.data.datasets[0].borderColor = isDark() ? '#1e293b' : '#ffffff';
            doughnutChart.update();
        }, 50);
    };
</script>

@endsection