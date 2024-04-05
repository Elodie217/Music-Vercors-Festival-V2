<?php

namespace App\Controllers;

use App\DbConnexion\Db;
use App\Models\Reservation;
use App\Repositories\NuitRepository;
use App\Repositories\PassRepository;
use App\Repositories\ReservationRepository;

class AdminController
{
    private $reservationRepository;
    private $nuitRepository;
    private $passRepository;

    public function __construct($db)
    {
        $this->reservationRepository = new ReservationRepository($db);
        $this->nuitRepository = new NuitRepository($db);
        $this->passRepository = new PassRepository($db);
    }

    public function index()
    {
        $reservations = $this->reservationRepository->getAllReservations();
     }

    public function deleteResAdmin($reservationId)
    {
        if ($this->reservationRepository->deleteReservation($reservationId)) {
            header("Location: /cours/Music-Vercors-Festival-V2-dev/admin");
            exit();
        } else {
            exit();
        }
    }

    public function editResAdmin($reservationId)
    {
        $reservation = $this->reservationRepository->getReservationById($reservationId);
        $selectedNuitIds = $this->reservationRepository->getNuitIdsByReservationId($reservationId);
        $selectedPass = $this->passRepository->getPassById($reservation->getId_Pass());
        $nuitOptions = $this->nuitRepository->getAllNuits();
        $passTypes = $this->passRepository->getDistinctPasses();
        require_once __DIR__ . '../../../App/Views/formUpdateResaAdmin.php';
    }

    public function updateResAdmin($reservationId)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['Nombre_reservation'];
        $nombreCasque = $_POST['NombreCasque_reservation'];
        $nombreLuge = $_POST['NombreLuge_reservation'];


        if (isset($_POST['enfantsOui'])) {
            $enfants = 1;
        } else {
            $enfants = 0;
        }

        if (isset($_POST['passType']) && !empty($_POST['passType'])) {
            $selectedPassType = $_POST['passType'][0];
        } else {
            echo "No pass type selected.";
            exit();
        }

        if (isset($_POST['passDate']) && !empty($_POST['passDate'])) {
            $selectedPassDates = $_POST['passDate'];
            $selectedPassDate = null;

            foreach ($selectedPassDates as $passDate) {
                $pass = $this->passRepository->getPassById($passDate);
                if ($pass && $pass->getPass_pass() == $selectedPassType) {
                    $selectedPassDate = $passDate;
                    break;
                }
            }

            if ($selectedPassDate !== null) {
                $selectedPass = $this->passRepository->getPassById($selectedPassDate);
                $passPrice = $selectedPass->getPrix_pass();
                $passId = $selectedPassDate;
            } else {
                echo "No pass selected.";
                exit();
            }
        } else {
            echo "No pass date selected.";
            exit();
        }

        $nuitIds = [];
        $nuitOptions = $this->nuitRepository->getAllNuits();
        foreach ($nuitOptions as $nuit) {
            $nuitType = str_replace(' ', '', $nuit->getType_nuit());
            if (isset($_POST[$nuitType])) {
                $nuitIds[] = $nuit->getId_nuit();
            }
        }
        $nuitPrice = 0;
        foreach ($nuitIds as $nuitId) {
            $selectedNuit = $this->nuitRepository->getNuitById($nuitId);
            $nuitPrice += $selectedNuit->getPrix_nuit();
        }

        $fixedPriceCasque = 5;
        $fixedPriceLuge = 5;
        $prixTotal = ($passPrice + $nuitPrice) * $nombre +
            ($nombreCasque * $fixedPriceCasque) + ($nombreLuge * $fixedPriceLuge);

      $reservation = $this->reservationRepository->getReservationById($reservationId);
        if ($reservation === false) {
            echo "Reservation not found.";
            exit();
        }

        $userId = $reservation->getId_user(); 

        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        } else {
            $userId = $_SESSION['user_id'];
        }
            $infosResaUpdate = [
            "Id_reservation" => $reservation->getId_reservation(),
            "Nombre_reservation" => $nombre,
            "Enfants_reservation" => $enfants,
            "NombreCasque_reservation" => $nombreCasque,
            "NombreLuge_reservation" => $nombreLuge,
            "PrixTotal_reservation" => $prixTotal,
            "Id_Pass" => $passId,
            "Id_user" => $userId,
        ];

        $newResa = new Reservation($infosResaUpdate);

        if ($this->reservationRepository->updateReservation($newResa)) {
            $this->reservationRepository->updateNuitReservation($reservation->getId_reservation(), $nuitIds);
            header('Location:/cours/Music-Vercors-Festival-V2-dev/admin');
            exit();
        } else {
            echo "Error updating reservation.";
        }
    }
}
}
