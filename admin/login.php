<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/AuthRepository.php';

if (is_admin_logged_in()) {
    redirect('admin/dashboard.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf()) {
        $errors[] = 'Invalid CSRF token.';
    }

    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    if (!$errors) {
        $repo = new AuthRepository($pdo);
        $admin = $repo->findAdminByEmail($email);
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = (int) $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            redirect('admin/dashboard.php');
        }
        $errors[] = 'Invalid login credentials.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | JobYaari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/admin.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body.login-page {
            background: linear-gradient(135deg, #00a8e1 0%, #2c3e50 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-logo {
            background: #00a8e1;
            color: white;
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            font-size: 28px;
            font-weight: 900;
            margin: 0 auto 20px;
            display: block;
        }
        .login-card h1 {
            font-size: 24px;
            font-weight: 800;
            color: #333;
            margin-bottom: 30px;
        }
        .login-form .form-group {
            text-align: left;
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }
        .login-form .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #555;
        }
        .login-form .form-group i {
            position: absolute;
            left: 15px;
            top: 40px;
            color: #999;
            z-index: 10;
        }
        .login-form .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background: #f8f9fa;
            border: 1px solid #eee;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
        }
        .login-form .form-control:focus {
            border-color: #00a8e1;
            outline: none;
            background: white;
        }
        .login-btn {
            background: #00a8e1;
            color: white;
            border: none;
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .login-btn:hover {
            background: #0088cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,168,225,0.3);
        }
        .back-link {
            display: block;
            margin-top: 25px;
            color: #888;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .back-link:hover {
            color: #00a8e1;
        }
        .alert-box {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
            .login-card h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body class="login-page">
    <div class="login-card">
        <div class="login-logo">JY</div>
        <h1>Admin Panel Login</h1>

        <?php if ($errors): ?>
            <div class="alert-box">
                <i class="fas fa-exclamation-circle"></i> <?= e(implode(' ', $errors)) ?>
            </div>
        <?php endif; ?>

        <form method="post" class="login-form">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Email Address</label>
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="admin@jobyaari.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="login-btn">
                Sign In to Dashboard <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
            </button>
        </form>

        <a href="<?= base_url('public/index.php') ?>" class="back-link">
            <i class="fas fa-long-arrow-alt-left"></i> Back to Homepage
        </a>
    </div>
</body>
</html>
