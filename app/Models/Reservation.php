<?php

class Reservation {
    private ?int $id;
    private int $event_id;
    private int $user_id;
    private int $category_id;
    private string $nbr_place;
    private float $price;
    private string $date_reservation;


    public function __construct(?int $id, int $event_id, int $user_id, string $date_reservation,int $category_id, string $nbr_place, float $price)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->user_id = $user_id;
        $this->date_reservation = $date_reservation;
        $this->category_id = $category_id;
        $this->nbr_place = $nbr_place;
        $this->price = $price;
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

    public function getCategoryId(): int
    {
        return $this->category_id;
    }
    public function getNbrPlace(): string
    {
        return $this->nbr_place;
    }
    public function getPrice(): float
    {
        return $this->price;
    }

}