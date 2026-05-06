<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/PortalRepository.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !validate_csrf()) {
    http_response_code(400);
    exit('Invalid request.');
}

$id = (int) ($_POST['id'] ?? 0);
$moduleType = (string) ($_POST['type'] ?? 'job');
if ($id > 0) {
    $repo = new PortalRepository($pdo);
    $repo->delete($id);
}

redirect('/admin/dashboard.php?type=' . urlencode($moduleType));
