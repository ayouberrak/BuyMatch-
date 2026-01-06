<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Repository/EventRepository.php';
require_once __DIR__ . '/../Models/equipe.php';
require_once __DIR__ . '/../Models/Organisateur.php';
require_once __DIR__ . '/../Services/EventServices.php';
require_once __DIR__ . '/../Services/CommentsService.php';
require_once __DIR__ . '/../Repository/CommentairesRepository.php';

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
AuthMiddleware::checkRole('organisateur');
$organisateurController = new OrganisateurController();
$organisateur = $organisateurController->profile();

// $organisateurController->UpdateProfile(
//     $_POST['name'] ?? '',
//     $_POST['email'] ?? '',
//     $_POST['password'] ?? ''
// );

class GetEventsByOrganisateur
{
    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }

    public function getEventsByOrganisateur(int $organisateurId): array
    {
        return $this->eventServices->getEventsByOrganisateur($organisateurId);
    }
}

$getEventsByOrganisateur = new GetEventsByOrganisateur(); 
$events = $getEventsByOrganisateur->getEventsByOrganisateur($_SESSION['user_id']); 


class GetCommentsByOrganisateur
{
    private CommentsService $commentsService;

    public function __construct()
    {
        $this->commentsService = new CommentsService();
    }

    public function getCommentsByOrganisateur(int $organisateurId): array
    {
        return $this->commentsService->getCommentsByOrganisateur($organisateurId);
    }
}

$getCommentsByOrganisateur = new GetCommentsByOrganisateur();
$comments = $getCommentsByOrganisateur->getCommentsByOrganisateur($_SESSION['user_id']);


class LogoutController
{
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: homePageControllers.php");
        exit();
    }
}

$logoutController = new LogoutController();
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $logoutController->logout();
}

require_once __DIR__ . '/../Views/dashboard/organizer/dashbord.view.php';