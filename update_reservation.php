<?php
require_once __DIR__ . "/init.php";

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
$passOptions = $passRepository->getAllPasses();
/***************************************************/

$prixTotal = 0;

$userId = $_SESSION['user_id'];
$reservationId = $_GET['id'];
$reservation = $reservationRepository->getReservationById($reservationId);

if (isset($_POST["update_reservation"])) {
    $nombre = $_POST['Nombre_reservation'];
    $enfants = $_POST['Enfants_reservation'];
    $nombreCasque = $_POST['NombreCasque_reservation'];
    $nombreLuge = $_POST['NombreLuge_reservation'];

    $nuitId = $_POST['Nuit_reservation'];
    $passId = $_POST['Pass_reservation'];
    $selectedPass = $passRepository->getPassById($passId);
    $selectedNuit = $nuitRepository->getNuitById($nuitId);
    $passPrice = $selectedPass->getPrix_pass();

    $fixedPriceCasque = 5;
    $fixedPriceLuge = 10;
    $prixTotal = ($passPrice + $selectedNuit->getPrix_nuit()) * $nombre +
        ($nombreCasque * $fixedPriceCasque) + ($nombreLuge * $fixedPriceLuge);

    $reservation->setNombre_reservation($nombre);
    $reservation->setEnfants_reservation($enfants);
    $reservation->setNombreCasque_reservation($nombreCasque);
    $reservation->setNombreLuge_reservation($nombreLuge);
    $reservation->setPrixTotal_reservation($prixTotal);

    if ($reservationRepository->updateReservation($reservation)) {
        echo "Done!";
        /*************************update les Nuits/Passes**************************/
        $reservationRepository->updateNuitReservation($reservation->getId_reservation(), $nuitId);
        $reservationRepository->updateReservationPass($reservation->getId_reservation(), $passId);
        header('Location: index.php');
        exit();
    } else {
        echo "Error.";
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
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Update Reservation</h1>
        <form action="#" method="post" name="update_reservation">
            <div class="mb-4">
                <label for="Nombre_reservation" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                <input type="number" name="Nombre_reservation" id="Nombre_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value="<?php echo $reservation->getNombre_reservation(); ?>" required>
            </div>
            <div class="mb-4">
                <label for="Enfants_reservation" class="block text-gray-700 font-bold mb-2">Enfants:</label>
                <input type="number" name="Enfants_reservation" id="Enfants_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value="<?php echo $reservation->getEnfants_reservation(); ?>" required>
            </div>
            <div class="mb-4">
                <label for="NombreCasque_reservation" class="block text-gray-700 font-bold mb-2">Nombre Casques:</label>
                <input type="number" name="NombreCasque_reservation" id="NombreCasque_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value="<?php echo $reservation->getNombreCasque_reservation(); ?>" required>
            </div>
            <div class="mb-4">
                <label for="NombreLuge_reservation" class="block text-gray-700 font-bold mb-2">Nombre Luges:</label>
                <input type="number" name="NombreLuge_reservation" id="NombreLuge_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value="<?php echo $reservation->getNombreLuge_reservation(); ?>" required>
            </div>
            
            <div class="mb-4">
                <label for="Nuit_reservation" class="block text-gray-700 font-bold mb-2">Nuit:</label>
                <select name="Nuit_reservation" id="Nuit_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
                    <?php foreach ($nuitOptions as $nuit): ?>
                        <option value="<?php echo $nuit->getId_nuit(); ?>"><?php echo $nuit->getType_nuit(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="Pass_reservation" class="block text-gray-700 font-bold mb-2">Pass:</label>
                <select name="Pass_reservation" id="Pass_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
                    <?php foreach ($passOptions as $pass): ?>
                        <option value="<?php echo $pass->getId_pass(); ?>"><?php echo $pass->getPass_pass(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button name="update_reservation" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Reservation</button>
        </form>
    </div>
</body>
</html>