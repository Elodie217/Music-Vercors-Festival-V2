<?php
require_once __DIR__ . "/../../init.php";
use App\DbConnexion\Db;
use App\Models\Reservation;
use App\Models\User;
use App\Repositories\NuitRepository;
use App\Repositories\PassRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\UserRepositories;

$Db = new Db;
$reservationsRepo = new ReservationRepository();
$user = new User();
$reservation = new Reservation();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/asset/styleAdmin.css">
</head>

<body class="bg-blue-100 min-h-screen">


  <section>
    <div class="py-16">
      <div class="mx-auto px-6 max-w-6xl text-gray-500">
        <div class="flex">
          <a href="./deconnexion.php" class="boutonConnexion flex-initial w-32 mt-5">Déconnexion</a>
        </div>
        <div class="text-center">
          <h1 class="text-3xl text-gray-950 dark:text-white font-semibold">Vercors Musique Festival</h1>
          <p class="mt-6 text-gray-700 dark:text-gray-300"></p>
        </div>

        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-3 opacity-90">

          <?php
          $reservations = $reservationsRepo->getAllReservations();

          foreach ($reservations as $reservation) {
            $userID = $reservation->getId_user();
            $userRepo = new UserRepositories();
            $user = $userRepo->getUserbyId($userID);

          ?>


            <div class='relative group overflow-hidden p-8 rounded-xl bg-white border border-gray-200 dark:border-gray-800 dark:bg-gray-900'>


              <div aria-hidden='true' class='inset-0 absolute aspect-video border rounded-full -translate-y-1/2 group-hover:-translate-y-1/4 duration-300 bg-gradient-to-b from-blue-500 to-white dark:from-white dark:to-white blur-2xl opacity-25 dark:opacity-5 dark:group-hover:opacity-10'>

              </div>

              <div class='relative'>

                <div class='mt-6 pb-6 rounded-b-[--card-border-radius]'>
                  <p class='ext-gray-700 dark:text-gray-300'>

                    <?php
                    echo "Numero de reservation : " . $reservation->getId_reservation() . "<br>";
                    echo "Nom: " . $user->getNom_user();
            $Id_pass = $reservation->getId_Pass();
                      $passRepo = new PassRepository();
                      $pass = $passRepo->getPassById($Id_pass);

                    ?>
                  </p>
                </div>
                <div>
                  <p> Nombre de personne :
                    <?= $reservation->getNombre_reservation() ?>
                  </p>
                  <!-- a revoir pour afficher en jour  -->
                  <p>Pass Jour : <?= $pass->getPass_pass() ?> <span class="italic"><?= $pass->getDate_pass() ?></span> : <?= $pass->getPrix_pass() ?> €</p>
                  <?php
                  $nuitR = new NuitRepository();
                  $reservationNuit = $nuitR->getNuitByIdReservation($reservation->getId_reservation());
                   ?>
                  <p>Nuit :
                    <?php foreach ($reservationNuit as $nuit) {
                      echo $nuit->getType_nuit() . ' <span class="italic">' . $nuit->getDate_nuit() . '</span> : ' . $nuit->getPrix_nuit() . ' €<br>';
                    } ?> </p>
                  <p>Nombre d'enfants : 
                <?php 
                if ($reservation->getEnfants_reservation()==1){
                  echo "oui ";
                }else{
                  echo "non";
                }
                  ?></p>
                  <p>Nombre de casques : <?= $reservation->getNombreCasque_reservation() ?></p>
                  <p>Luge : <?= $reservation->getNombreLuge_reservation() ?></p>
                  <p>Prix Total : <?= $reservation->getPrixTotal_reservation() ?></p>
                </div>

                <div class='flex gap-3 -mb-8 py-4 border-t border-gray-200  dark:border-gray-800'>
                  <div class='group rounded-xl disabled:border *:select-none [&>*:not(.sr-only)]:relative *:disabled:opacity-20 disabled:text-gray-950 disabled:border-gray-200 disabled:bg-gray-100 dark:disabled:border-gray-800/50 disabled:dark:bg-gray-900 dark:*:disabled:!text-white text-gray-950 bg-gray-100 hover:bg-gray-200/75 active:bg-gray-100 dark:text-white dark:bg-gray-500/10 dark:hover:bg-gray-500/15 dark:active:bg-gray-500/10 flex gap-1.5 items-center text-sm h-8 px-3.5 justify-center'>

                  <a href='/cours/Music-Vercors-Festival-V2-dev/admin/reservation/delete/<?= $reservation->getId_reservation() ?>' class=' cursor-pointer'>
                    <i class='fa-solid fa-trash'> DELETE</i></a>

                  </div>

                  <div href='#' class='group flex items-center rounded-xl disabled:border *:select-none [&>*:not(.sr-only)]:relative *:disabled:opacity-20 disabled:text-gray-950 disabled:border-gray-200 disabled:bg-gray-100 dark:disabled:border-gray-800/50 disabled:dark:bg-gray-900 dark:*:disabled:!text-white text-gray-950 bg-gray-100 hover:bg-gray-200/75 active:bg-gray-100 dark:text-white dark:bg-gray-500/10 dark:hover:bg-gray-500/15 dark:active:bg-gray-500/10 size-8 justify-center'>

                  <a href='/cours/Music-Vercors-Festival-V2-dev/admin/reservation/edit/<?= $reservation->getId_reservation() ?>' class='cursor-pointer '>
                  <i class="fa-solid fa-file-pen"> EDIT</i></a>
                  </div>
                </div>
              </div>
            </div>

          <?php };
          ?>


        </div>
      </div>
    </div>

  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/ff684f1294.js" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</body>

</html>