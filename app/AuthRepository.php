<?php
declare(strict_types=1);

final class AuthRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAdminByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, name, email, password FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();
        return $admin ?: null;
    }
}
