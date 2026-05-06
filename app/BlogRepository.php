<?php
declare(strict_types=1);

final class BlogRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getAllCategories(): array
    {
        $stmt = $this->pdo->query('SELECT id, name FROM categories ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    public function getBlogs(array $filters = []): array
    {
        $sql = 'SELECT b.*, c.name AS category_name FROM blogs b INNER JOIN categories c ON c.id = b.category_id WHERE 1=1';
        $params = [];

        if (!empty($filters['category_id'])) {
            $sql .= ' AND b.category_id = :category_id';
            $params['category_id'] = (int) $filters['category_id'];
        }

        if (!empty($filters['publish_date'])) {
            $sql .= ' AND DATE(b.publish_date) = :publish_date';
            $params['publish_date'] = $filters['publish_date'];
        }

        if (!empty($filters['search'])) {
            $sql .= ' AND (b.title LIKE :search OR b.short_description LIKE :search OR b.content LIKE :search)';
            $params['search'] = '%' . $filters['search'] . '%';
        }

        $sql .= ' ORDER BY b.publish_date DESC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare('SELECT b.*, c.name AS category_name FROM blogs b INNER JOIN categories c ON c.id = b.category_id WHERE b.slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $blog = $stmt->fetch();
        return $blog ?: null;
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM blogs WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $blog = $stmt->fetch();
        return $blog ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO blogs (title, slug, short_description, content, category_id, featured_image, publish_date)
             VALUES (:title, :slug, :short_description, :content, :category_id, :featured_image, :publish_date)'
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $stmt = $this->pdo->prepare(
            'UPDATE blogs
             SET title = :title, slug = :slug, short_description = :short_description, content = :content,
                 category_id = :category_id, featured_image = :featured_image, publish_date = :publish_date
             WHERE id = :id'
        );
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM blogs WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
