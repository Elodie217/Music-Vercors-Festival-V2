<?php

use App\DbConnexion\Db;
use App\Repositories\UserRepositories;

session_start();

require_once "./App/config/database.php";
require_once "./autoload.php";

$mailAdmin = htmlspecialchars("admin@admin.com");
$motDePasseAdmin = password_hash("Jesuisadmin", PASSWORD_DEFAULT);
// Personne possédant un compte


if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $user = (json_decode($data, true));

    if (isset($user['emailConnexion']) && !empty($user['emailConnexion']) && isset($user['motDePasseConnexion']) && !empty($user['motDePasseConnexion'])) {


        $dbConnexion = new Db();
        $UserRepositories = new UserRepositories($dbConnexion);

        if (filter_var($user['emailConnexion'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($user['emailConnexion']);
        } else {
            echo 'email invalide';
        }



        if ($UserRepositories->login($email, $user["motDePasseConnexion"])) {

            $utilisateur = $UserRepositories->getUserbyEmail($email);
            $roleUser = $utilisateur->getRole_user();
            if ($roleUser == 1) {
                echo "Je vais sur le tableau de bord de l'Admin";
            } else {
                echo 'Je vais sur le tableau de bord du User';
            }
        } else {
            echo 'FALSE';
        }
    } else {
        echo 'Merci de remplir tous les champs.';
    }
}
