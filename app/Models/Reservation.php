<?php

class Reservation {
    private ?int $id;
    private int $event_id;
    private int $user_id;
    private string $date_reservation;
    private int $nombre_tickets;

    public function __construct(?int $id, int $event_id, int $user_id, string $date_reservation, int $nombre_tickets)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->user_id = $user_id;
        $this->date_reservation = $date_reservation;
        $this->nombre_tickets = $nombre_tickets;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getDateReservation(): string
    {
        return $this->date_reservation;
    }

    public function getNombreTickets(): int
    {
        return $this->nombre_tickets;
    }
}