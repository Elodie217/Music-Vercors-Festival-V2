<?php

use App\DbConnexion\Db;

session_start();

require __DIR__ . "/config/database.php";
require __DIR__ . '/autoload.php';
if (DB_INITIALIZED == FALSE) {
    $db = new Db();
    echo $db->initialisationBDD();
}
require __DIR__ .'/Router.php';
