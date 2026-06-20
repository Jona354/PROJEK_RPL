@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="dashboard-content">
    
    <header class="top-bar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass text-muted"></i>
            <input type="text" placeholder="Cari data inventaris...">
        </div>
        <button class="btn btn-primary-custom"><i class="fa-solid fa-plus me-2"></i> Barang Baru</button>
    </header>

    <div class="welcome-banner">
        <div class="banner-text">
            <h3><i class="fa-solid fa-shield-halved me-2"></i> SIGURESTO Estate</h3>
            <p>Sistem Informasi Gudang dan Manajemen Restoran Terintegrasi</p>
        </div>
        <div class="banner-stats">
            <div class="b-stat-item">
                <span class="b-label"><i class="fa-solid fa-boxes-stacked"></i> Total Ragam</span>
                <span class="b-val">{{ $totalBarang }} Item</span>
            </div>
            <div class="b-stat-item">
                <span class="b-label"><i class="fa-solid fa-building-user"></i> Mitra</span>
                <span class="b-val">{{ $jumlahSupplier }} Supplier</span>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        
        <div class="card shadow-card grid-col-8">
            <div class="card-header-custom">
                <h5><i class="fa-solid fa-chart-column text-primary me-2"></i> Alur Distribusi & Stok</h5>
                <span class="text-muted small">Update Realtime</span>
            </div>
            
            <div class="pipeline-sub-grid">
                <div class="sub-pipe-item">
                    <span class="pipe-num text-success">{{ $totalBarang }}</span>
                    <span class="pipe-label">Total Barang</span>
                </div>
                <div class="sub-pipe-item">
                    <span class="pipe-num text-warning">7</span>
                    <span class="pipe-label">Stok Minimum</span>
                </div>
                <div class="sub-pipe-item">
                    <span class="pipe-num text-danger">{{ $barangKadaluarsa }}</span>
                    <span class="pipe-label">Kadaluarsa</span>
                </div>
                <div class="sub-pipe-item">
                    <span class="pipe-num text-primary">{{ $jumlahSupplier }}</span>
                    <span class="pipe-label">Supplier Aktif</span>
                </div>
            </div>

            <div class="chart-container-layout">
                <div class="chart-summary">
                    <span class="big-counter">{{ $totalBarang + $jumlahSupplier }}</span>
                    <span class="text-muted small"><i class="fa-solid fa-circle-check text-success"></i> Entitas Terkelola</span>
                </div>
                <div class="chart-wrapper-canvas">
                    <canvas id="stokChart" height="140"></canvas>
                </div>
            </div>
        </div>

        <div class="card shadow-card grid-col-4">
            <div class="card-header-custom">
                <h5><i class="fa-solid fa-bell text-danger me-2"></i> Perhatian Khusus</h5>
            </div>
            <div class="alert-list">
                <div class="alert-item high-priority">
                    <div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="alert-details">
                        <h6>Stok Menipis Detect</h6>
                        <p>Terdapat 7 komoditas menyentuh batas minimum.</p>
                        <span class="badge bg-light-danger text-danger">Segera Restock</span>
                    </div>
                </div>
                <div class="alert-item warning-priority">
                    <div class="alert-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div class="alert-details">
                        <h6>Produk Kadaluarsa</h6>
                        <p>Sistem mendeteksi {{ $barangKadaluarsa }} item expired.</p>
                        <span class="badge bg-light-warning text-warning">Butuh Tindakan</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    :root {
        --bg-body: #f4f6f9;
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --primary-color: #3b82f6;
        --gradient-banner: linear-gradient(135deg, #0f4c81 0%, #2563eb 100%);
    }

    * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

    /* Container utama dibuat fleksibel mengikuti sisa space dari sidebar bawaan app.blade */
    .dashboard-content { 
        padding: 10px 20px;
        background: var(--bg-body);
        width: 100%;
    }

    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .search-box { background: white; padding: 10px 20px; border-radius: 14px; display: flex; align-items: center; gap: 12px; width: 350px; border: 1px solid #e2e8f0; }
    .search-box input { border: none; outline: none; width: 100%; font-size: 0.9rem; }
    .btn-primary-custom { background: var(--primary-color); color: white; border: none; padding: 10px 24px; border-radius: 14px; font-weight: 600; transition: opacity 0.2s; }
    .btn-primary-custom:hover { opacity: 0.9; color: white; }

    /* Welcome Banner */
    .welcome-banner { background: var(--gradient-banner); border-radius: 20px; padding: 28px; color: white; display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15); }
    .banner-text h3 { font-weight: 700; margin-bottom: 6px; font-size: 1.6rem; letter-spacing: -0.5px; }
    .banner-text p { margin-bottom: 0; opacity: 0.85; font-size: 0.95rem; }
    .banner-stats { display: flex; gap: 24px; background: rgba(255, 255, 255, 0.1); padding: 14px 24px; border-radius: 16px; backdrop-filter: blur(4px); }
    .b-stat-item { display: flex; flex-direction: column; }
    .b-label { font-size: 0.75rem; opacity: 0.75; margin-bottom: 2px; }
    .b-val { font-size: 1.1rem; font-weight: 700; }

    /* Layout Grid Component */
    .dashboard-grid { display: flex; gap: 28px; align-items: flex-start; flex-wrap: wrap; }
    .grid-col-8 { flex: 2; min-width: 350px; }
    .grid-col-4 { flex: 1; min-width: 280px; }
    .card { background: var(--card-bg); border-radius: 20px; border: none; padding: 24px; }
    .shadow-card { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.01); }
    .card-header-custom { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .card-header-custom h5 { font-weight: 700; color: var(--text-main); margin-bottom: 0; font-size: 1.1rem; }

    /* Pipeline Mini Sub Cards */
    .pipeline-sub-grid { display: flex; gap: 14px; margin-bottom: 28px; flex-wrap: wrap; }
    .sub-pipe-item { flex: 1; min-width: 120px; background: #f8fafc; border: 1px solid #f1f5f9; padding: 14px; border-radius: 12px; display: flex; flex-direction: column; }
    .pipe-num { font-size: 1.4rem; font-weight: 700; line-height: 1.2; margin-bottom: 4px; }
    .pipe-label { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; }

    /* Chart Area Split Layout */
    .chart-container-layout { display: flex; gap: 24px; align-items: center; flex-wrap: wrap; }
    .chart-summary { width: 120px; display: flex; flex-direction: column; border-right: 1px dashed #e2e8f0; padding-right: 16px; }
    @media (max-width: 768px) {
        .chart-summary { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 16px; width: 100%; }
    }
    .big-counter { font-size: 2.5rem; font-weight: 800; color: var(--text-main); letter-spacing: -1px; line-height: 1; margin-bottom: 6px; }
    .chart-wrapper-canvas { flex: 1; min-width: 250px; }

    /* Alert List Right Column */
    .alert-list { display: flex; flex-direction: column; gap: 16px; }
    .alert-item { display: flex; gap: 14px; padding: 16px; border-radius: 14px; background: #f8fafc; border-left: 4px solid #cbd5e1; }
    .alert-item.high-priority { border-left-color: #ef4444; background: #fef2f2; }
    .alert-item.warning-priority { border-left-color: #f59e0b; background: #fffbeb; }
    .alert-icon { font-size: 1.2rem; margin-top: 2px; }
    .alert-item.high-priority .alert-icon { color: #ef4444; }
    .alert-item.warning-priority .alert-icon { color: #f59e0b; }
    .alert-details h6 { margin: 0 0 4px 0; font-weight: 600; font-size: 0.95rem; color: var(--text-main); }
    .alert-details p { margin: 0 0 8px 0; font-size: 0.85rem; color: var(--text-muted); line-height: 1.4; }
    .badge { padding: 4px 10px; font-size: 0.75rem; border-radius: 6px; font-weight: 600; display: inline-block; }
    .bg-light-danger { background: #fee2e2; }
    .bg-light-warning { background: #fef3c7; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('stokChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
            datasets: [{
                label: 'Pergerakan Barang',
                data: [18, 24, 12, 35, 20, 28, 15],
                backgroundColor: '#3b82f6',
                borderRadius: 6,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' }, border: { dash: [5, 5] } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
@endsection