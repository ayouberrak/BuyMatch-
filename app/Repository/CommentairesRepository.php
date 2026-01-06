<?php

require_once __DIR__ . '/../Models/Commentaires.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Repository/EventRepository.php';
require_once __DIR__ . '/../Repository/EquipeRepository.php';
require_once __DIR__ . '/../Repository/UserRepository.php';


class CommentairesRepository{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Commentaires $commentaire): int
    {
        $sql = "INSERT INTO commentaires (event_id, user_id, contenu, note) VALUES (:event_id, :user_id, :contenu, :note)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':event_id' => $commentaire->getEventId(),
            ':user_id' => $commentaire->getUserId(),
            ':contenu' => $commentaire->getContenu(),
            ':note' => $commentaire->getNote(),
        ]);

        return (int)$this->db->lastInsertId();
    }
    public function findById(int $id): ?Commentaires
    {
        $stmt = $this->db->prepare("SELECT * FROM commentaires WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Commentaires(

            $data['id'],
            $data['event_id'],
            $data['nom'],
            $data['image_profil'],
            $data['titre'],
            $data['user_id'],
            $data['contenu'],
            $data['note'],
            $data['date_commentaire']
        );
    }

    public function getCommentsByOrganisateurId(int $organisateurId): array
    {
        $stmt = $this->db->prepare(
            "SELECT c.*, e.*, u.* FROM commentaires c
             JOIN evenements e ON c.event_id = e.id
             INNER JOIN users u ON c.user_id = u.id
             WHERE e.organisateur_id = :organisateur_id"
        );
        $stmt->execute([':organisateur_id' => $organisateurId]);

        $comments = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Commentaires(

                $data['id'],
                $data['event_id'],
                $data['nom'],
                $data['image_profil'],
                $data['titre'],
                $data['user_id'],
                $data['contenu'],
                $data['note'],
                $data['date_commentaire']
            );
        }

        return $comments;
    }

    public function getAllComments(): array
    {
        $stmt = $this->db->prepare("SELECT c.*, e.*, u.* FROM commentaires c
                                    JOIN evenements e ON c.event_id = e.id
                                    INNER JOIN users u ON c.user_id = u.id");
        $stmt->execute();

        $comments = [];
        $tousComments = [];
        $event = new EvnetRepository(); 
        $equipe = new EquipeRepository();
        $user = new UserRepository();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tousComments[] = new Commentaires(
                $data['id'],
                $data['event_id'],
                $data['nom'],
                $data['image_profil'],
                $data['titre'],
                $data['user_id'],
                $data['contenu'],
                $data['note'],
                $data['date_commentaire']
            );

            $eventDetails = $event->findById($data['event_id']);
            $equipeA = $equipe->findById($eventDetails->getEquipe1Id());
            $equipeB = $equipe->findById($eventDetails->getEquipe2Id());
            $userDetails = $user->findById($data['user_id']);

            $comments[] = [
                'id' => $data['id'],
                'match' => $equipeA->getNom() . " vs " . $equipeB->getNom(),
                'user' => $userDetails,
                'contenu' => $data['contenu'],
                'note' => $data['note'],
                'date_commentaire' => $data['date_commentaire']
            ];
        }

        return $comments;
    }

    public function deleteCommentById(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM commentaires WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}