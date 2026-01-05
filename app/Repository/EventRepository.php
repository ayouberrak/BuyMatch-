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



    public function getEventsByOrganisateurId(int $organisateur): array
    {
        $stmt = $this->db->prepare("SELECT * FROM evenements WHERE organisateur_id = :organisateur_id");
        $stmt->execute([':organisateur_id' => $organisateur]);

        $events = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = new Event(
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

        return $events;
    }

}