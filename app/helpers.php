<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Returns the base URL of the project, auto-detecting subdirectory.
 * Works whether the app is at "/" or "/jobyaari/" etc.
 */
function base_url(string $path = ''): string
{
    static $base = null;
    if ($base === null) {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
        $dir = dirname($scriptName);

        // Remove trailing /public or /admin folder from the detected base
        $dir = (string) preg_replace('#/(public|admin)(/.*)?$#', '', $dir);

        // Normalize: root becomes empty string
        $base = rtrim($dir === DIRECTORY_SEPARATOR ? '' : $dir, '/');
    }

    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return base_url($path);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): void
{
    // $path should be like 'admin/login.php' or 'public/index.php'
    // Strip leading slash if passed
    $path = ltrim($path, '/');
    header('Location: ' . base_url($path));
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function validate_csrf(): bool
{
    return isset($_POST['csrf_token'], $_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], (string) $_POST['csrf_token']);
}

function is_admin_logged_in(): bool
{
    return !empty($_SESSION['admin_id']);
}

function require_admin_auth(): void
{
    if (!is_admin_logged_in()) {
        redirect('admin/login.php');
    }
}

function format_date(string $date): string
{
    return date('d M Y', strtotime($date));
}

function slugify(string $value): string
{
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';
    return trim($value, '-');
}

function image_url(string $fileName): string
{
    if ($fileName !== '') {
        $filePath = __DIR__ . '/../public/uploads/' . $fileName;
        if (file_exists($filePath)) {
            return asset('public/uploads/' . rawurlencode($fileName));
        }
    }
    return 'https://via.placeholder.com/900x500?text=No+Image';
}
