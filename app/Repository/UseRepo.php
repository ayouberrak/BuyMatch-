<?php

namespace App\Repository;
use App\Config\Database;
use App\Models\User;
use PDO;


class UserRepository
{
    public function findByEmail(string $email): ?User
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        return $this->mapToUser($data);
    }

    public function create(User $user): bool
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("
            INSERT INTO users (nom, email, password, role, status)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $user->nom,
            $user->email,
            $user->password,
            $user->role,
            $user->status
        ]);
    }

    private function mapToUser(array $data): User
    {
        $user = new User();
        $user->id = $data['id'];
        $user->nom = $data['nom'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->role = $data['role'];
        $user->status = $data['status'];
        return $user;
    }

    
}
