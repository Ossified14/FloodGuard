<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan - Monitoring Banjir</title>
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
            margin-bottom: 2.5rem;
        }
        .header h1 { font-size: 2rem; font-weight: 700; }
        .header p { color: var(--text-muted); margin-top: 0.5rem; }

        .form-card {
            background: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            padding: 2rem;
            max-width: 800px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            font-size: 0.95rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #F9FAFB;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        textarea.form-control { resize: vertical; min-height: 120px; }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em; }
        
        .file-upload-wrapper {
            position: relative;
            border: 2px dashed var(--border-color);
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            background: #F9FAFB;
            transition: border-color 0.3s;
            cursor: pointer;
        }
        .file-upload-wrapper:hover { border-color: var(--primary); }
        .file-upload-wrapper i { font-size: 2.5rem; color: #9CA3AF; margin-bottom: 1rem; }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0; cursor: pointer;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: var(--primary);
            color: white;
            flex: 1;
        }
        .btn-primary:hover { background-color: var(--primary-hover); }
        .btn-secondary {
            background-color: white;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-secondary:hover { background-color: #F3F4F6; }

        .img-preview {
            margin-top: 10px;
            max-width: 200px;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; width: 100%; padding: 1.5rem; }
            .form-actions { flex-direction: column; }
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
        <h1>Edit Laporan</h1>
        <p>Silakan ubah data laporan di bawah ini.</p>
    </div>

    <div class="form-card">
        <?php if(isset($error)) echo "<div style='color:red; margin-bottom:1rem;'>$error</div>"; ?>
        
        <form action="<?= base_url('dashboard/update_laporan') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $laporan['id'] ?>">

            <div class="form-group">
                <label for="lokasi_sungai">Lokasi Sungai</label>
                <input type="text" name="lokasi_sungai" id="lokasi_sungai" class="form-control" value="<?= $laporan['lokasi_sungai'] ?>" required>
            </div>

            <div class="form-group">
                <label for="tinggi_air">Tinggi Air (cm)</label>
                <input type="number" name="tinggi_air" id="tinggi_air" class="form-control" value="<?= $laporan['tinggi_air'] ?>" required>
            </div>

            <div class="form-group">
                <label for="status_banjir">Status Banjir</label>
                <select name="status_banjir" id="status_banjir" class="form-control" required>
                    <option value="Aman" <?= strtolower($laporan['status_banjir']) == 'aman' ? 'selected' : '' ?>>Aman</option>
                    <option value="Waspada" <?= strtolower($laporan['status_banjir']) == 'waspada' ? 'selected' : '' ?>>Waspada</option>
                    <option value="Siaga" <?= strtolower($laporan['status_banjir']) == 'siaga' ? 'selected' : '' ?>>Siaga</option>
                    <option value="Bahaya" <?= strtolower($laporan['status_banjir']) == 'bahaya' ? 'selected' : '' ?>>Bahaya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Kondisi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= $laporan['deskripsi'] ?></textarea>
            </div>

            <div class="form-group">
                <label>Foto Bukti</label>
                <div class="file-upload-wrapper">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p style="color:var(--text-muted); font-weight:500;">Klik atau seret gambar baru ke sini untuk mengganti foto lama</p>
                    <p style="color:#9CA3AF; font-size:0.875rem; margin-top:0.5rem;">Biarkan kosong jika tidak ingin mengganti foto. Format didukung: JPG, PNG, GIF</p>
                    <input type="file" name="foto_bukti" accept="image/*">
                </div>
                <?php if($laporan['foto_bukti']): ?>
                    <p style="margin-top: 10px; font-size: 0.875rem; color: var(--text-muted);">Foto saat ini:</p>
                    <img src="<?= base_url('uploads/'.$laporan['foto_bukti']) ?>" alt="Foto Bukti" class="img-preview">
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('dashboard/list_data') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save" style="margin-right:0.5rem;"></i> Simpan Perubahan</button>
            </div>

        </form>
    </div>
</main>

</body>
</html>
