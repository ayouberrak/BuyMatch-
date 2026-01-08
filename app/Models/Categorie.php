<?php



class Categorie {
    private ?int $id;
    private string $nom;
    private int $place_debut;
    private int $price;
    private int $place_fin;

    public function __construct(?int $id, string $nom, int $place_debut, int $place_fin, int $price)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->place_debut = $place_debut;
        $this->place_fin = $place_fin;
        $this->price = $price;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function getPlaceDebut(): int
    {
        return $this->place_debut;
    }
    public function getPlaceFin(): int
    {
        return $this->place_fin;
    }
    public function getPrice(): int
    {
        return $this->price;
    }
}