<?php
declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/helpers.php';
require_once __DIR__ . '/../../app/BlogRepository.php';

header('Content-Type: application/json');

$filters = [
    'search' => trim((string) ($_GET['search'] ?? '')),
    'category_id' => (string) ($_GET['category_id'] ?? ''),
    'publish_date' => (string) ($_GET['publish_date'] ?? ''),
];

$repo = new BlogRepository($pdo);
$blogs = $repo->getBlogs($filters);

ob_start();
include __DIR__ . '/../../templates/blog-cards.php';
$html = ob_get_clean();

echo json_encode([
    'success' => true,
    'count' => count($blogs),
    'html' => $html,
]);
