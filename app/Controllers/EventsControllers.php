<?php


require_once __DIR__ . '/../Services/EventServices.php';

class EventsControllers
{
    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }
    public function getAllEvents(): array
    {
        return $this->eventServices->getAllEvents();
    }
}

$eventsControllers = new EventsControllers();
$events = $eventsControllers->getAllEvents();









require_once __DIR__ . '/../Views/matches/homeMatch.view.php';