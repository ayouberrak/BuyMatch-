<?php


require_once __DIR__ . '/../Services/EventServices.php';


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
$detailsController = new DetailsController();
$eventId = intval($_GET['id']);
$event = $detailsController->getEventDetails($eventId);




require_once __DIR__ . '/../Views/matches/deitails.php';