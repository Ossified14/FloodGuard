<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Monitoring Banjir</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg-color: #F3F4F6;
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-main: #111827;
            --text-muted: #6B7280;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }
        .auth-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .auth-card h2 {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            color: var(--text-main);
        }
        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #D1D5DB;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 0.5rem;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
        .auth-links {
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        .auth-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        .auth-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="auth-card">
    <h2>Buat Akun Baru</h2>
    
    <form action="<?= base_url('auth/proses_register') ?>" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username Baru" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" name="sandi" class="form-control" placeholder="Sandi" required>
        </div>
        <button type="submit" class="btn-primary">Daftar</button>
    </form>
    
    <div class="auth-links">
        Sudah punya akun? <a href="<?= base_url('auth') ?>">Login Disini</a>
    </div>
</div>

</body>
</html>

