<?php
declare(strict_types=1);

final class PortalRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getModuleCounts(): array
    {
        $stmt = $this->pdo->query("SELECT module_type, COUNT(*) total FROM content_items GROUP BY module_type");
        $rows = $stmt->fetchAll();
        $out = ['job' => 0, 'admit_card' => 0, 'result' => 0, 'blog' => 0];
        foreach ($rows as $row) {
            $out[$row['module_type']] = (int) $row['total'];
        }
        return $out;
    }

    public function getCategories(string $moduleType): array
    {
        $stmt = $this->pdo->prepare('SELECT id, name FROM categories WHERE module_type = :module_type ORDER BY name ASC');
        $stmt->execute(['module_type' => $moduleType]);
        return $stmt->fetchAll();
    }

    public function getItems(string $moduleType, array $filters = [], int $limit = 0): array
    {
        $sql = 'SELECT i.*, c.name AS category_name 
                FROM content_items i 
                INNER JOIN categories c ON c.id = i.category_id
                WHERE i.module_type = :module_type';
        $params = ['module_type' => $moduleType];

        if (!empty($filters['category_id'])) {
            $sql .= ' AND i.category_id = :category_id';
            $params['category_id'] = (int) $filters['category_id'];
        }
        if (!empty($filters['publish_date'])) {
            $sql .= ' AND i.publish_date = :publish_date';
            $params['publish_date'] = $filters['publish_date'];
        }
        if (!empty($filters['search'])) {
            $sql .= ' AND (i.title LIKE :search OR i.short_description LIKE :search OR i.content LIKE :search)';
            $params['search'] = '%' . $filters['search'] . '%';
        }

        $sql .= ' ORDER BY i.publish_date DESC, i.id DESC';
        if ($limit > 0) {
            $sql .= ' LIMIT ' . (int) $limit;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getItemBySlug(string $moduleType, string $slug): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT i.*, c.name AS category_name 
             FROM content_items i
             INNER JOIN categories c ON c.id = i.category_id
             WHERE i.module_type = :module_type AND i.slug = :slug LIMIT 1'
        );
        $stmt->execute(['module_type' => $moduleType, 'slug' => $slug]);
        $item = $stmt->fetch();
        return $item ?: null;
    }

    public function getItemById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM content_items WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();
        return $item ?: null;
    }

    public function create(array $payload): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO content_items (module_type, category_id, title, slug, short_description, content, featured_image, publish_date)
             VALUES (:module_type, :category_id, :title, :slug, :short_description, :content, :featured_image, :publish_date)'
        );
        $stmt->execute($payload);
    }

    public function update(int $id, array $payload): void
    {
        $payload['id'] = $id;
        $stmt = $this->pdo->prepare(
            'UPDATE content_items
             SET module_type = :module_type, category_id = :category_id, title = :title, slug = :slug,
                 short_description = :short_description, content = :content, featured_image = :featured_image, publish_date = :publish_date
             WHERE id = :id'
        );
        $stmt->execute($payload);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM content_items WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
