<?php

namespace App\DbConnexion;

use PDO;
use PDOException;

final class Db
{

    private $DB;
    private $config;

    public function __construct()
    {
        $this->config = __DIR__ . '/../../config/database.php';

        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->DB = new PDO($dsn, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $error) {
            echo "Erreur de connexion à la Base de Données : " . $error->getMessage();
        }
    }

    public function getDB(): PDO
    {
        return $this->DB;
    }

    /**
     * Initialisation de la Base de Données : installation des tables et mise à jour du fichier config.php
     * @return string message d'échec ou de réussite.
     */
    public function initialisationBDD(): string
    {
        // Télécharger le(s) fichier(s) sql d'initialisation dans la BDD
        // Et effectuer les différentes migrations
        try {

            $migrationExistante = TRUE;
            while ($migrationExistante === TRUE) {
                $migration = __DIR__ . "/../asset/mvfv2.sql";
                if (file_exists($migration)) {
                    $sql = file_get_contents($migration);
                    $this->DB->query($sql);
                } else {
                    $migrationExistante = FALSE;
                }
            }

            // Mettre à jour le fichier config.php
            if ($this->UpdateConfig()) {
                return "installation de la Base de Données terminée !";
            }
        } catch (PDOException $erreur) {
            return "impossible de remplir la Base de données : " . $erreur->getMessage();
        }
    }


    private function UpdateConfig(): bool
    {

        $fconfig = fopen($this->config, 'w');

        $contenu = "<?php

        define('DB_HOST', 'localhost');
        define('DB_NAME', 'my_webapp__31');
        define('DB_USER', 'my_webapp__31');
        define('DB_PWD', 'RptBG1OMurih1y4MM3H95R6KcI1Zbj');

       
        define('DB_INITIALIZED', TRUE);

        ";


        if (fwrite($fconfig, $contenu)) {
            fclose($fconfig);
            return true;
        } else {
            return false;
        }
    }
}
