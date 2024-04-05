<?php
require_once __DIR__ . '/../init.php';
use App\DbConnexion\Db;
$dbConnection = new Db();
$db = $dbConnection->getDB();

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$route = str_replace('/cours/Music-Vercors-Festival-V2-dev/', '', $route);
$routeParts = explode('/', $route);

switch ($route) {
    case '':
    case 'reservations':
        include __DIR__ . '/../App/Views/index.php';
        break;

    case 'reservations/create':
        include __DIR__ . '/../App/Views/create_reservation.php';
        break;

    case str_contains($route, "reservations/edit"):
        include __DIR__ . '/../App/Views/update_reservation.php';
        break;

    case 'admin':
        include __DIR__ . '/../App/Views/indexAdmin.php';
        break;

    case str_contains($route, "admin/reservation/edit"):
        include __DIR__ . '/../App/Views/formUpdateResaAdmin.php';
        break;

    case 'register':
    case 'login':
        include __DIR__ . '/../App/Views/indexInscriptionConnexion.php';
        break;

    case 'profile':
        include __DIR__ . '/../App/Views/profil.php';
        break;

}