<?php

session_start();
require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Repository/EventRepository.php';
require_once __DIR__ . '/../Models/Equipe.php';
require_once __DIR__ . '/../Models/Organisateur.php';
require_once __DIR__ . '/../Services/EventServices.php';

class EventController {

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


// require_once __DIR__ . '/../Views/dashboard/organizer/dashbord.view.php';
