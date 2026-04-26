<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring Banjir</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg-color: #F9FAFB;
            --card-bg: #FFFFFF;
            --text-main: #111827;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --danger: #EF4444;
            --success: #10B981;
            --warning: #F59E0B;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar Navigation */
        .sidebar {
            width: 260px;
            background: #111827;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            position: fixed;
            height: 100vh;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #fff;
        }
        .sidebar h2 i { color: #60A5FA; }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            color: #9CA3AF;
            text-decoration: none;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .nav-link i { font-size: 1.25rem; width: 24px; }
        .logout-btn {
            margin-top: auto;
            background: rgba(239, 68, 68, 0.1);
            color: #FCA5A5;
        }
        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #EF4444;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 2.5rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        .header h1 {
            font-size: 2rem;
            font-weight: 700;
        }
        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover { background-color: var(--primary-hover); }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        .stat-title {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .icon-blue { background: #DBEAFE; color: #2563EB; }
        .icon-green { background: #D1FAE5; color: #059669; }
        .icon-purple { background: #EDE9FE; color: #7C3AED; }
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
        }
        .stat-list {
            list-style: none;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }
        .stat-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #F3F4F6;
            font-size: 0.95rem;
        }
        .stat-list li:last-child { border-bottom: none; }
        .stat-badge {
            background: #F3F4F6;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
        }
        .stat-action {
            display: inline-block;
            text-align: center;
            padding: 0.75rem;
            background: #F9FAFB;
            color: var(--primary);
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: background 0.3s;
            border: 1px solid var(--border-color);
        }
        .stat-action:hover { background: #F3F4F6; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); z-index: 50; }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <h2><i class="fa-solid fa-water"></i> FloodGuard</h2>
    <a href="<?= base_url('dashboard') ?>" class="nav-link active">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>
    <a href="<?= base_url('dashboard/list_data') ?>" class="nav-link">
        <i class="fa-solid fa-table"></i> Data Laporan
    </a>
    <a href="<?= base_url('dashboard/tambah_laporan') ?>" class="nav-link">
        <i class="fa-solid fa-plus-circle"></i> Tambah Laporan
    </a>
    <a href="<?= base_url('auth/logout') ?>" class="nav-link logout-btn">
        <i class="fa-solid fa-sign-out-alt"></i> Logout
    </a>
</aside>

<!-- Main Content -->
<main class="main-content">
    <div class="header">
        <h1>Overview Dashboard</h1>
        <a href="<?= base_url('dashboard/tambah_laporan') ?>" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Laporan Baru
        </a>
    </div>

    <div class="stats-grid">
        <!-- Total Laporan -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Laporan</span>
                <div class="stat-icon icon-blue"><i class="fa-solid fa-file-lines"></i></div>
            </div>
            <div class="stat-value"><?= $total ?></div>
            <div style="flex-grow: 1;"></div>
            <a href="<?= base_url('dashboard/list_data') ?>" class="stat-action">Lihat Semua Data</a>
        </div>

        <!-- Berdasarkan Lokasi -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Berdasarkan Lokasi</span>
                <div class="stat-icon icon-purple"><i class="fa-solid fa-location-dot"></i></div>
            </div>
            <ul class="stat-list">
                <?php foreach($per_lokasi as $l): ?>
                <li>
                    <span><a href="<?= base_url('dashboard/list_data/lokasi_sungai/'.urlencode($l['lokasi_sungai'])) ?>" style="text-decoration:none; color:var(--text-main); font-weight:500;"><?= $l['lokasi_sungai'] ?></a></span>
                    <span class="stat-badge"><?= $l['jumlah'] ?></span>
                </li>
                <?php endforeach; ?>
                <?php if(empty($per_lokasi)): ?>
                    <li style="color:var(--text-muted);">Belum ada data</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Berdasarkan Status -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Berdasarkan Status</span>
                <div class="stat-icon icon-green"><i class="fa-solid fa-shield-halved"></i></div>
            </div>
            <ul class="stat-list">
                <?php foreach($per_status as $s): ?>
                <li>
                    <span><a href="<?= base_url('dashboard/list_data/status_banjir/'.urlencode($s['status_banjir'])) ?>" style="text-decoration:none; color:var(--text-main); font-weight:500;"><?= $s['status_banjir'] ?></a></span>
                    <span class="stat-badge"><?= $s['jumlah'] ?></span>
                </li>
                <?php endforeach; ?>
                <?php if(empty($per_status)): ?>
                    <li style="color:var(--text-muted);">Belum ada data</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</main>

</body>
</html>