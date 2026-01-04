<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Models/User.php';

class UserRepository{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute([':email' => $email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['nom'],
            $data['email'],
            $data['password'],
            $data['image_profil'],
            $data['role'],
            $data['status']
        );
    }



    public function create(User $user): bool
    {
        $sql = "INSERT INTO users (nom, email, password, image_profil, role, status)
                VALUES (:nom, :email, :password, :photo, :role, :status)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':photo' => $user->getPhoto(),
            ':role' => $user->getRole(),
            ':status' => $user->getStatus()
        ]);
    }

     public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);


        return new User(
            $data['id'],
            $data['nom'],
            $data['email'],
            $data['password'],
            $data['image_profil'],
            $data['role'],
            $data['status']
        );
    }


    public function updateUser(User $user): bool
    {
        $sql = "UPDATE users SET nom = :nom, email = :email, password = :password, image_profil = :photo, role = :role, status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':photo' => $user->getPhoto(),
            ':role' => $user->getRole(),
            ':status' => $user->getStatus(),
            ':id' => $user->getId()
        ]);
    }

    public function deleteUser(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }




}