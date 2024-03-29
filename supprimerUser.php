<?php
session_start();

use App\DbConnexion\Db;
use App\Repositories\UserRepositories;

require_once "./App/config/database.php";
require_once "./autoload.php";


if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $idUser = (json_decode($data, true));

    $dbConnexion = new Db();
    $appartenirManager = new UserRepositories();

    if ($appartenirManager->deleteUser($idUser['userID'])) {
        echo true;
        // header(location: ...);
    } else {
        echo false;
    }
} else {
    echo 'Erreur';
}
