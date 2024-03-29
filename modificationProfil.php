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
    if (isset($userInfos['nomModification']) && isset($userInfos['prenomModification'])  && isset($userInfos['emailModification']) && isset($userInfos['telephoneModification']) && isset($userInfos['adressePostaleModification']) && isset($userInfos['motDePasseModification']) && isset($userInfos['confirmationMotDePasseModification']) && !empty($userInfos['nomModification']) && !empty($userInfos['prenomModification']) && !empty($userInfos['emailModification']) && !empty($userInfos['telephoneModification']) && !empty($userInfos['adressePostaleModification']) && !empty($userInfos['motDePasseModification']) && !empty($userInfos['confirmationMotDePasseModification'])) {

        $database = new Db();

        $prenom = htmlspecialchars($userInfos['prenomModification']);
        $nom = htmlspecialchars($userInfos['nomModification']);

        if (filter_var($userInfos['emailModification'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($userInfos['emailModification']);
        } else {
            echo 'Email incorect';
        }

        $tel = htmlspecialchars($userInfos['telephoneModification']);
        $adresse = htmlspecialchars($userInfos['adressePostaleModification']);


        if ($userInfos["motDePasseModification"] >= 6 && $userInfos["confirmationMotDePasseModification"] >= 6) {
            if ($userInfos["motDePasseModification"] == $userInfos["confirmationMotDePasseModification"]) {
                $mdp = hash("whirlpool", $userInfos["motDePasseModification"]);
            } else {
                echo 'Les mots de passe sont différents.';
            }
        } else {
            echo 'Le mot de passe doit contenir au moins 6 caractères.';
        }




        $infosUser = array(
            // 'Id_user' => $_SESSION['connecté'],
            'Id_user' => 1,
            "Nom_user" => $nom,
            "Prenom_user" => $prenom,
            "Email_user" => $email,
            "Telephone_user" => $tel,
            "AdressePostale_user" => $adresse,
            "MotDePasse_user" => $mdp,
        );

        $user = new User($infosUser);
        $userRepositorie = new UserRepositories();

        $retourUser = $userRepositorie->updateUser($user);


        if ($retourUser) {
            echo 'success';
            die;
        } else {
            echo "Erreur";
            // header('location:../index.php?erreur=');
            die;
        }
    } else {
        echo 'Merci de remplir tous les champs.';
    }
} else {
    echo 'Merci de remplir tous les champs.';
}
