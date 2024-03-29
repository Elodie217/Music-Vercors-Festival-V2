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
    public function getPassById($id)
    {
        $sql = "SELECT * FROM mvf_pass WHERE Id_pass = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Pass');
        return $stmt->fetch();
    }
}

