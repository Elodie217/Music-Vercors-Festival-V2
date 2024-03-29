<?php

namespace App\Repositories;

use App\DbConnexion\Db;


class UserRepositories
{

    private $DB;

    public function __construct()
    {
        $database = new Db;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../config/database.php';
    }
}
