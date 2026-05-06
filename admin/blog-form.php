<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/PortalRepository.php';

require_admin_auth();

$repo = new PortalRepository($pdo);
$moduleType = (string) ($_GET['type'] ?? $_POST['module_type'] ?? 'blog');
$categories = $repo->getCategories($moduleType);

$isEdit = isset($_GET['id']);
$blog = [
    'module_type' => $moduleType,
    'title' => '',
    'short_description' => '',
    'content' => '',
    'category_id' => '',
    'publish_date' => date('Y-m-d'),
    'featured_image' => '',
];

if ($isEdit) {
    $existing = $repo->getItemById((int) $_GET['id']);
    if (!$existing) exit('Record not found');
    $blog = $existing;
    $moduleType = $existing['module_type'];
    $categories = $repo->getCategories($moduleType);
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf()) $errors[] = 'Invalid CSRF token.';
    $title = trim((string) ($_POST['title'] ?? ''));
    $short = trim((string) ($_POST['short_description'] ?? ''));
    $content = (string) ($_POST['content'] ?? '');
    $categoryId = (int) ($_POST['category_id'] ?? 0);
    $publishDate = (string) ($_POST['publish_date'] ?? '');
    $imageName = (string) ($blog['featured_image'] ?? '');

    if ($title === '' || mb_strlen($title) < 4) $errors[] = 'Title is too short.';
    if ($categoryId <= 0) $errors[] = 'Select a category.';

    if (!empty($_FILES['featured_image']['name'])) {
        $file = $_FILES['featured_image'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $imageName = uniqid($moduleType . '_', true) . '.' . $ext;
            move_uploaded_file($file['tmp_name'], __DIR__ . '/../public/uploads/' . $imageName);
        }
    }

    if (!$errors) {
        $payload = [
            'module_type' => $moduleType,
            'title' => $title,
            'slug' => $isEdit ? $blog['slug'] : (slugify($title) . '-' . time()),
            'short_description' => $short,
            'content' => $content,
            'category_id' => $categoryId,
            'featured_image' => $imageName,
            'publish_date' => $publishDate,
        ];
        $isEdit ? $repo->update((int) $blog['id'], $payload) : $repo->create($payload);
        redirect('admin/dashboard.php?type=' . urlencode($moduleType));
    }
}

include __DIR__ . '/partials/header.php';
?>

<div class="form-card">
    <h2 style="font-size: 18px; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        <?= $isEdit ? 'Edit Organisation' : 'Add Organisation' ?>
    </h2>

    <?php if ($errors): ?>
        <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 4px; margin-bottom: 25px;">
            <?= e(implode(' ', $errors)) ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="module_type" value="<?= e($moduleType) ?>">

        <div class="form-grid">
            <div class="left-col">
                <div class="form-group">
                    <label>Title <span class="required">*</span></label>
                    <input type="text" name="title" class="form-control" value="<?= e((string) $blog['title']) ?>" placeholder="Write Blog title" required>
                </div>

                <div class="form-group">
                    <label>Tag</label>
                    <input type="text" name="short_description" class="form-control" value="<?= e((string) $blog['short_description']) ?>" placeholder="Type and press Enter">
                </div>

                <div class="form-group">
                    <label>Upload The image <i class="fas fa-question-circle" style="color: #999; font-size: 12px;"></i></label>
                    <div class="upload-placeholder" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span id="fileName"><?= $blog['featured_image'] ?: 'Choose a file' ?></span>
                        <input type="file" name="featured_image" id="fileInput" style="display: none;" onchange="document.getElementById('fileName').innerText = this.files[0].name">
                    </div>
                </div>
            </div>

            <div class="right-col">
                <div class="form-group">
                    <label>Categories</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= (int) $cat['id'] ?>" <?= (int) $blog['category_id'] === (int) $cat['id'] ? 'selected' : '' ?>>
                                <?= e($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Publish Date</label>
                    <input type="date" name="publish_date" class="form-control" value="<?= e((string) date('Y-m-d', strtotime((string) $blog['publish_date']))) ?>">
                </div>

                <div style="margin-top: 50px;">
                    <button type="submit" class="btn-add" style="width: 100%; justify-content: center; padding: 12px;">
                        <i class="fas fa-save"></i> <?= $isEdit ? 'Update Changes' : 'Save Content' ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group" style="margin-top: 30px;">
            <label>Full Content</label>
            <textarea name="content"><?= (string) $blog['content'] ?></textarea>
        </div>
    </form>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
