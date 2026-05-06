<?php require_once __DIR__ . '/../../app/helpers.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | JobYaari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/admin.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/yo7gtqtlmf20liim424jg4dxr327bwkfr5y39fsxwcqno7bw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea[name="content"]',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table emoticons help',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | table emoticons | code preview fullscreen',
        height: 400,
        menubar: false,
      });
    </script>
</head>
<body class="admin-body">
    <aside class="admin-sidebar">
        <div class="sidebar-top-cyan">
            <div class="brand-box">
                <span class="brand-text">Jobs Yaari</span>
                <span class="brand-subtext"><i class="fas fa-circle" style="color: #4cd137; font-size: 8px;"></i> Seo</span>
            </div>
            <div class="brand-logo-small">
                <img src="<?= asset('public/assets/img/logo-sq.png') ?>" alt="Y">
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="<?= base_url('admin/dashboard.php') ?>" class="<?= !isset($_GET['type']) || $_GET['type'] == 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-newspaper"></i> Headlines
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-video"></i> Help Videos
                </a>
            </li>
            <li class="has-submenu">
                <a href="javascript:void(0)" id="manageBlogToggle">
                    <i class="fas fa-dollar-sign"></i> Manage Blog <i class="fas fa-chevron-down sub-arrow"></i>
                </a>
                <ul class="submenu" id="blogSubmenu" style="display: block;">
                    <li><a href="<?= base_url('admin/dashboard.php?type=blog') ?>" class="<?= ($_GET['type'] ?? '') == 'blog' ? 'active' : '' ?>">Blog</a></li>
                    <li><a href="<?= base_url('admin/dashboard.php?type=job') ?>" class="<?= ($_GET['type'] ?? '') == 'job' ? 'active' : '' ?>">Jobs</a></li>
                    <li><a href="<?= base_url('admin/dashboard.php?type=admit_card') ?>" class="<?= ($_GET['type'] ?? '') == 'admit_card' ? 'active' : '' ?>">Admit Card</a></li>
                    <li><a href="<?= base_url('admin/dashboard.php?type=result') ?>" class="<?= ($_GET['type'] ?? '') == 'result' ? 'active' : '' ?>">Result</a></li>
                </ul>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="<?= base_url('admin/logout.php') ?>"><i class="fas fa-chevron-left"></i> Logout</a>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <i class="fas fa-bars" id="sidebarToggle"></i>
                <span class="breadcrumb-text">Manage Blogs <span class="sub-sep">Home > Blog > Manage Blogs</span></span>
            </div>
            <div class="topbar-right">
                <div class="topbar-item dropdown">
                    <i class="fas fa-th" id="gridMenuToggle"></i>
                    <div class="dropdown-menu" id="gridMenu">
                        <div class="dropdown-header">Quick Links</div>
                        <a href="<?= base_url('public/index.php') ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Visit Site</a>
                        <a href="<?= base_url('admin/blog-create.php?type=blog') ?>"><i class="fas fa-plus"></i> New Blog</a>
                        <a href="<?= base_url('admin/blog-create.php?type=job') ?>"><i class="fas fa-briefcase"></i> New Job</a>
                    </div>
                </div>
                <div class="topbar-item">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </div>
                <div class="topbar-item dropdown">
                    <div class="profile-pill" id="profileMenuToggle">
                        <i class="fas fa-user-circle"></i>
                        <span>Admin</span>
                        <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
                    </div>
                    <div class="dropdown-menu" id="profileMenu">
                        <div class="dropdown-header">Account Settings</div>
                        <a href="#"><i class="fas fa-user"></i> My Profile</a>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                        <hr>
                        <a href="<?= base_url('admin/logout.php') ?>" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
                <a href="<?= base_url('admin/logout.php') ?>" class="topbar-item"><i class="fas fa-power-off"></i></a>
            </div>
        </header>
        <main class="admin-content">
