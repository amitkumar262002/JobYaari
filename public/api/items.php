<?php
declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/helpers.php';
require_once __DIR__ . '/../../app/PortalRepository.php';

header('Content-Type: application/json');

$moduleType = (string) ($_GET['module_type'] ?? 'job');
$validTypes = ['job', 'admit_card', 'result', 'blog'];
if (!in_array($moduleType, $validTypes, true)) {
    $moduleType = 'job';
}

$filters = [
    'search' => trim((string) ($_GET['search'] ?? '')),
    'category_id' => (string) ($_GET['category_id'] ?? ''),
    'publish_date' => (string) ($_GET['publish_date'] ?? ''),
];

$repo = new PortalRepository($pdo);
$items = $repo->getItems($moduleType, $filters);

ob_start();
include __DIR__ . '/../../templates/item-cards.php';
$html = ob_get_clean();

echo json_encode(['success' => true, 'html' => $html, 'count' => count($items)]);
