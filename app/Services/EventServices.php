<?php

require_once __DIR__ . '/../Repository/EventRepository.php';
require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/equipe.php';
require_once __DIR__ . '/../Repository/EquipeRepository.php';
require_once __DIR__ . '/../Models/Organisateur.php';

class EventServices {
    private EvnetRepository $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EvnetRepository();
    }

    public function createEvent(Organisateur $organisateur, Event $event, Equipe $equipe1, Equipe $equipe2): bool
    {
        if (!$organisateur->createEvent()) {
            throw new Exception("L'organisateur n'a pas les droits pour creer un événement.");
        }

        $event->setOrganisateurId($organisateur->getId()); 
        return $this->eventRepository->create($event, $equipe1, $equipe2);
    }

    public function getEventsByOrganisateur(int $organisateurId): array
    {
        return $this->eventRepository->getEventsByOrganisateurId($organisateurId);
    }


    public function getEventStatusEnatente(){
        return $this->eventRepository->getEventStatusEnatente();
    }
}