<?php
require_once __DIR__ . '/../Models/equipe.php';
require_once __DIR__ . '/../../config/database.php';

class EquipeRepository {
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Equipe $equipe): int
    {
        $sql = "INSERT INTO equipes (nom, logo) VALUES (:nom, :logo)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $equipe->getNom(),
            ':logo' => $equipe->getLogo(),
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function findById(int $id): ?Equipe
    {
        $stmt = $this->db->prepare("SELECT * FROM equipes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Equipe(
            $data['id'],
            $data['nom'],
            $data['logo']
        );
    }
}
