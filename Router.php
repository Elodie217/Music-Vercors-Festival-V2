<?php

use App\Controllers\ReservationController;
use App\Controllers\UserController;
use App\DbConnexion\Db;
use App\Models\Reservation;
use App\Models\User;

$dbConnection = new Db();
$db = $dbConnection->getDB();
$userController = new UserController($db);
$reservationController = new ReservationController($db);


$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$route = str_replace('/cours/Music-Vercors-Festival-V2-dev/', '', $route);
$routeParts = explode('/', $route);


switch ($route) {
    case '':
        if (isset($_SESSION['user_id'])) {
        $reservationController->index();
        } else {
            header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
        }
        break;
    case 'reservations':
        if (isset($_SESSION['user_id'])) {
            $reservationController->index();
        } else {
            header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
        }
        break;

        case str_contains($route,"reservations/edit"):
            $reservationId = end($routeParts);
            if (!empty($reservationId)) {
                $reservationController->edit($reservationId);
            } else {
                http_response_code(405);
            }
            break;
         case 'reservations/update':
            if ($method === 'POST') {
                    if (isset($_SESSION['user_id'])) {
                    $reservationId = $_POST['reservationId'];
                    $reservationController->update($reservationId);
                } else {
                    header('Location:/cours/Music-Vercors-Festival-V2-dev/login');
                }
            } else {
                    http_response_code(405);
                    echo 'Method Not Allowed "reservation-update"';
                }
                break;

        case 'reservations/create':
            if ($method === 'GET') {
                if (isset($_SESSION['user_id'])) {
                    $reservationController->create();
                } else {
                    header('Location:/cours/Music-Vercors-Festival-V2-dev/login');
                }
            } else {
                http_response_code(405);
                echo 'Method Not Allowed "reservation-create"';
            }
            break;

        case 'reservations/store':
            if ($method === 'POST') {
                if (isset($_SESSION['user_id'])) {
                    $reservationController->store();
                } else {
                    header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
                }
            } else {
                http_response_code(405);
                echo 'Method Not Allowed "reservations-store"';
            }
            break;

            case str_contains($route, "reservations/delete"):
                $routeParts = explode('/', $route);
                $reservationId = end($routeParts);
                if (!empty($reservationId)) {
                    $reservationController->delete($reservationId);
                } else {
                    http_response_code(405);
                    echo 'Method Not Allowed "reservations-delete"';
                }
                break;
                


        /**************** */

    case 'register':
        if ($method === 'POST') {
            $userController->register();
        } else {
            require_once '../App/Views/indexInscriptionConnexion.php';
        }
        break;

    case 'login':
        if ($method === 'POST') {
            $userController->login();
        } else {
            require_once '../App/Views/indexInscriptionConnexion.php';
        }
        break;

    case 'logout':
        $userController->logout();
        break;

    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}