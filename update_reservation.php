<?php
require_once __DIR__ . "/init.php";

use App\DbConnexion\Db;
use App\Models\Reservation;
use App\Repositories\NuitRepository;
use App\Repositories\PassRepository;
use App\Repositories\ReservationRepository;

$dbConnection = new Db();
$db = $dbConnection->getDB();
$reservationRepository = new ReservationRepository();

/**********Nuit et Pass options database**********/
$nuitRepository = new NuitRepository();
$passRepository = new PassRepository();
$nuitOptions = $nuitRepository->getAllNuits();
$passOptions = $passRepository->getAllPasses();
/***************************************************/

$prixTotal = 0;

$userId = $_SESSION['user_id'];
$reservationId = $_GET['id'];
$reservation = $reservationRepository->getReservationById($reservationId);

if (isset($_POST) && !empty($_POST)) {
    $nombre = htmlspecialchars($_POST['Nombre_reservation_Update']);
    $nombreCasque = htmlspecialchars($_POST['nombreCasquesEnfantsUpdate']);
    $nombreLuge = htmlspecialchars($_POST['NombreLugesEteUpdate']);

    // $nuitId = $_POST['Nuit_reservation'];
    $passId = $_POST['Pass_reservation_Update'];

    $nuitArray = [];
    if (isset($_POST['tenteNuit1'])) {
        array_push($nuitArray, 1);
    }
    if (isset($_POST['tenteNuit2'])) {
        array_push($nuitArray, 5);
    }
    if (isset($_POST['tenteNuit3'])) {
        array_push($nuitArray, 6);
    }
    if (isset($_POST['tente3Nuits'])) {
        array_push($nuitArray, 2);
    }
    if (isset($_POST['vanNuit1'])) {
        array_push($nuitArray, 3);
    }
    if (isset($_POST['vanNuit2'])) {
        array_push($nuitArray, 7);
    }
    if (isset($_POST['vanNuit3'])) {
        array_push($nuitArray, 8);
    }
    if (isset($_POST['van3Nuits'])) {
        array_push($nuitArray, 4);
    }

    if (isset($_POST['enfantsOuiUpdate'])) {
        $enfants = 1;
    } else {
        $enfants = 0;
    }

    $selectedPass = $passRepository->getPassById($passId);

    $prixNuits = 0;
    foreach ($nuitArray as $nuitID) {
        $selectedNuit = $nuitRepository->getNuitById($nuitID);
        $prixNuits = ($prixNuits + $selectedNuit->getPrix_nuit());
    }


    $passPrice = $selectedPass->getPrix_pass();

    $fixedPriceCasque = 5;
    $fixedPriceLuge = 10;


    //Refaire le calcul
    $prixTotal = ($passPrice + $prixNuits) * $nombre +
        ($nombreCasque * $fixedPriceCasque) + ($nombreLuge * $fixedPriceLuge);


    $infosResaUpdate = array(
        "Id_reservation" => $reservationId,
        "Nombre_reservation" => $nombre,
        "Enfants_reservation" => $enfants,
        "NombreCasque_reservation" => $nombreCasque,
        "NombreLuge_reservation" => $nombreLuge,
        "PrixTotal_reservation" => $prixTotal,
        "Id_Pass" => $passId,
    );

    $newResa = new Reservation($infosResaUpdate);


    if ($reservationRepository->updateReservation($newResa)) {
        /*************************update les Nuits/Passes**************************/
        if ($nuitRepository->updateNuitReservation($reservation->getId_reservation(), $nuitArray)) {
            echo "Done!";
            header('Location: index.php');
            exit();
        } else {
            echo "Error2.";
        }
    } else {
        echo "Error1.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./asset/style.css">
    <link rel="stylesheet" href="./asset/responsive.css">
</head>

<body class="relative bg-[url('./asset/medias/concert-852575_1920.jpg')] bg-cover bg-fixed bg-center">



    <form action="#" method="post" name="update_reservation">
        <div id="reservation" class="blocFormulaire">

            <h2 class="text-2xl font-bold mb-10">Réservation</h2>
            <h3 class="text-xl font-bold my-4">Nombre de réservation(s) :</h3>
            <input type="number" name="Nombre_reservation_Update" id="Nombre_reservation_Update" min="1" class="border-2 border-gray-800" value="<?= $reservation->getNombre_reservation() ?>" required>

            <div class="mb-4">
                <label for="Pass_reservation_Update" class="block text-gray-700 font-bold mb-2">Pass:</label>
                <select name="Pass_reservation_Update" id="Pass_reservation_Update" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value='<?= $reservation->getId_Pass(); ?>' required>
                    <?php foreach ($passOptions as $pass) : ?>
                        <option value="<?= $pass->getId_pass(); ?>" <?php if ($reservation->getId_Pass() == $pass->getId_pass()) {
                                                                        echo 'selected';
                                                                    } ?>><?= $pass->getPass_pass() ?> <span class="italic"><?= $pass->getDate_pass() ?></span> : <?= $pass->getPrix_pass() ?> € <?php if ($pass->getTarifReduit_pass() == 1) {
                                                                                                                                                                                                    echo '<span class="italic">(Tarif réduit)</span>';
                                                                                                                                                                                                } ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="messageErreurReservation"></div>

            <?php $nuits = $nuitRepository->getNuitByIdReservation($reservationId) ?>


            <h2 class="text-2xl font-bold my-8">Options</h2>
            <h3 class=" text-xl font-bold my-4">Réserver un emplacement de tente : </h3>

            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit1" name="tenteNuit1" <?php
                                                                            foreach ($nuits as $nuit) {
                                                                                if ($nuit->getId_nuit() == 1) {
                                                                                    echo 'checked';
                                                                                }
                                                                            } ?>>
                <label for="tenteNuit1">Pour la nuit du 01/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit2" name="tenteNuit2" <?php
                                                                            foreach ($nuits as $nuit) {
                                                                                if ($nuit->getId_nuit() == 5) {
                                                                                    echo 'checked';
                                                                                }
                                                                            } ?>>
                <label for="tenteNuit2">Pour la nuit du 02/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit3" name="tenteNuit3" <?php
                                                                            foreach ($nuits as $nuit) {
                                                                                if ($nuit->getId_nuit() == 6) {
                                                                                    echo 'checked';
                                                                                }
                                                                            } ?>>
                <label for="tenteNuit3">Pour la nuit du 03/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tente3Nuits" name="tente3Nuits" <?php
                                                                            foreach ($nuits as $nuit) {
                                                                                if ($nuit->getId_nuit() == 2) {
                                                                                    echo 'checked';
                                                                                }
                                                                            } ?>>
                <label for="tente3Nuits">Pour les 3 nuits (12€)</label>
            </div>

            <h3 class="text-xl font-bold my-4">Réserver un emplacement de camion aménagé : </h3>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit1" name="vanNuit1" <?php
                                                                        foreach ($nuits as $nuit) {
                                                                            if ($nuit->getId_nuit() == 3) {
                                                                                echo 'checked';
                                                                            }
                                                                        } ?>>
                <label for="vanNuit1">Pour la nuit du 01/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit2" name="vanNuit2" <?php
                                                                        foreach ($nuits as $nuit) {
                                                                            if ($nuit->getId_nuit() == 7) {
                                                                                echo 'checked';
                                                                            }
                                                                        } ?>>
                <label for="vanNuit2">Pour la nuit du 02/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit3" name="vanNuit3" <?php
                                                                        foreach ($nuits as $nuit) {
                                                                            if ($nuit->getId_nuit() == 8) {
                                                                                echo 'checked';
                                                                            }
                                                                        } ?>>
                <label for="vanNuit3">Pour la nuit du 03/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="van3Nuits" name="van3Nuits" <?php
                                                                        foreach ($nuits as $nuit) {
                                                                            if ($nuit->getId_nuit() == 4) {
                                                                                echo 'checked';
                                                                            }
                                                                        } ?>>
                <label for="van3Nuits">Pour les 3 nuits (12€)</label>
            </div>



            <h3 class="text-xl font-bold my-4">Venez-vous avec des enfants ?</h3>
            <div class="divenfants">
                <input type="checkbox" name="enfantsOuiUpdate" <?php if ($reservation->getEnfants_reservation() == 1) {
                                                                    echo 'checked';
                                                                } ?>><label for="enfantsOuiUpdate">Oui</label>
            </div>
            <div class="divenfants">
                <input type="checkbox" name="enfantsNonUpdate" <?php if ($reservation->getEnfants_reservation() == 0) {
                                                                    echo 'checked';
                                                                } ?>><label for="enfantsNonUpdate">Non</label>
            </div>


            <!-- Si oui, afficher : -->
            <section class="casqueEnfant">
                <h4 class="text-lg font-bold my-4">Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
                <label for="nombreCasquesEnfantsUpdate">Nombre de casques souhaités :</label>
                <input type="number" name="nombreCasquesEnfantsUpdate" id="nombreCasquesEnfantsUpdate" min="0" class="border-2 border-gray-800" value="<?= $reservation->getNombreCasque_reservation() ?>">
                <p>*Dans la limite des stocks disponibles.</p>
            </section>

            <h3 class="text-xl font-bold my-4">Profitez de descentes en luge d'été à tarifs avantageux !</h3>

            <div class="divluge">
                <label for="NombreLugesEteUpdate">Nombre de descentes en luge d'été (5€/descentes) :</label>
                <input type="number" name="NombreLugesEteUpdate" id="NombreLugesEteUpdate" min="0" class="border-2 border-gray-800" value="<?= $reservation->getNombreLuge_reservation() ?>">
                <div class="messageErreurLuge"></div>
            </div>

            <button type="submit" name="soumission" class="bouton">Réserver</button>
        </div>

    </form>

</body>

<script src="https://cdn.tailwindcss.com"></script>

</html>