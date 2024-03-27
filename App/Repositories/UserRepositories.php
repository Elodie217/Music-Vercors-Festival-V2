<?php

namespace App\Repositories;

use App\DbConnexion\Db;
use App\Models\User;
use PDO;
use PDOException;

class UserRepositories
{

    private $DB;

    public function __construct(Db $dbConnexion)
    {
        $database = new Db;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../config/database.php';
    }


    public function creerUser2(User $user)
    {
        var_dump($user);
        $nom = $user->getNom_user();
        $prenom = $user->getPrenom_user();
        $email = $user->getEmail_user();
        $telephone = $user->getTelephone_user();
        $adresse = $user->getAdressePostale_user();
        $password = $user->getMotDePasse_user();
        $role = $user->getRole_user();
        $RGPD = $user->getDateRGPD();

        $sql = "INSERT INTO mvf_user VALUES(NULL,?,?,?,?,?,?,?,?)";
        $stmt = $this->DB->prepare($sql);

        $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $password, 0, $RGPD]);

        return $stmt->rowCount() == 1;
    }

    public function creerUser(User $user): bool
    {
        $sql = "INSERT INTO mvf_user (Nom_user, Prenom_user, Email_user, Telephone_user, AdressePostale_user, MotDePasse_user, Role_user, DateRGPD) VALUES (:Nom_user, :Prenom_user, :Email_user, :Telephone_user, :AdressePostale_user, :MotDePasse_user, :Role_user, :DateRGPD)";

        $statement = $this->DB->prepare($sql);

        $retour = $statement->execute([
            ':Nom_user' => $user->getNom_user(),
            ":Prenom_user" => $user->getPrenom_user(),
            ":Email_user" => $user->getEmail_user(),
            ":Telephone_user" => $user->getTelephone_user(),
            ":AdressePostale_user" => $user->getAdressePostale_user(),
            ":MotDePasse_user" => $user->getMotDePasse_user(),
            ":Role_user" => $user->getRole_user(),
            ":DateRGPD" => $user->getDateRGPD()
        ]);

        return $retour;
    }




    public function login(string $email, string $password)
    {

        $sql = "SELECT * FROM tdl_user WHERE EMAIL = :email";

        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User\User');
        $user = $statement->fetch();

        if ($user) {
            if (password_verify($password, $user->getMot_de_passe())) {
                return $statement->rowCount() == 1;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }




    public function getUserbyEmail(string $email): User|bool
    {
        $sql = "SELECT * FROM tdl_user WHERE Email = :email";

        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User\User');
        $retour = $statement->fetch();

        return $retour;
    }

    public function getUserbyId(string $IdUser): User|bool
    {
        $sql = "SELECT * FROM tdl_user WHERE Id_user = :IdUser";

        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':IdUser', $IdUser);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User\User');
        $retour = $statement->fetch();

        return $retour;
    }


    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM tdl_tache WHERE Id_user = :ID;
            DELETE FROM tdl_user WHERE Id_user = :ID;";

            $statement = $this->DB->prepare($sql);

            return $statement->execute([':ID' => $id]);
        } catch (PDOException $error) {
            echo "Erreur de suppression : " . $error->getMessage();
            return FALSE;
        }
    }




    public function updateUser(User $user): bool
    {
        session_start();

        $sql = "UPDATE tdl_user 
            SET
              Nom = :Nom,
              Prenom =  :Prenom,
              Email = :Email
            WHERE Id_user = :Id_user";

        $statement = $this->DB->prepare($sql);

        $retour = $statement->execute([
            ':Id_user' => $_SESSION['connecté'],
            ':Nom' => $user->getNom(),
            ':Prenom' => $user->getPrenom(),
            ':Email' => $user->getEmail(),
        ]);

        return $retour;
    }
}
