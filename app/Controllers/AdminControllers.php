<?php
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

class AdminControllers {
    
    public function profile()
    {
        $user = new UserRepository();
        return $user->findById($_SESSION['user_id']);

    }

}


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



$adminEvents = new AdminEvents();
$eventsEnatente = $adminEvents->getEventStatusEnatente();




require_once __DIR__ . '/../Views/dashboard/admin/dashbord.view.php';