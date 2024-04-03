<?php

namespace App\Repositories;

use App\DbConnexion\Db;
use App\Models\Pass;
use PDO;

class PassRepository
{
    private $db;

    public function __construct()
    {
        $database = new Db;
        $this->db = $database->getDB();
    }

    public function getAllPasses()
    {
        $PassesArray = [];
        $sql = "SELECT * FROM mvf_pass";
        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $PassesArray[] = new Pass($row);
        }
        return $PassesArray;
        
    }
    public function getPassById($Id_pass)
    {
        $sql = "SELECT * FROM mvf_pass WHERE Id_pass = :Id_pass";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':Id_pass', $Id_pass);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Pass');
        return $stmt->fetch();
    }

    public function getDistinctPasses()
    {
        $query = "SELECT Id_pass, Pass_pass,
                        MAX(CASE WHEN TarifReduit_pass = 0 THEN Prix_pass END) AS Prix_pass,
                        MAX(CASE WHEN TarifReduit_pass = 1 THEN Prix_pass END) AS Prix_pass_reduit
                  FROM mvf_pass
                  GROUP BY Pass_pass, Id_pass";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

public function getPassDatesByType($passType, $tarifReduit)
{
    $query = "SELECT Id_pass, Date_pass, Prix_pass 
              FROM mvf_pass 
              WHERE Pass_pass = :passType AND TarifReduit_pass = :tarifReduit";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':passType', $passType);
    $stmt->bindParam(':tarifReduit', $tarifReduit);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}