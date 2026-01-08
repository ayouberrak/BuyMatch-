<?php



require_once __DIR__ . '/../Models/Categorie.php';
require_once __DIR__ . '/../../config/database.php';


class CategorieRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllCategories(): array
    {
        $categories = [];
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            $categorie = new Categorie(
                $row['id'],
                $row['nom_categorie'],
                $row['place_fin'],
                $row['place_debut'],
                $row['prix']
            );
            $categories[] = $categorie;
        }

        return $categories;
    }
}