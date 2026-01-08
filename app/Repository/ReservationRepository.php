<?php

require_once __DIR__ . '/../Models/Reservation.php';
require_once __DIR__ . '/../../config/database.php';


class ReservationRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create(Reservation $reservation): bool
    {
        $sql = "INSERT INTO reservations (event_id, user_id, date_reservation, categorie_id, nbr_chaise, total_prix)
                VALUES (:event_id, :user_id, :date_reservation, :categorie_id, :nbr_chaise, :total_prix)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':event_id' => $reservation->getEventId(),
            ':user_id' => $reservation->getUserId(),
            ':date_reservation' => $reservation->getDateReservation(),
            ':categorie_id' => $reservation->getCategoryId(),
            ':nbr_chaise' => $reservation->getNbrPlace(),
            ':total_prix' => $reservation->getPrice()
        ]);
    }


}