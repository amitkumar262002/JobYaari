<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/PortalRepository.php';

$moduleType = (string) ($_GET['type'] ?? 'job');
$validTypes = ['job', 'admit_card', 'result', 'blog'];
if (!in_array($moduleType, $validTypes, true)) {
    $moduleType = 'job';
}

$repo = new PortalRepository($pdo);
$items = $repo->getItems($moduleType);
$counts = count($items);

$labels = ['job' => 'Latest Jobs', 'admit_card' => 'Admit Cards', 'result' => 'Results', 'blog' => 'Blogs'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse <?= e($labels[$moduleType]) ?> with search and filters.">
    <title><?= e($labels[$moduleType]) ?> | JobYaari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/style.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>
<?php if ($moduleType == 'blog'): ?>
    <!-- Blog Hero -->
    <section class="detail-hero" style="margin-top: 0; margin-bottom: 50px;">
        <div class="container">
            <h1 style="font-size: 48px;">Blogs</h1>
            <div class="breadcrumb">
                <a href="<?= base_url('public/index.php') ?>">Home</a> / Blogs
            </div>
        </div>
    </section>

    <div class="container">
        <div class="layout-with-sidebar">
            <div class="blog-list-container">
                <?php foreach ($items as $item): ?>
                    <div class="blog-card" style="display: flex; background: white; border-radius: 15px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: var(--transition);">
                        <div class="blog-card-img" style="flex: 0 0 350px;">
                            <img src="<?= e(image_url((string) $item['featured_image'])) ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="<?= e($item['title']) ?>">
                        </div>
                        <div class="blog-card-content" style="padding: 30px; flex: 1;">
                            <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 15px; color: #333; line-height: 1.4;"><?= e($item['title']) ?></h3>
                            <p style="font-size: 14px; color: #666; margin-bottom: 25px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                <?= e($item['short_description']) ?>
                            </p>
                            <a href="<?= base_url('public/detail.php?type=blog&slug=' . $item['slug']) ?>" class="btn" style="border-radius: 6px; padding: 10px 30px;">Read More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div style="text-align: center; margin-top: 20px;">
                    <button class="btn" style="padding: 12px 60px; border-radius: 50px;">Load More</button>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
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
                        $tags = ['10th', '12th', 'ITI', 'Polytechnic', 'Engineering', 'Arts', 'Science', 'Commerce', 'Education', 'Pharmacy', 'Paramedical', 'Management', 'Veterinary', 'Dental', 'Computer', 'Medical', 'Hotel', 'Law', 'Mass Comm'];
                        foreach($tags as $t): ?>
                            <a href="<?= base_url('public/listing.php?type=job&q=' . $t) ?>"><?= $t ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <h3>Recent Blogs</h3>
                    <?php 
                    $recent = array_slice($items, 0, 5);
                    foreach ($recent as $rb): ?>
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
    </div>

<?php else: ?>
    <!-- Original Row Layout for Jobs/Admit/Result -->
    <main class="container" style="margin-top: 40px;">
        <div class="listing-header">
            <h2 style="font-size: 24px; font-weight: 800;">Latest Updates <span style="background: #e9f0ff; color: var(--primary); padding: 4px 12px; border-radius: 50px; font-size: 14px; margin-left: 10px;"><?= $counts ?></span></h2>
            
            <div class="listing-tabs">
                <a href="<?= base_url('public/listing.php?type=result') ?>" class="tab-btn <?= $moduleType == 'result' ? 'active' : '' ?>">Results</a>
                <a href="<?= base_url('public/listing.php?type=admit_card') ?>" class="tab-btn <?= $moduleType == 'admit_card' ? 'active' : '' ?>">Admit Card</a>
                <a href="<?= base_url('public/listing.php?type=job') ?>" class="tab-btn <?= $moduleType == 'job' ? 'active' : '' ?>">Latest Job</a>
            </div>

            <div class="listing-search">
                <i class="fas fa-search" style="color: #999;"></i>
                <input type="text" placeholder="Search here...">
                <button class="search-btn" style="padding: 6px 20px; font-size: 13px;">Search</button>
            </div>
        </div>

        <div class="listing-grid">
            <?php foreach ($items as $item): ?>
                <div class="update-row-card">
                    <div class="row-left">
                        <h4><?= e($item['title']) ?></h4>
                        <span class="status-tag"><?= e(strtoupper(str_replace('_', '-', $moduleType))) ?></span>
                    </div>
                    <div class="row-right">
                        <span class="row-date"><?= e(format_date($item['publish_date'])) ?></span>
                        <a href="<?= base_url('public/detail.php?type=' . $moduleType . '&slug=' . $item['slug']) ?>" class="visit-btn">
                            Visit Now <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
<?php endif; ?>

<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
