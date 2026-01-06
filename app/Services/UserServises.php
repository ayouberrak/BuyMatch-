<?php



require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Repository/UserRepository.php';


class UserServises {

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAllUser(): array
    {
        return $this->userRepository->getAllUsers();
    }


    public function Updatestatus(int $userId): bool
    {
        return $this->userRepository->Updatestatus($userId);
    }
    
}