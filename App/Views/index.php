<?php
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
<body class="bg-gray-100">
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enfants</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Casques</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Luges</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix Total</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getId_reservation() ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getNombre_reservation() ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getEnfants_reservation() ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getNombreCasque_reservation() ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getNombreLuge_reservation() ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getPrixTotal_reservation() ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $reservation->getId_user() ?></td>
                            <td><a href="/cours/Music-Vercors-Festival-V2-dev/reservations/edit/<?php echo $reservation->getId_reservation()?>" class="text-green-500 hover:text-green-700">Edit</td>
                          <td><a href="/cours/Music-Vercors-Festival-V2-dev/reservations/delete/<?php echo$reservation->getId_reservation() ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
