<?php


require_once __DIR__ . '/../Repository/ReservationRepository.php';

class ReservationServices
{
    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository();
    }
    public function createReservation(Reservation $reservation): bool
    {
        return $this->reservationRepository->create($reservation);
    }
}