<?php

class Commentaires {
    private ?int $id;
    private int $event_id;
    private string $user_name;
    private string $user_photo;
    private string $event_title;
    private int $user_id;
    private string $contenu;
    private int $note;
    private string $date_commentaire;

    public function __construct(?int $id, int $event_id, string $user_name, string $user_photo, string $event_title, int $user_id, string $contenu, int $note, string $date_commentaire)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->user_name = $user_name;
        $this->user_photo = $user_photo;
        $this->event_title = $event_title;
        $this->user_id = $user_id;
        $this->contenu = $contenu;
        $this->note = $note;
        $this->date_commentaire = $date_commentaire;
    }

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }
    public function getUserPhoto(): string
    {
        return $this->user_photo;
    }
    public function getEventTitle(): string
    {
        return $this->event_title;
    }
    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function getDateCommentaire(): string
    {
        return $this->date_commentaire;
    }
    public function getNote(): int
    {
        return $this->note;
    }

}

