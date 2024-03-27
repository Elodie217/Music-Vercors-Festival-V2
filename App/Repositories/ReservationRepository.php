<?php

namespace App\Repositories;

use App\DbConnection\Db;
use App\Models\Reservation;
use PDO;

class ReservationRepository
{
    private $db;

    public function __construct()
    {
        $database = new Db;
        $this->db = $database->getDB();
    }

    public function getAllReservations()
    {
        $reservationArray = [];

        $sql = "SELECT * FROM mvf_reservation";
        $stmt = $this->db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservationArray[] = new Reservation($row);
        }

        return $reservationArray;
    }

    public function getReservationById($id)
    {
        $sql = "SELECT * FROM mvf_reservation WHERE Id_reservation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Reservation');
        return $stmt->fetch();
    }

    public function createReservation(Reservation $reservation)
    {
        $sql = "INSERT INTO mvf_reservation (Nombre_reservation, Enfants_reservation, NombreCasque_reservation, NombreLuge_reservation, PrixTotal_reservation, Id_user, Id_pass) 
                VALUES (:Nombre_reservation, :Enfants_reservation, :NombreCasque_reservation, :NombreLuge_reservation, :PrixTotal_reservation, :Id_user, :Id_pass)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Nombre_reservation', $reservation->getNombre_reservation());
        $stmt->bindValue(':Enfants_reservation', $reservation->getEnfants_reservation());
        $stmt->bindValue(':NombreCasque_reservation', $reservation->getNombreCasque_reservation());
        $stmt->bindValue(':NombreLuge_reservation', $reservation->getNombreLuge_reservation());
        $stmt->bindValue(':PrixTotal_reservation', $reservation->getPrixTotal_reservation());
        $stmt->bindValue(':Id_user', $reservation->getId_user());
        $stmt->bindValue(':Id_pass', $reservation->getId_pass());
        return $stmt->execute();
    }

    public function updateReservation(Reservation $reservation)
    {
        $sql = "UPDATE mvf_reservation SET Nombre_reservation = :Nombre_reservation, Enfants_reservation = :Enfants_reservation, NombreCasque_reservation = :NombreCasque_reservation, NombreLuge_reservation = :NombreLuge_reservation, PrixTotal_reservation = :PrixTotal_reservation, Id_user = :Id_user, Id_pass = :Id_pass WHERE Id_reservation = :Id_reservation";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Nombre_reservation', $reservation->getNombre_reservation());
        $stmt->bindValue(':Enfants_reservation', $reservation->getEnfants_reservation());
        $stmt->bindValue(':NombreCasque_reservation', $reservation->getNombreCasque_reservation());
        $stmt->bindValue(':NombreLuge_reservation', $reservation->getNombreLuge_reservation());
        $stmt->bindValue(':PrixTotal_reservation', $reservation->getPrixTotal_reservation());
        $stmt->bindValue(':Id_user', $reservation->getId_user());
        $stmt->bindValue(':Id_pass', $reservation->getId_pass());
        $stmt->bindValue(':Id_reservation', $reservation->getId_reservation());
        return $stmt->execute();
    }

    public function deleteReservation($id)
    {
        $sql = "DELETE FROM mvf_reservation WHERE Id_reservation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}