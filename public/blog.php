<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/BlogRepository.php';

$slug = (string) ($_GET['slug'] ?? '');
$repo = new BlogRepository($pdo);
$blog = $repo->getBySlug($slug);
$categories = $repo->getAllCategories();

if (!$blog) {
    http_response_code(404);
    exit('Blog not found');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($blog['short_description']) ?>">
    <title><?= e($blog['title']) ?> | Blog</title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>

<main class="container details-layout">
    <article class="detail-card">
        <img src="<?= e(image_url((string) $blog['featured_image'])) ?>" alt="<?= e($blog['title']) ?>" class="detail-image">
        <div class="meta-line">
            <span><?= e($blog['category_name']) ?></span>
            <span><?= e(format_date($blog['publish_date'])) ?></span>
        </div>
        <h1><?= e($blog['title']) ?></h1>
        <p class="lead"><?= e($blog['short_description']) ?></p>
        <div class="content"><?= nl2br(e($blog['content'])) ?></div>
    </article>

    <aside class="sidebar">
        <h3>Search & Filter</h3>
        <input type="text" id="search" placeholder="Search blogs...">
        <select id="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>"><?= e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" id="publish_date">
        <div id="suggestedBlogs" class="suggested-list"></div>
    </aside>
</main>

<?php include __DIR__ . '/../templates/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="/public/assets/js/main.js"></script>
</body>
</html>
