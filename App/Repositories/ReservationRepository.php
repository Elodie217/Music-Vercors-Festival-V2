<?php

namespace App\Repositories;

use App\DbConnexion\Db;
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

    public function getReservationById($reservationId)
    {
        $sql = "SELECT * FROM mvf_reservation WHERE Id_reservation = :reservationId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':reservationId', $reservationId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Reservation');
        return $stmt->fetch();
    }

    public function createReservation(Reservation $reservation)
    {
        $sql = "INSERT INTO mvf_reservation (Nombre_reservation, Enfants_reservation, NombreCasque_reservation, NombreLuge_reservation, PrixTotal_reservation, Id_user, Id_Pass) 
        VALUES (:Nombre_reservation, :Enfants_reservation, :NombreCasque_reservation, :NombreLuge_reservation, :PrixTotal_reservation, :Id_user, :Id_Pass)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Nombre_reservation', $reservation->getNombre_reservation());
        $stmt->bindValue(':Enfants_reservation', $reservation->getEnfants_reservation());
        $stmt->bindValue(':NombreCasque_reservation', $reservation->getNombreCasque_reservation());
        $stmt->bindValue(':NombreLuge_reservation', $reservation->getNombreLuge_reservation());
        $stmt->bindValue(':PrixTotal_reservation', $reservation->getPrixTotal_reservation());
        $stmt->bindValue(':Id_Pass', $reservation->getId_pass());
        $stmt->bindValue(':Id_user', $reservation->getId_user());
        if ($stmt->execute()) {
            $reservationId = $this->db->lastInsertId();
            $reservation->setId_reservation($reservationId);
            return true;
        }
        return false;
        }

    public function updateReservation(Reservation $reservation)
    {
        $sql = "UPDATE mvf_reservation SET Nombre_reservation = :Nombre_reservation, Enfants_reservation = :Enfants_reservation, NombreCasque_reservation = :NombreCasque_reservation, NombreLuge_reservation = :NombreLuge_reservation, PrixTotal_reservation = :PrixTotal_reservation, Id_user = :Id_user, Id_Pass = :Id_Pass WHERE Id_reservation = :Id_reservation";     
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Nombre_reservation', $reservation->getNombre_reservation());
        $stmt->bindValue(':Enfants_reservation', $reservation->getEnfants_reservation());
        $stmt->bindValue(':NombreCasque_reservation', $reservation->getNombreCasque_reservation());
        $stmt->bindValue(':NombreLuge_reservation', $reservation->getNombreLuge_reservation());
        $stmt->bindValue(':PrixTotal_reservation', $reservation->getPrixTotal_reservation());
        $stmt->bindValue(':Id_Pass', $reservation->getId_pass());
        $stmt->bindValue(':Id_user', $reservation->getId_user());
        $stmt->bindValue(':Id_reservation', $reservation->getId_reservation());
        return $stmt->execute();
    }

    public function deleteReservation($id)
    {

    /*****************************Delete nuitreservation  ****************************/
        $delNuitSql = "DELETE FROM mvf_nuitreservation WHERE Id_reservation = :id";
        $delNuitStmt = $this->db->prepare($delNuitSql);
        $delNuitStmt->bindParam(':id', $id);
        $delNuitStmt->execute();

    /*****************************Delete reservation  ****************************/
        $sql = "DELETE FROM mvf_reservation WHERE Id_reservation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getReservationsByUserId($userId)
    {
        $reservationArray = [];
        $sql = "SELECT * FROM mvf_reservation WHERE Id_user = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservationArray[] = new Reservation($row);
        }
        return $reservationArray;
    }

    /*****************************insérer les nuits dans la reservation****************************/

    public function insertNuitReservation($reservationId, $nuitId)
    {
        $query = "INSERT INTO mvf_nuitreservation (Id_reservation, Id_nuit) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$reservationId, $nuitId]);
    }

    /***************************** mettre à jour les nuits dans la reservation ****************************/

    public function updateNuitReservation($reservationId, $nuitsId)
{
    $delNuitSql = "DELETE FROM mvf_nuitreservation WHERE Id_reservation = :id";
    $delNuitStmt = $this->db->prepare($delNuitSql);
    $delNuitStmt->bindParam(':id', $reservationId);
    $delNuitStmt->execute();

    foreach ($nuitsId as $nuitId) {
        echo "Inserting nuit reservation: Reservation ID = $reservationId, Nuit ID = $nuitId<br>";
        $query = "INSERT INTO mvf_nuitreservation (Id_reservation, Id_nuit) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$reservationId, $nuitId])) {
            return false;
        }
    }
    
    return true;
}
    
    public function getNuitIdsByReservationId($reservationId)
{
    $query = "SELECT Id_nuit FROM mvf_nuitreservation WHERE Id_reservation = :reservationId";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':reservationId', $reservationId, PDO::PARAM_INT);
    $stmt->execute();

    $nuitIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $nuitIds;
}
}