<?php
require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';



class AuthService
{
    public function __construct(private UserRepository $repo) {}

    public function signup(array $data, string $photo): void
    {
        if ($this->repo->findByEmail($data['email'])) {
            throw new Exception("Email déjà utilisé");
        }

        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

        $user = new User(
            null,
            $data['name'],
            $data['email'],
            $passwordHash,
            $photo,
            $data['role'],
            'actif'
        );

        $this->repo->create($user);
    }

    public function login(string $email, string $password): User
    {
        $user = $this->repo->findByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new Exception("Email ou mot de passe incorrect");
        }

        if ($user->getStatus() !== 'actif') {
            throw new Exception("Compte inactif");
        }

        return $user;
    }


    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
