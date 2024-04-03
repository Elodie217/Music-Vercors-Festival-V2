<?php

namespace App\Repositories;

use App\DbConnexion\Db;
use App\Models\Nuit;
use PDO;

class NuitRepository
{
    private $db;

    public function __construct()
    {
        $database = new Db;
        $this->db = $database->getDB();
    }

    public function getAllNuits()
    {
        $NuitsArray = [];
        $sql = "SELECT * FROM mvf_nuit";
        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $NuitsArray[] = new Nuit($row);
        }

        return $NuitsArray;
    }

    public function getNuitById($id)
    {
        $sql = "SELECT * FROM mvf_nuit WHERE Id_nuit = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Nuit');
        return $stmt->fetch();
    }
    public function getNuitByIdReservation($idReservation)
    {

        $sql = "SELECT * FROM mvf_nuit WHERE mvf_nuit.Id_nuit IN (
        SELECT mvf_nuitreservation.Id_nuit FROM mvf_nuitreservation WHERE mvf_nuitreservation.Id_reservation = :id)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id', $idReservation);

        $statement->execute();

        $retour = $statement->fetchAll(PDO::FETCH_CLASS, Nuit::class);

        return $retour;
    }

    public function updateNuitReservation($reservationId, $nuitsId)
    {
        $delNuitSql = "DELETE FROM mvf_nuitreservation WHERE Id_reservation = :id";
        $delNuitStmt = $this->db->prepare($delNuitSql);
        $delNuitStmt->bindParam(':id', $reservationId);
        $delNuitStmt->execute();


        foreach ($nuitsId as $nuitID) {
            $query = "INSERT INTO mvf_nuitreservation (Id_reservation, Id_nuit) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            if ($stmt->execute([$reservationId, $nuitID])) {
            } else {
                return false;
            };
        }
        return true;
    }
}