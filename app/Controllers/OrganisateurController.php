<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
// require_once __DIR__ . '/../api/updateProfile.php';


// require_once __DIR__ . '/../api/addEvent.php';

class OrganisateurController
{

    public function profile()
    {
        $user = new UserRepository();
        return $user->findById($_SESSION['user_id']);

    }
    // public function UpdateProfile($name, $email, $password)
    // {
    //     $userRepo = new UserRepository();
    //     $user = $userRepo->findById($_SESSION['user_id']);
    //     if ($user) {
    //         $user->setName($name);
    //         $user->setEmail($email);
    //         if (!empty($password)) {
    //             $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    //             $user->setPassword($hashedPassword);
    //         }
    //         $userRepo->updateUser($user);
    //     }

    // }
}
// AuthMiddleware::checkRole('organisateur');
$organisateurController = new OrganisateurController();
$organisateur = $organisateurController->profile();

// $organisateurController->UpdateProfile(
//     $_POST['name'] ?? '',
//     $_POST['email'] ?? '',
//     $_POST['password'] ?? ''
// );


require_once __DIR__ . '/../Views/dashboard/organizer/dashbord.view.php';