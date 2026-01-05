<?php


class Event {
    private ?int $id;
    private string $lieu;
    private string $status;
     private int $organisateur_id;
    private float $note_moyenne;
    private string $titre;
    private string $mignature;
    private string $date_event;

    private ?int $equipe_1_id;
    private ?int $equipe_2_id;
    public function __construct(?int $id, string $titre, string $mignature, string $date_event, string $lieu, string $status, int $organisateur_id, float $note_moyenne, ?int $equipe_1_id, ?int $equipe_2_id)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->mignature = $mignature;
        $this->date_event = $date_event;
        $this->lieu = $lieu;
        $this->status = $status;
        $this->organisateur_id = $organisateur_id;
        $this->note_moyenne = $note_moyenne;
        $this->equipe_1_id = $equipe_1_id;
        $this->equipe_2_id = $equipe_2_id;
    }
    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitre(): string
    {
        return $this->titre;
    }
    public function getMignature(): string
    {
        return $this->mignature;
    }
    public function getDateEvent(): string
    {
        return $this->date_event;
    }

    public function getLieu(): string
    {
        return $this->lieu;
    }
    public function getEquipe1Id(): int
    {
        return $this->equipe_1_id;
    }
    public function getEquipe2Id(): int
    {
        return $this->equipe_2_id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getOrganisateurId(): int
    {
        return $this->organisateur_id;
    }

    public function setOrganisateurId(int $organisateur_id): void
    {
        $this->organisateur_id = $organisateur_id;
    }

    public function getNoteMoyenne(): float
    {
        return $this->note_moyenne;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    public function setNoteMoyenne(float $note_moyenne): void
    {
        $this->note_moyenne = $note_moyenne;
    }

    public function setLieu(string $lieu): void
    {
        $this->lieu = $lieu;
    }

    public function setEquipe1Id(int $equipe_1_id): void
    {
        $this->equipe_1_id = $equipe_1_id;
    }
    public function setEquipe2Id(int $equipe_2_id): void
    {
        $this->equipe_2_id = $equipe_2_id;
    }
}