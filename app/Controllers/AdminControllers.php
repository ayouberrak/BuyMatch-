<?php

session_start();
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
require_once __DIR__ . '/../Services/UserServises.php';

class AdminControllers {

    public function getAllusers()
    {
        $userRepo = new UserServises();
        return $userRepo->getAllUser();
    }

}
$adminController = new AdminControllers();
$allUsers = $adminController->getAllusers();

class AdminEvents
{
    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }

    public function getEventStatusEnatente(){
        return $this->eventServices->getEventStatusEnatente();
    }
}


AuthMiddleware::checkRole('admin');
$adminEvents = new AdminEvents();
$eventsEnatente = $adminEvents->getEventStatusEnatente();


class AdminComments
{
    private CommentsService $commentsService;

    public function __construct()
    {
        $this->commentsService = new CommentsService();
    }

    public function getAllComments(): array
    {
        return $this->commentsService->getAllComments();
    }
}

$adminComments = new AdminComments();
$allComments = $adminComments->getAllComments();



require_once __DIR__ . '/../Views/dashboard/admin/dashbord.view.php';