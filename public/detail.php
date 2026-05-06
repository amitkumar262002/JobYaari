<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/PortalRepository.php';

$moduleType = (string) ($_GET['type'] ?? 'job');
$slug = (string) ($_GET['slug'] ?? '');
$validTypes = ['job', 'admit_card', 'result', 'blog'];
if (!in_array($moduleType, $validTypes, true)) {
    $moduleType = 'job';
}

$repo = new PortalRepository($pdo);
$item = $repo->getItemBySlug($moduleType, $slug);
if (!$item) {
    http_response_code(404);
    exit('Record not found');
}

$categories = $repo->getCategories($moduleType);
$recentBlogs = $repo->getItems('blog', [], 5);
$moduleCounts = $repo->getModuleCounts();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($item['short_description']) ?>">
    <title><?= e($item['title']) ?> | JobYaari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/style.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- Breadcrumb Hero -->
<section class="detail-hero">
    <div class="container">
        <h1><?= e($item['title']) ?></h1>
        <div class="breadcrumb">
            <a href="<?= base_url('public/index.php') ?>">Home</a> / 
            <a href="<?= base_url('public/listing.php?type=' . $moduleType) ?>"><?= e(ucfirst($moduleType)) ?></a>
        </div>
    </div>
</section>

<main class="container">
    <div class="layout-with-sidebar">
        <!-- Main Content -->
        <article class="detail-card">
            <img src="<?= e(image_url((string) $item['featured_image'])) ?>" style="width: 100%; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" alt="<?= e($item['title']) ?>">
            
            <div style="font-size: 14px; color: #999; margin-bottom: 15px;">
                <i class="far fa-calendar"></i> <?= e(format_date($item['publish_date'])) ?>
            </div>

            <h2 style="font-size: 28px; font-weight: 800; color: #333; margin-bottom: 20px; line-height: 1.3;"><?= e($item['title']) ?></h2>
            
            <div class="detail-content html-content">
                <p style="font-size: 17px; line-height: 1.8; color: #444; margin-bottom: 25px;">
                    <?= e($item['short_description']) ?>
                </p>
                
                <!-- Internal WhatsApp Widget (Optional, matches original) -->
                <div style="background: #e9f9ee; border: 1px solid #25d366; border-radius: 12px; padding: 20px; text-align: center; margin: 30px 0;">
                    <img src="<?= asset('public/assets/img/whatsapp-banner.png') ?>" alt="WhatsApp" style="max-width: 100%; height: auto; margin-bottom: 15px;">
                    <p style="font-weight: 700; color: #128c7e; margin-bottom: 10px;">Get Daily Alerts on WhatsApp</p>
                    <a href="#" class="btn" style="background: #25d366; color: white; border-radius: 50px;">Join Now</a>
                </div>

                <?= $item['content'] ?>
            </div>

            <!-- Social Share -->
            <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 10px;">
                    <a href="https://www.facebook.com/jobyaari/" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: #1877f2; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/jobyaari/" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/@jobyaari" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: #ff0000; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- WhatsApp Sidebar Box -->
            <div class="sidebar-widget" style="background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); color: white; text-align: center;">
                <i class="fab fa-whatsapp" style="font-size: 50px; margin-bottom: 15px;"></i>
                <h3 style="color: white; border: none; margin-bottom: 5px;">WhatsApp Group</h3>
                <p style="font-size: 14px; opacity: 0.9; margin-bottom: 20px;">Get daily alerts and PDF notifications instantly</p>
                <a href="#" class="btn" style="background: white; color: #128c7e; width: 100%; border-radius: 50px; font-weight: 800;">Follow</a>
            </div>

            <div class="sidebar-widget">
                <h3>Categories</h3>
                <div class="tag-grid">
                    <?php 
                    $tags = ['10th', '12th', 'ITI', 'Polytechnic', 'Engineering', 'Arts', 'Science', 'Commerce', 'Education', 'Pharmacy', 'Paramedical', 'Management', 'Veterinary', 'Dental', 'Computer', 'Medical', 'Hotel', 'Law', 'Mass Comm', 'Agriculture', 'Design', 'Architecture', 'Any Degree'];
                    foreach($tags as $t): ?>
                        <a href="<?= base_url('public/listing.php?type=job&q=' . $t) ?>"><?= $t ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="sidebar-widget">
                <h3>Blogs Categories</h3>
                <ul class="category-list">
                    <li><a href="<?= base_url('public/listing.php?type=admit_card') ?>"><i class="fas fa-chevron-right"></i> Admit Card</a> <span>(<?= $moduleCounts['admit_card'] ?? 0 ?>)</span></li>
                    <li><a href="<?= base_url('public/listing.php?type=result') ?>"><i class="fas fa-chevron-right"></i> Result</a> <span>(<?= $moduleCounts['result'] ?? 0 ?>)</span></li>
                    <li><a href="<?= base_url('public/listing.php?type=job') ?>"><i class="fas fa-chevron-right"></i> Jobs</a> <span>(<?= $moduleCounts['job'] ?? 0 ?>)</span></li>
                    <li><a href="<?= base_url('public/listing.php?type=blog') ?>"><i class="fas fa-chevron-right"></i> Blogs</a> <span>(<?= $moduleCounts['blog'] ?? 0 ?>)</span></li>
                </ul>
            </div>

            <div class="sidebar-widget">
                <h3>Recent Blogs</h3>
                <?php foreach ($recentBlogs as $rb): ?>
                    <a href="<?= base_url('public/detail.php?type=blog&slug=' . $rb['slug']) ?>" class="recent-post-item">
                        <img src="<?= e(image_url((string) $rb['featured_image'])) ?>" alt="">
                        <div class="post-info">
                            <h4><?= e($rb['title']) ?></h4>
                            <span><?= e(format_date($rb['publish_date'])) ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>
    </div>
</main>

<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
