<?php

use App\Config\Database;

require_once __DIR__ . '/../../config/database.php';

class User
{
    private PDO $db;
    private $name;
    private $email;
    private $password;
    private $photo;
    private $role;
    private $status;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPhoto()
    {
        return $this->photo;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function sigupnUp()
    {
       $sql = "INSERT INTO users (nom, email, password, image_profil, role, status)
        VALUES (:name, :email, :password, :photo, :role, :status)";
        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':photo', $this->photo);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}