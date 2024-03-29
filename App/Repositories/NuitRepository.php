<?php

namespace App\Repositories;

use App\DbConnection\Db;
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
}