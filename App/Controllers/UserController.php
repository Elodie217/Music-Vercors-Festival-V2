<?php

namespace App\Controllers;

use App\DbConnexion\Db;
use App\Models\User;
use App\Repositories\UserRepositories;

class UserController
{
        private $userRepository;

        
        public function __construct($db) {
            $this->userRepository = new UserRepositories($db);
        }


        public function login()
        {
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
                        exit();
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Identifiants incorrects'
                        );
                        echo json_encode($response);
                        exit();
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
        }
    public function register()
    {
        $data = file_get_contents("php://input");
        $userInfos = (json_decode($data, true));

        if (isset($userInfos)) {
            if (isset($userInfos['nom']) && isset($userInfos['prenom']) && isset($userInfos['email']) && isset($userInfos['telephone']) && isset($userInfos['adressePostale']) && isset($userInfos['motDePasse']) && isset($userInfos['confirmationMotDePasse']) && !empty($userInfos['nom']) && !empty($userInfos['prenom']) && !empty($userInfos['email']) && !empty($userInfos['telephone']) && !empty($userInfos['adressePostale']) && !empty($userInfos['motDePasse']) && !empty($userInfos['confirmationMotDePasse'])) {
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
                        $mdp = hash("whirlpool", $userInfos["motDePasse"]);
                    } else {
                        echo 'Les mots de passe sont différents.';
                    }
                } else {
                    echo 'Le mot de passe doit contenir au moins 6 caractères.';
                }

                $date = new \DateTime();

                $userRepo = new UserRepositories($database);

                if ($userRepo->checkUserExist($userInfos['email']) === 1) {
                    echo "Email already taken";
                    return;
                }

                $infosUser = array(
                    "Nom_user" => $nom,
                    "Prenom_user" => $prenom,
                    "Email_user" => $email,
                    "Telephone_user" => $tel,
                    "AdressePostale_user" => $adresse,
                    "MotDePasse_user" => $mdp,
                    "DateRGPD" => $date->format('d/m/Y')
                );

                $user = new User($infosUser);

                $userRepositorie = new UserRepositories($database);

                $retourUser = $userRepositorie->creerUser($user);

                if ($retourUser) {
                    echo 'success';
                    die;
                } else {
                    echo "Erreur";
                    die;
                }
            } else {
                echo 'Merci de remplir tous les champs.';
            }
        } else {
            echo 'Merci de remplir tous les champs.';
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
        exit();
    }
}