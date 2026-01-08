<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Services/EventServices.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';


class DetailsController
{
    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }

    public function getEventDetails(int $eventId): array
    {
        return $this->eventServices->getEventById($eventId);
    }
}

if(AuthMiddleware::checkRole('acheteur')){
    header("Location: LoginController.php");
    exit();

}

$detailsController = new DetailsController();
$eventId = $_GET['id'];
$event = $detailsController->getEventDetails($eventId);

$eventDetails = $event['event'];
$equipe1Data = $event['equipe1'];
$equipe2Data = $event['equipe2'];

// print_r($event);
// print_r($equipe1Data);
// print_r($equipe2Data);
// echo $eventId;


require_once __DIR__ . '/CategorieControllers.php';


require_once __DIR__ . '/../Views/matches/deitails.php';