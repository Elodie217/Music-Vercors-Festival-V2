<?php
require_once __DIR__ . "/init.php";

use App\DbConnection\Db;
use App\Repositories\ReservationRepository;

$dbConnection = new Db();
$db = $dbConnection->getDB();
$reservationRepository = new ReservationRepository($db);

$reservationId = $_GET['id'];

if ($reservationRepository->deleteReservation($reservationId)) {
    echo "Reservation deleted successfully!";
    header('Location: index.php');
    exit();
} else {
    echo "Error deleting reservation.";
}
?>