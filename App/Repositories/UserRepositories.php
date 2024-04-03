<?php
namespace App\Repositories;

use App\DbConnexion\Db;
use App\Models\User;
use PDO;
use PDOException;

class UserRepositories
{

    private $DB;

    public function __construct()
    {
        $database = new Db;
        $this->DB = $database->getDB();

    }

    public function creerUser(User $user): bool
    {
        $sql = "INSERT INTO mvf_user (Nom_user, Prenom_user, Email_user, Telephone_user, AdressePostale_user, MotDePasse_user, Role_user, DateRGPD) VALUES (:Nom_user, :Prenom_user, :Email_user, :Telephone_user, :AdressePostale_user, :MotDePasse_user, :Role_user, :DateRGPD)";
    
        $statement = $this->DB->prepare($sql);
    
        $role = $user->getRole_user() ?? 0; 
    
        $retour = $statement->execute([
            ':Nom_user' => $user->getNom_user(),
            ":Prenom_user" => $user->getPrenom_user(),
            ":Email_user" => $user->getEmail_user(),
            ":Telephone_user" => $user->getTelephone_user(),
            ":AdressePostale_user" => $user->getAdressePostale_user(),
            ":MotDePasse_user" => $user->getMotDePasse_user(),
            ":Role_user" => $role,
            ":DateRGPD" => $user->getDateRGPD()
        ]);
    
        return $retour;
    }




    public function login(string $email, string $password)
    {
        $hash = hash("whirlpool", $password);
        try {
            $stmt = $this->DB->query("SELECT * FROM mvf_user WHERE Email_user = '$email' AND MotDePasse_user = '$hash' ");
        } catch (\PDOException $e) {

        }
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User($row);
        }

        if (isset($user)) {
            $_SESSION["connecté"] = $user->getId_user();
            return "connected";;

        } else {
            return "not connected";
        }
    }

    public function checkUserExist($email)
    {
        // $email = $user->getEmail_user();

        try {
            $stmt = $this->DB->query("SELECT * FROM mvf_user WHERE Email_user = '$email' ");
        } catch (\PDOException $e) {
            return $e;
        }
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User($row);
        }

        return $stmt->rowCount() == 1;
    }


    public function getUserbyEmail(string $email): User|bool
    {
        $sql = "SELECT * FROM mvf_user WHERE Email_user = :email";

        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $retour = $statement->fetch();

        return $retour;
    }



    public function getUserbyId(string $IdUser): User|bool
    {
        $sql = "SELECT * FROM mvf_user WHERE Id_user = :IdUser";

        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':IdUser', $IdUser);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $retour = $statement->fetch();

        return $retour;
    }


    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM mvf_reservation WHERE Id_user = :ID;
            DELETE FROM mvf_user WHERE Id_user = :ID;";

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

        $sql = "UPDATE mvf_user 
            SET
              Nom_user = :Nom,
              Prenom_user =  :Prenom,
              Email_user = :Email,
              Telephone_user = :Tel,
              AdressePostale_user = :Adresse,
              MotDePasse_user = :MDP

            WHERE Id_user = :Id_user";

        $statement = $this->DB->prepare($sql);

        $retour = $statement->execute([
            ':Id_user' => $_SESSION['connecté'],
            ':Nom' => $user->getNom_user(),
            ':Prenom' => $user->getPrenom_user(),
            ':Email' => $user->getEmail_user(),
            ':Tel' => $user->getTelephone_user(),
            ':Adresse' => $user->getAdressePostale_user(),
            ':MDP' => $user->getMotDePasse_user(),

        ]);

        return $retour;
    }

}
