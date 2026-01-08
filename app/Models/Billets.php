<?php


class Billets {
    private ?int $id;
    private int $categorie_id;

    private int $numero_place;
    private float $prix;
    private string $qrCode;

    public function __construct(?int $id, int $categorie_id, int $numero_place, float $prix, string $qrCode)
    {
        $this->id = $id;
        $this->categorie_id = $categorie_id;
        $this->numero_place = $numero_place;
        $this->prix = $prix;
        $this->qrCode = $qrCode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

public function getNumeroPlace(): int
    {
        return $this->numero_place;
    }
    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function getCategorieId(): int
    {
        return $this->categorie_id;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

}