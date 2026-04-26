<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan - Monitoring Banjir</title>
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
        .logout-btn:hover { background: rgba(239, 68, 68, 0.2); color: #EF4444; }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 2.5rem;
            width: calc(100% - 260px);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        .header h1 { font-size: 2rem; font-weight: 700; }
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

        /* Table Container */
        .table-container {
            background: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }
        .table-wrapper { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        thead { background-color: #F9FAFB; border-bottom: 1px solid var(--border-color); }
        th {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background-color: #F9FAFB; }

        /* Badges */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-block;
        }
        .badge-aman { background-color: #D1FAE5; color: #065F46; }
        .badge-waspada { background-color: #FEF3C7; color: #92400E; }
        .badge-siaga { background-color: #FFEDD5; color: #9A3412; }
        .badge-bahaya { background-color: #FEE2E2; color: #991B1B; }

        .img-preview {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: transform 0.2s;
        }
        .img-preview:hover { transform: scale(1.1); }
        
        .btn-action {
            padding: 0.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            margin-right: 0.25rem;
            color: white;
            transition: opacity 0.2s;
        }
        .btn-action:hover { opacity: 0.8; }
        .btn-edit { background-color: #3B82F6; }
        .btn-delete { background-color: #EF4444; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; width: 100%; padding: 1.5rem; }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <h2><i class="fa-solid fa-water"></i> FloodGuard</h2>
    <a href="<?= base_url('dashboard') ?>" class="nav-link">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>
    <a href="<?= base_url('dashboard/list_data') ?>" class="nav-link active">
        <i class="fa-solid fa-table"></i> Data Laporan
    </a>
    <a href="<?= base_url('dashboard/tambah_laporan') ?>" class="nav-link">
        <i class="fa-solid fa-plus-circle"></i> Tambah Laporan
    </a>
    <a href="<?= base_url('auth/logout') ?>" class="nav-link logout-btn">
        <i class="fa-solid fa-sign-out-alt"></i> Logout
    </a>
</aside>

<main class="main-content">
    <div class="header">
        <h1>Data Laporan Banjir</h1>
        <a href="<?= base_url('dashboard/tambah_laporan') ?>" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Laporan Baru
        </a>
    </div>

    <div class="table-container">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Lokasi Sungai</th>
                        <th>Tinggi Air (cm)</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($laporan)): ?>
                        <?php $no = 1; foreach($laporan as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d M Y H:i', strtotime($row['waktu_pengukuran'])) ?></td>
                            <td style="font-weight:500;"><?= $row['lokasi_sungai'] ?></td>
                            <td><?= $row['tinggi_air'] ?> cm</td>
                            <td>
                                <?php 
                                    $status = strtolower($row['status_banjir']);
                                    $badge_class = 'badge-aman'; // default
                                    if(strpos($status, 'bahaya') !== false) $badge_class = 'badge-bahaya';
                                    elseif(strpos($status, 'siaga') !== false) $badge_class = 'badge-siaga';
                                    elseif(strpos($status, 'waspada') !== false) $badge_class = 'badge-waspada';
                                ?>
                                <span class="badge <?= $badge_class ?>"><?= $row['status_banjir'] ?></span>
                            </td>
                            <td><?= $row['deskripsi'] ?></td>
                            <td>
                                <?php if($row['foto_bukti']): ?>
                                    <a href="<?= base_url('uploads/'.$row['foto_bukti']) ?>" target="_blank">
                                        <img src="<?= base_url('uploads/'.$row['foto_bukti']) ?>" alt="Foto Bukti" class="img-preview">
                                    </a>
                                <?php else: ?>
                                    <span style="color:var(--text-muted); font-size:0.875rem;">Tidak ada foto</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('dashboard/edit_laporan/'.$row['id']) ?>" class="btn-action btn-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="<?= base_url('dashboard/hapus_laporan/'.$row['id']) ?>" class="btn-action btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus laporan ini?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align:center; padding: 3rem; color: var(--text-muted);">
                                <i class="fa-solid fa-folder-open" style="font-size:3rem; margin-bottom:1rem; color:#D1D5DB;"></i><br>
                                Belum ada data laporan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>
