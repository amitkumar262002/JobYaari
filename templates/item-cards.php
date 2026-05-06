<?php if (empty($items)): ?>
    <div class="card" style="text-align: center; padding: 40px; width: 100%;">
        <p>No records found for selected filters.</p>
    </div>
<?php endif; ?>

<?php foreach ($items as $item): ?>
    <article class="blog-card">
        <img src="<?= e(image_url((string) $item['featured_image'])) ?>" class="card-img" alt="<?= e($item['title']) ?>">
        <div class="card-body">
            <div>
                <span class="card-category"><?= e($item['category_name']) ?></span>
                <h3 class="card-title">
                    <a href="<?= base_url('public/detail.php?type=' . $moduleType . '&slug=' . $item['slug']) ?>">
                        <?= e($item['title']) ?>
                    </a>
                </h3>
                <p class="card-text"><?= e($item['short_description']) ?></p>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 13px; color: var(--gray-600);"><i class="far fa-calendar"></i> <?= e(format_date($item['publish_date'])) ?></span>
                <a href="<?= base_url('public/detail.php?type=' . $moduleType . '&slug=' . $item['slug']) ?>" class="btn" style="padding: 6px 15px; font-size: 14px;">
                    Read More
                </a>
            </div>
        </div>
    </article>
<?php endforeach; ?>
