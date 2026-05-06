<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/PortalRepository.php';

$repo = new PortalRepository($pdo);

// Featured modules for the icon row - Using same text as original
$modules = [
    ['name' => 'SSC/State PCS', 'icon' => 'fa-landmark'],
    ['name' => 'Railway', 'icon' => 'fa-train'],
    ['name' => 'Teaching', 'icon' => 'fa-chalkboard-user'],
    ['name' => 'Police / Army', 'icon' => 'fa-shield-halved'],
    ['name' => 'Banking', 'icon' => 'fa-building-columns'],
    ['name' => 'Nursing', 'icon' => 'fa-user-doctor'],
];

// States for the bottom section
$states = [
    'Andaman & Nicobar', 'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 
    'Chhattisgarh', 'Dadra & Nagar Haveli', 'Daman & Diu', 'Goa', 'Gujarat', 'Haryana', 
    'Himachal Pradesh', 'Jammu & Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Ladakh', 
    'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 
    'Nagaland', 'Odisha', 'Puducherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 
    'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'
];

$allRecent = $repo->getItems('job', [], 10);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find latest government jobs, admit cards, results and blogs in one place.">
    <title>JobYaari | Find Your Dream Government Job</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/style.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- Hero Section -->
<section class="home-hero">
    <div class="container">
        <h1>Find Your Dream Government Job</h1>
        <p>Search from 10,000+ Latest Jobs, Admit Cards & Results</p>
        
        <div class="search-container">
            <input type="text" placeholder="Search jobs, exams, admit cards and results">
            <button class="search-btn">Search</button>
        </div>

        <div class="pill-nav">
            <?php foreach(['10th', '12th', 'ITI', 'Polytechnic', 'Graduate', 'Post-Graduate'] as $cat): ?>
                <a href="#"><?= $cat ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Module Icon Row -->
<div class="container" style="margin-top: -100px; position: relative; z-index: 10;">
    <div class="module-icon-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px;">
        <?php foreach($modules as $m): ?>
            <div class="card module-card">
                <div class="icon-wrap">
                    <i class="fas <?= $m['icon'] ?>"></i>
                </div>
                <h4><?= $m['name'] ?></h4>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<main class="container" style="margin-top: 80px;">
    <!-- Latest Jobtalk Section -->
    <section style="margin: 60px 0;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 36px; font-weight: 900; text-transform: uppercase;">Latest <span style="color: var(--primary);">Jobtalk</span></h2>
            <p style="color: #666; font-weight: 500;">Latest Job news and carrier guides to help you succeed</p>
        </div>
        
        <div class="jobtalk-slider" style="display: flex; gap: 25px; overflow-x: auto; padding-bottom: 20px; scrollbar-width: none;">
            <?php for($i=0; $i<4; $i++): ?>
            <div class="card" style="min-width: 350px; flex: 1; padding: 0; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                <div style="height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <img src="https://via.placeholder.com/400x250?text=Job+Thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 25px;">
                    <h3 style="font-size: 18px; font-weight: 800; margin-bottom: 12px; line-height: 1.4;">RBI Officer Grade-B Recruitment 2026 Recruitment Out</h3>
                    <p style="font-size: 14px; color: #666; margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        RBI Officer Grade-B Recruitment 2026 The Reserve Bank of India (RBI) has released a notification...
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; pt-15; margin-top: 15px; padding-top: 15px;">
                        <span style="font-weight: 700; color: #555; font-size: 13px;">Jobtalk</span>
                        <span style="color: #999; font-size: 13px;">May 05, 2026</span>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <button class="btn" style="border-radius: 50px; padding: 12px 40px;">Load More</button>
        </div>
    </section>

    <div class="layout-with-sidebar">
        <!-- Main Content -->
        <section class="blog-grid">
            <h2 style="font-size: 28px; font-weight: 800; margin-bottom: 30px; border-left: 5px solid var(--primary); padding-left: 15px;">Latest Updates</h2>
            <?php 
            $items = $allRecent; 
            $moduleType = 'job'; 
            include __DIR__ . '/../templates/item-cards.php'; 
            ?>
        </section>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="whatsapp-box" style="background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);">
                <i class="fab fa-whatsapp"></i>
                <h3 style="font-size: 22px;">WhatsApp Group</h3>
                <p>Get daily alerts and PDF notifications instantly</p>
                <a href="#" class="btn" style="background: white; color: #128c7e; margin-top: 15px; width: 100%; font-weight: 800;">Join Now</a>
            </div>

            <div class="sidebar-widget">
                <h3>Categories</h3>
                <div class="category-tags">
                    <?php 
                    $tags = ['10th', '12th', 'ITI', 'Polytechnic', 'Engineering', 'Arts', 'Science', 'Commerce', 'Education', 'Pharmacy', 'Paramedical', 'Management', 'Veterinary', 'Dental', 'Computer', 'Medical', 'Hotel', 'Law', 'Mass Comm'];
                    foreach($tags as $t): ?>
                        <a href="<?= base_url('public/listing.php?type=job&q=' . $t) ?>" class="tag"><?= $t ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>
    </div>

    <!-- States Section -->
    <section style="margin: 80px 0 40px;">
        <h2 style="text-align: center; margin-bottom: 30px; font-weight: 800; font-size: 24px;">Browse by States</h2>
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
            <?php foreach($states as $state): ?>
                <a href="#" class="state-btn" style="padding: 10px 20px;"><?= $state ?></a>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
