<?php

use App\Repositories\NuitRepository;
use App\Repositories\PassRepository;
use App\Repositories\ReservationRepository;

require_once __DIR__ . "/../../init.php";


$userId = $_SESSION['user_id'] ?? null;
if ($userId) {
    $reservationRepository = new ReservationRepository();
    $reservations = $reservationRepository->getReservationsByUserId($userId);
} else {
    $reservations=[];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="relative bg-[url('../asset/medias/concert-852575_1920.jpg')] bg-cover bg-fixed bg-center">
<a href="/cours/Music-Vercors-Festival-V2-dev/profile" class="absolute right-[25%] top-2">
        <i class="fa-solid fa-user text-5xl"></i>
    </a>

<a href="/cours/Music-Vercors-Festival-V2-dev/logout" class="absolute top-2 right-[2%] rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold mx-14 bg-[#800080] hover:bg-[#808080] duration-300 z-20">Déconnexion</a>
<h1 class="text-3xl font-bold text-center mt-8">Reservations</h1>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <a href="/cours/Music-Vercors-Festival-V2-dev/reservations/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Reservation</a>  
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pass</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nuits</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enfants</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Casques</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Luges</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix Total</th>
                            <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th> -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($reservations as $reservation) :
                            $Id_pass = $reservation->getId_Pass();

                            $passRepo = new PassRepository();
                            $pass = $passRepo->getPassById($Id_pass);

                            $nuitRepository = new NuitRepository();
                            $nuits = $nuitRepository->getNuitByIdReservation($reservation->getId_reservation());

                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getId_reservation() ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getNombre_reservation() ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $pass->getPass_pass() ?> <span class="italic"><?= $pass->getDate_pass() ?></span> : <?= $pass->getPrix_pass() ?> €</td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php foreach ($nuits as $nuit) {
                                                                            echo $nuit->getType_nuit() . ' <span class="italic">' . $nuit->getDate_nuit() . '</span> : ' . $nuit->getPrix_nuit() . ' €<br>';
                                                                        } ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getEnfants_reservation() ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getNombreCasque_reservation() ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getNombreLuge_reservation() ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getPrixTotal_reservation() ?></td>
                                <!-- <td class="px-6 py-4 whitespace-nowrap">// $reservation->getId_user() </td> -->
                                <td> <a href="update_reservation.php?id=<?= $reservation->getId_reservation() ?>" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a></td>
                                <td><a href="delete_reservation.php?id=<?= $reservation->getId_reservation() ?>" class="text-red-500 hover:text-red-700 pr-4" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
`<script src="https://kit.fontawesome.com/97cd5da9a0.js" crossorigin="anonymous"></script>
</html>
