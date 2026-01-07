<?php


require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Repository/EquipeRepository.php';
require_once __DIR__ . '/../Models/equipe.php';


class EvnetRepository{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Event $event , Equipe $equipe1 , Equipe $equipe2): bool
    {   
        $equipeRepo = new EquipeRepository();
        $equipe1Id = $equipeRepo->create($equipe1);
        $equipe2Id = $equipeRepo->create($equipe2);

        $event->setEquipe1Id($equipe1Id);
        $event->setEquipe2Id($equipe2Id);

        $sql = "INSERT INTO evenements (titre,mignature,date_event, lieu, organisateur_id ,equipe_a_id, equipe_b_id,statut)
                VALUES (:titre, :mignature, :date_event, :lieu, :organisateur_id, :equipe1_id, :equipe2_id, :statut)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':titre' => $event->getTitre(),
            ':mignature' => $event->getMignature(),
            ':date_event' => $event->getDateEvent(),
            ':lieu' => $event->getLieu(),
            ':organisateur_id' => $event->getOrganisateurId(),
            ':equipe1_id' => $equipe1Id,
            ':equipe2_id' => $equipe2Id,
            ':statut' => $event->getStatus()
        ]);
        

    }

    public function findById(int $id): ?Event
    {
        $stmt = $this->db->prepare("SELECT * FROM evenements WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Event(
            $data['id'],
            $data['titre'],
            $data['mignature'],
            $data['date_event'],
            $data['lieu'],
            $data['statut'],
            $data['organisateur_id'],
            $data['note_moyenne'],
            $data['equipe_a_id'],
            $data['equipe_b_id']
        );
    }

    public function getAllEvents(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM evenements where statut = 'valide'");
        $stmt->execute();

        $events = [];
        $equipeRepo = new EquipeRepository();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $event = new Event(
                $data['id'],
                $data['titre'],
                $data['mignature'],
                $data['date_event'],
                $data['lieu'],
                $data['statut'],
                $data['organisateur_id'],
                $data['note_moyenne'],
                $data['equipe_a_id'],
                $data['equipe_b_id']
            );

            $equipe1 = $equipeRepo->findById($event->getEquipe1Id());
            $equipe2 = $equipeRepo->findById($event->getEquipe2Id());
            $events[] = [
                'event' => $event,
                'equipe1' => $equipe1,
                'equipe2' => $equipe2
            ];
        }

        return $events;
    }

    public function getEventsByOrganisateurId(int $organisateur): array
    {
        $stmt = $this->db->prepare("SELECT * FROM evenements WHERE organisateur_id = :organisateur_id");
        $stmt->execute([':organisateur_id' => $organisateur]);

        $events = [];
        $equipeRepo = new EquipeRepository();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $event = new Event(
                $data['id'],
                $data['titre'],
                $data['mignature'],
                $data['date_event'],
                $data['lieu'],
                $data['statut'],
                $data['organisateur_id'],
                $data['note_moyenne'],
                $data['equipe_a_id'],
                $data['equipe_b_id']
            );

            $equipe1 = $equipeRepo->findById($event->getEquipe1Id());
            $equipe2 = $equipeRepo->findById($event->getEquipe2Id());

            $events[] = [
                'event' => $event,
                'equipe1' => $equipe1,
                'equipe2' => $equipe2
            ];

            
        }

        return $events;
    }


    public function getEventStatusEnatente(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM evenements WHERE statut = 'en_attente'");
        $stmt->execute();

        $events = [];
        $equipeRepo = new EquipeRepository();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $event = new Event(
                $data['id'],
                $data['titre'],
                $data['mignature'],
                $data['date_event'],
                $data['lieu'],
                $data['statut'],
                $data['organisateur_id'],
                $data['note_moyenne'],
                $data['equipe_a_id'],
                $data['equipe_b_id']
            );

            $equipe1 = $equipeRepo->findById($event->getEquipe1Id());
            $equipe2 = $equipeRepo->findById($event->getEquipe2Id());

            $events[] = [
                'event' => $event,
                'equipe1' => $equipe1,
                'equipe2' => $equipe2
            ];
        }

        return $events;
    }

    public function updateEventStatus(int $eventId, string $newStatus): bool
    {
        $stmt = $this->db->prepare("UPDATE evenements SET statut = :statut WHERE id = :id");
        return $stmt->execute([
            ':statut' => $newStatus,
            ':id' => $eventId
        ]);
    }

    public function getEventsById(int $eventId)
    {
        $stmt = $this->db->prepare("SELECT * FROM evenements WHERE id = :id");
        $stmt->execute([':id' => $eventId]);


        $events = [];
        $equipeRepo = new EquipeRepository();


        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $event = new Event(
                $data['id'],
                $data['titre'],
                $data['mignature'],
                $data['date_event'],
                $data['lieu'],
                $data['statut'],
                $data['organisateur_id'],
                $data['note_moyenne'],
                $data['equipe_a_id'],
                $data['equipe_b_id']
            );

            $equipe1 = $equipeRepo->findById($event->getEquipe1Id());
            $equipe2 = $equipeRepo->findById($event->getEquipe2Id());
            $events[] = [
                'event' => $event,
                'equipe1' => $equipe1,
                'equipe2' => $equipe2
            ];

        return $events;
    }

}
}