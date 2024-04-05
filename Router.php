<?php

use App\Controllers\AdminController;
use App\Controllers\ReservationController;
use App\Controllers\UserController;
use App\DbConnexion\Db;

$dbConnection = new Db();
$db = $dbConnection->getDB();
$userController = new UserController($db);
$reservationController = new ReservationController($db);
$adminController = new AdminController($db);

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$route = str_replace('/cours/Music-Vercors-Festival-V2-dev/', '', $route);
$routeParts = explode('/', $route);

switch ($route) {
    case 'reservations':
        if (isset($_SESSION['user_id']))  {
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                header('Location: /cours/Music-Vercors-Festival-V2-dev/admin');
                exit();
            } else {
                $reservationController->index();
            }
        } else {
            header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
        }
        break;

    case str_contains($route, "reservations/edit"):
        $reservationId = end($routeParts);
        if (!empty($reservationId)) {
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                header('Location: /cours/Music-Vercors-Festival-V2-dev/admin');
                exit();
            } else {
                $reservationController->edit($reservationId);
            }
        } else {
        }
        break;

    case 'reservations/update':
        if ($method === 'POST') {
            if (isset($_SESSION['user_id'])) {
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    header('Location: /cours/Music-Vercors-Festival-V2-dev/admin');
                    exit();
                } else {
                    $reservationId = $_POST['reservationId'];
                    $reservationController->update($reservationId);
                }
            } else {
                header('Location:/cours/Music-Vercors-Festival-V2-dev/login');
            }
        } else {
            echo 'ADMIN!! YOU Not Allowed "reservation-update"';
        }
        break;

    case 'reservations/create':
        if ($method === 'GET') {
            if (isset($_SESSION['user_id'])) {
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    header('Location: /cours/Music-Vercors-Festival-V2-dev/admin');
                    exit();
                } else {
                    $reservationController->create();
                }
            } else {
                header('Location:/cours/Music-Vercors-Festival-V2-dev/login');
            }
        } else {
            echo 'ADMIN!! YOU Not Allowed "reservation-create"';
        }
        break;

    case 'reservations/store':
        if ($method === 'POST') {
            if (isset($_SESSION['user_id'])) {
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    header('Location: /cours/Music-Vercors-Festival-V2-dev/admin');
                    exit();
                } else {
                    $reservationController->store();
                }
            } else {
                header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
            }
        } else {
            echo 'ADMIN!! YOU Not Allowed "reservations-store"';
        }
        break;

    case str_contains($route, "reservations/delete"):
        $routeParts = explode('/', $route);
        $reservationId = end($routeParts);
        if (!empty($reservationId)) {
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                header('Location: /cours/Music-Vercors-Festival-V2-dev/admin');
                exit();
            } else {
                $reservationController->delete($reservationId);
            }
        } else {
            echo 'ADMIN!! YOU Not Allowed "reservations-delete"';
        }
        break;

    case 'register':
        if ($method === 'POST') {
            $userController->register();
        }
        break;

    case 'login':
        if ($method === 'POST') {
            $userController->login();
        } 
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'profile':
        if (isset($_SESSION['user_id'])&&!$_SESSION['role'] == 1) {
        } else {
            header('Location:/cours/Music-Vercors-Festival-V2-dev/login');
        }
        break;

    case str_contains($route, "profile/update"):
        $routeParts = explode('/', $route);
        $userId = end($routeParts);
        if ($method === 'POST' && !empty($userId)&&!$_SESSION['role'] == 1) {
            $userController->updateProfile($userId);
        } else {
            echo 'ADMIN!! YOU Not Allowed "profile-update"';
        }
        break;

    case str_contains($route, "profile/delete"):
        $routeParts = explode('/', $route);
        $userId = end($routeParts);
        if ($method === 'POST' && !empty($userId)&&!$_SESSION['role'] == 1) {
            $response = $userController->deleteAccount($userId);
        } else {
            echo 'ADMIN!! YOU Not Allowed "profile-delete"';
        }
        break;

    case 'admin':
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 1) {
            $adminController->index();
        } else {
            header('Location: /cours/Music-Vercors-Festival-V2-dev/login');
        }
        break;

        case str_contains($route, "admin/reservation/update"):
            if ($method === 'POST') {
                $reservationId = $_POST['reservationId'] ?? null;
                if (!empty($reservationId)) {
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    $adminController->updateResAdmin($reservationId);
                     } else {
                        echo 'Access Denied';
                    }
                } else {
                    echo "admin-reservations-update";
                }
            } else {
                echo 'You Not Allowed "admin-reservations-update"';
            }
            break;

            case str_contains($route, "admin/reservation/delete"):
                $routeParts = explode('/', $route);
                $reservationId = end($routeParts);
                if (!empty($reservationId)) {
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        $adminController->deleteResAdmin($reservationId);
                    } else {
                        echo 'Access Denied';
                    }
                } else {
                    echo 'You Not Allowed "admin-reservations-delete"';
                }
                break;
        

    case str_contains($route, "admin/reservation/edit"):
        $routeParts = explode('/', $route);
        $reservationId = end($routeParts);
        if (!empty($reservationId)) {
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                $adminController->editResAdmin($reservationId);
            } else {
                echo 'Access Denied';
            }
        } else {
            echo 'YOU Not Allowed "admin-reservations-edit"';
        }
        break;

    case str_contains($route, "admin/reservation/update"):
        $routeParts = explode('/', $route);
        $reservationId = end($routeParts);
        if ($method === 'POST' && !empty($reservationId)) {
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                $adminController->updateResAdmin($reservationId);
            } else {
                echo 'Access Denied';
            }
        } else {
            echo 'YOU Not Allowed "admin-reservations-update"';
        }
        break;

    
}