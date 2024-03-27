<?php
session_start();

require_once "./App/config/database.php";
require_once "./autoload.php";

use App\DbConnexion\Db;
use App\Models\User;
use App\Repositories\UserRepositories;

$data = file_get_contents("php://input");
$userInfos = (json_decode($data, true));


if (isset($userInfos)) {
    if (isset($userInfos['nom']) && isset($userInfos['prenom'])  && isset($userInfos['email']) && isset($userInfos['telephone']) && isset($userInfos['adressePostale']) && isset($userInfos['motDePasse']) && isset($userInfos['confirmationMotDePasse']) && !empty($userInfos['nom']) && !empty($userInfos['prenom']) && !empty($userInfos['email']) && !empty($userInfos['telephone']) && !empty($userInfos['adressePostale']) && !empty($userInfos['motDePasse']) && !empty($userInfos['confirmationMotDePasse'])) {

        $database = new Db();

        $prenom = htmlspecialchars($userInfos['prenom']);
        $nom = htmlspecialchars($userInfos['nom']);

        if (filter_var($userInfos['email'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($userInfos['email']);
        } else {
            echo 'Email incorect';
        }

        $tel = htmlspecialchars($userInfos['telephone']);
        $adresse = htmlspecialchars($userInfos['adressePostale']);


        if ($userInfos["motDePasse"] >= 6 && $userInfos["confirmationMotDePasse"] >= 6) {
            if ($userInfos["motDePasse"] == $userInfos["confirmationMotDePasse"]) {
                $mdp = password_hash($userInfos["motDePasse"], PASSWORD_DEFAULT);
            } else {
                echo 'Les mots de passe sont différents.';
            }
        } else {
            echo 'Le mot de passe doit contenir au moins 6 caractères.';
        }

        $date = new \DateTime();



        $infosUser = array(
            "Nom_user" => $nom,
            "Prenom_user" => $prenom,
            "Email_user" => $email,
            "Telephone_user" => $tel,
            "AdressePostale_user" => $adresse,
            "MotDePasse_user" => $mdp,
            "DateRGPD" => $date->format('d/m/Y')
        );

        var_dump($user);

        $user = new User($infosUser);

        $userRepositorie = new UserRepositories($database);

        $retourUser = $userRepositorie->creerUser($user);

        var_dump($retourUser);

        if ($retourUser) {
            echo 'success';
            die;
        } else {
            echo "C'est la merde";
            // header('location:../index.php?erreur=');
            die;
        }
    } else {
        echo 'Merci de remplir tous les champs.2';
    }
} else {
    echo 'Merci de remplir tous les champs.1';
}
