<?php

use App\DbConnection\Db;
use App\Repositories\UserRepositories;
require_once "./config/database.php";
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
            $response = array(
                'status' => 'error',
                'message' => 'Email invalide'
            );
            echo json_encode($response);
            exit();
        }

        if ($UserRepositories->login($email, $user["motDePasseConnexion"])) {
            $utilisateur = $UserRepositories->getUserbyEmail($email);
            $roleUser = $utilisateur->getRole_user();
            $_SESSION['user_id'] = $utilisateur->getId_user();
            $_SESSION['role'] = $roleUser;
            $response = array(
                'status' => 'success',
                'role' => $roleUser
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Identifiants incorrects'
            );
            echo json_encode($response);
        }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
        echo json_encode($response);
        exit();
    }
}