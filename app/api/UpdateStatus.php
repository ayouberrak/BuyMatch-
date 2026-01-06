<?php


require_once __DIR__ . '/../Services/UserServises.php';

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

class UpdateStatus {

    private UserServises $userServises;

    public function __construct()
    {
        $this->userServises = new UserServises();
    }

    public function updateUserStatus(int $userId): bool
    {
        return $this->userServises->Updatestatus($userId);
    }
    
}

$updateStatus = new UpdateStatus();
$updateStatus->updateUserStatus($input['userId']);
// echo json_encode(['status' => 'success']);