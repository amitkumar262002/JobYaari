<?php if (empty($blogs)): ?>
    <p class="empty-state">No blogs found for selected filters.</p>
<?php else: ?>
    <?php foreach ($blogs as $blog): ?>
        <article class="blog-card">
            <img src="<?= e(image_url((string) $blog['featured_image'])) ?>" alt="<?= e($blog['title']) ?>">
            <div class="blog-card-body">
                <div class="meta-line">
                    <span><?= e($blog['category_name']) ?></span>
                    <span><?= e(format_date($blog['publish_date'])) ?></span>
                </div>
                <h2><?= e($blog['title']) ?></h2>
                <p><?= e($blog['short_description']) ?></p>
                <p class="content-preview"><?= e(mb_strimwidth($blog['content'], 0, 180, '...')) ?></p>
                <a href="/blog.php?slug=<?= urlencode($blog['slug']) ?>" class="read-more">Read More</a>
            </div>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
