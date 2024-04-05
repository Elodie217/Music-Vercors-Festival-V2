<?php
require_once __DIR__ . "/../../init.php";

use App\DbConnexion\Db;
use App\Repositories\NuitRepository;
use App\Repositories\PassRepository;
use App\Repositories\ReservationRepository;

$dbConnection = new Db();
$db = $dbConnection->getDB();
$reservationRepository = new ReservationRepository($db);

/**********Nuit et Pass options database**********/
$nuitRepository = new NuitRepository($db);
$passRepository = new PassRepository($db);
$nuitOptions = $nuitRepository->getAllNuits();
$passTypes = $passRepository->getDistinctPasses();

$passIdMap = [];
foreach ($passRepository->getAllPasses() as $pass) {
    $passIdMap[$pass->getPass_pass()] = $pass->getId_pass();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link rel="stylesheet" href="../../../asset/style.css">
    <link rel="stylesheet" href="../../../asset/responsive.css">
</head>
<body class="relative bg-[url('../../../asset/medias/concert-852575_1920.jpg')] bg-cover bg-fixed bg-center">
    <a href="index.php" class="absolute top-6 right-[28%] rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold mx-14 bg-[#800080] hover:bg-[#808080] duration-300 z-20">Retour</a>
    <form method="post" action="/cours/Music-Vercors-Festival-V2-dev/admin/reservation/update" class="space-y-4">
    <input type="hidden" name="reservationId" value="<?php echo $reservation->getId_reservation(); ?>">
        <div id="reservation" class="blocFormulaire">
            <h2 class="text-2xl font-bold mb-10">Update Reservation</h2>

            <h3 class="text-xl font-bold my-4">Nombre de réservation(s) :</h3>
            <input type="number" name="Nombre_reservation" id="Nombre_reservation" min="1" class="border-2 border-gray-800" value="<?php echo $reservation->getNombre_reservation(); ?>" required>
           
            <h3 class="text-xl font-bold my-4">Réservation(s) en tarif réduit</h3>
<div>
    <input type="checkbox" name="tarifReduit" id="tarifreduitRadio" <?php if ($reservation->getId_Pass() != null && $passRepository->getPassById($reservation->getId_Pass())->getTarifReduit_pass() == 1) echo 'checked'; ?>>
    <label for="tarifReduit">Ma réservation sera en tarif réduit</label>
</div>

<h3 class="text-xl font-bold my-4">Choisissez votre formule :</h3>
<div id="passOptions">
    <?php foreach ($passTypes as $passType): ?>
        <div class="divPass">
            <input type="checkbox" name="passType[]" id="pass<?php echo $passType['Pass_pass']; ?>" value="<?php echo $passType['Pass_pass']; ?>" data-price="<?php echo $passType['Prix_pass']; ?>" data-reduced-price="<?php echo $passType['Prix_pass_reduit']; ?>" <?php if ($reservation->getId_Pass() == $passIdMap[$passType['Pass_pass']]) echo 'checked'; ?>>
            <label for="pass<?php echo $passType['Pass_pass']; ?>"><?php echo $passType['Pass_pass']; ?> : <span class="passPrice"><?php echo $passType['Prix_pass']; ?></span>€</label>
        </div>

        <section id="passDates<?php echo $passType['Pass_pass']; ?>" class="passDates <?php if ($reservation->getId_Pass() != $passIdMap[$passType['Pass_pass']]) echo 'hidden'; ?>">
            <?php
            $passDates = $passRepository->getPassDatesByType($passType['Pass_pass'], false);
            foreach ($passDates as $date) {
                $formattedDate = date('d/m', strtotime($date['Date_pass']));
                echo '<div>';
                echo '<input type="checkbox" name="passDate[]" id="passDate' . $date['Id_pass'] . '" value="' . $date['Id_pass'] . '" ' . ($reservation->getId_Pass() == $date['Id_pass'] ? 'checked' : '') . '>';
                echo '<label for="passDate' . $date['Id_pass'] . '">Pass pour la journée du ' . $formattedDate . ' (' . $date['Prix_pass'] . '€)</label>';
                echo '</div>';
            }
            ?>
        </section>

        <section id="reducedPassDates<?php echo $passType['Pass_pass']; ?>" class="passDates <?php if ($reservation->getId_pass() != $passIdMap[$passType['Pass_pass']]) echo 'hidden'; ?>">
            <?php
            $reducedPassDates = $passRepository->getPassDatesByType($passType['Pass_pass'], true);
            foreach ($reducedPassDates as $date) {
                $formattedDate = date('d/m', strtotime($date['Date_pass']));
                echo '<div>';
                echo '<input type="checkbox" name="passDate[]" id="reducedPassDate' . $date['Id_pass'] . '" value="' . $date['Id_pass'] . '" ' . ($reservation->getId_Pass() == $date['Id_pass'] ? 'checked' : '') . '>';
                echo '<label for="reducedPassDate' . $date['Id_pass'] . '">Pass pour la journée du ' . $formattedDate . ' (' . $date['Prix_pass'] . '€) (Tarif réduit)</label>';
                echo '</div>';
            }
            ?>
        </section>
    <?php endforeach; ?>
</div>
            <p class="bouton" onclick="suivant(blocReservation, blocOptions)">Suivant</p>
            <div class="messageErreurReservation"></div>
        </div>

        <div id="options" class="blocFormulaire options">
            <h2 class="text-2xl font-bold mb-10">Options</h2>

            <h3 class="text-xl font-bold my-4">Réserver un emplacement de tente :</h3>
            <?php foreach ($nuitOptions as $nuit): ?>
                <?php if ($nuit->getType_nuit() == '1 nuit tente' || $nuit->getType_nuit() == '3 nuits tente'): ?>
                    <div class="choixnuit">
                        <input type="checkbox" id="<?php echo str_replace(' ', '', $nuit->getType_nuit()); ?>" name="<?php echo str_replace(' ', '', $nuit->getType_nuit()); ?>" <?php if (in_array($nuit->getId_nuit(), $selectedNuitIds)) echo 'checked'; ?>>
                        <label for="<?php echo str_replace(' ', '', $nuit->getType_nuit()); ?>">Pour <?php echo $nuit->getType_nuit(); ?> du <?php echo date('d/m', strtotime($nuit->getDate_nuit())); ?> (<?php echo $nuit->getPrix_nuit(); ?>€)</label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <h3 class="text-xl font-bold my-4">Réserver un emplacement de camion aménagé :</h3>
            <?php foreach ($nuitOptions as $nuit): ?>
                <?php if ($nuit->getType_nuit() == '1 nuit camion' || $nuit->getType_nuit() == '3 nuits camion'): ?>
                    <div class="choixnuit">
                        <input type="checkbox" id="<?php echo str_replace(' ', '', $nuit->getType_nuit()); ?>" name="<?php echo str_replace(' ', '', $nuit->getType_nuit()); ?>" <?php if (in_array($nuit->getId_nuit(), $selectedNuitIds)) echo 'checked'; ?>>
                        <label for="<?php echo str_replace(' ', '', $nuit->getType_nuit()); ?>">Pour <?php echo $nuit->getType_nuit(); ?> du <?php echo date('d/m', strtotime($nuit->getDate_nuit())); ?> (<?php echo $nuit->getPrix_nuit(); ?>€)</label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <h3 class="text-xl font-bold my-4">Venez-vous avec des enfants ?</h3>
            <div class="divenfants">
                <input type="checkbox" name="enfantsOui" <?php if ($reservation->getEnfants_reservation()) echo 'checked'; ?>><label for="enfantsOui">Oui</label>
            </div>
            <div class="divenfants">
                <input type="checkbox" name="enfantsNon" <?php if (!$reservation->getEnfants_reservation()) echo 'checked'; ?>><label for="enfantsNon">Non</label>
            </div>

            <!-- Si oui, afficher : -->
            <section class="casqueEnfant tarifHidden">
                <h4 class="text-lg font-bold my-4">Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
                <label for="NombreCasque_reservation">Nombre de casques souhaités :</label>
                <input type="number" name="NombreCasque_reservation" id="NombreCasque_reservation" min="0" class="border-2 border-gray-800" value="<?php echo $reservation->getNombreCasque_reservation(); ?>">
                <p>*Dans la limite des stocks disponibles.</p>
                <div class="messageErreurCasques"></div>
            </section>

            <h3 class="text-xl font-bold my-4">Profitez de descentes en luge d'été à tarifs avantageux !</h3>
            <div class="divluge">
                <label for="NombreLuge_reservation">Nombre de descentes en luge d'été (5€/descentes) :</label>
                <input type="number" name="NombreLuge_reservation" id="NombreLuge_reservation" min="0" class="border-2 border-gray-800" value="<?php echo $reservation->getNombreLuge_reservation(); ?>">
                <div class="messageErreurLuge"></div>
            </div>
            <p class="bouton" onclick="precedent(blocOptions, blocReservation)">Précédent</p>
            <button type="submit" name="update_reservation" class="bouton">Update Reservation</button>
        </div>
    </form>
</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="../../../asset/scriptForm.js"></script>
</html>