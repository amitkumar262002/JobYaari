<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/PortalRepository.php';

require_admin_auth();

$moduleType = (string) ($_GET['type'] ?? 'blog');
$validTypes = ['job', 'admit_card', 'result', 'blog'];
if (!in_array($moduleType, $validTypes, true)) {
    $moduleType = 'blog';
}

$repo = new PortalRepository($pdo);
$items = $repo->getItems($moduleType);
$labels = ['job' => 'Jobs', 'admit_card' => 'Admit Card', 'result' => 'Result', 'blog' => 'Blog'];

include __DIR__ . '/partials/header.php';
?>

<div class="admin-actions-bar">
    <div style="display: flex; gap: 10px;">
        <a href="<?= base_url('admin/blog-create.php?type=') . e($moduleType) ?>" class="btn-add">
            <i class="fas fa-plus"></i> Add Blogs
        </a>
        <a href="#" class="btn-export">
            <i class="fas fa-file-export"></i> Export
        </a>
    </div>
    <div class="search-box">
        <input type="text" placeholder="Start typing to search" class="form-control" style="width: 250px; padding: 7px 15px;">
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th width="30"><input type="checkbox"></th>
                <th width="50">View</th>
                <th width="80">Blog ID</th>
                <th>Blog Title</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Image</th>
                <th width="100">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><a href="<?= base_url('public/detail.php?type=' . $moduleType . '&slug=' . $item['slug']) ?>" target="_blank" style="color: #555;"><i class="fas fa-eye"></i></a></td>
                    <td><?= (int) $item['id'] ?></td>
                    <td style="font-weight: 500; color: #333;"><?= e($item['title']) ?></td>
                    <td style="color: #999; font-size: 12px;"><?= e($item['slug']) ?></td>
                    <td><?= e($item['category_name']) ?></td>
                    <td><img src="<?= e(image_url((string) $item['featured_image'])) ?>" class="thumb" alt=""></td>
                    <td class="action-btns">
                        <a href="<?= base_url('admin/blog-edit.php?id=') . (int) $item['id'] ?>"><i class="fas fa-edit"></i></a>
                        <form method="post" action="<?= base_url('admin/blog-delete.php') ?>" onsubmit="return confirm('Delete this record?')" style="display: inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                            <input type="hidden" name="type" value="<?= e($moduleType) ?>">
                            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer; color: #555;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($items)): ?>
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px;">No records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #666;">
    <span>Show 10 entries</span>
    <div class="pagination" style="display: flex; gap: 5px;">
        <button class="btn-export" style="padding: 5px 10px;">Previous</button>
        <button class="btn-add" style="padding: 5px 10px;">1</button>
        <button class="btn-export" style="padding: 5px 10px;">Next</button>
    </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
