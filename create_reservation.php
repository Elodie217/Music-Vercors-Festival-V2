<?php
require_once __DIR__ . "/init.php";

use App\DbConnexion\Db;
use App\Models\Reservation;
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
if (isset($_POST["create_reservation"])) {
    $nombre = htmlspecialchars($_POST['Nombre_reservation']);
    // $enfants = $_POST['Enfants_reservation']; //A changer
    $nombreCasque = htmlspecialchars($_POST['NombreCasque_reservation']);
    $nombreLuge = htmlspecialchars($_POST['NombreLuge_reservation']);

    // $nuitId = $_POST['Nuit_reservation'];
    // $passId = $_POST['Pass_reservation'];

    if (isset($_POST['choixJour1'])) {
        $passId = 1;
    } else if (isset($_POST['choixJour2'])) {
        $passId = 2;
    } else if (isset($_POST['choixJour3'])) {
        $passId = 3;
    } else if (isset($_POST['choixJour12'])) {
        $passId = 4;
    } else if (isset($_POST['choixJour23'])) {
        $passId = 5;
    } else if (isset($_POST['pass3jours'])) {
        $passId = 6;
    } else if (isset($_POST['choixJour1Reduit'])) {
        $passId = 7;
    } else if (isset($_POST['choixJour2Reduit'])) {
        $passId = 8;
    } else if (isset($_POST['choixJour3Reduit'])) {
        $passId = 9;
    } else if (isset($_POST['choixJour12Reduit'])) {
        $passId = 10;
    } else if (isset($_POST['choixJour23Reduit'])) {
        $passId = 11;
    } else if (isset($_POST['pass3joursReduit'])) {
        $passId = 12;
    }

    $nuitId = "";
    // if (isset($_POST['tenteNuit1'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['tenteNuit2'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['tenteNuit3'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['tente3Nuits'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['vanNuit1'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['vanNuit2'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['vanNuit3'])) {
    //     $nuitId .= ;
    // }
    // if (isset($_POST['van3Nuits'])) {
    //     $nuitId .= ;
    // }



    if (isset($_POST['enfantsOui'])) {
        $enfants = 1;
    } else {
        $enfants = 0;
    }

    $selectedPass = $passRepository->getPassById($passId);
    $selectedNuit = $nuitRepository->getNuitById($nuitId);
    $passPrice = $selectedPass->getPrix_pass();

    $fixedPriceCasque = 5;
    $fixedPriceLuge = 10;
    $prixTotal = ($passPrice + $selectedNuit->getPrix_nuit()) * $nombre +
        ($nombreCasque * $fixedPriceCasque) + ($nombreLuge * $fixedPriceLuge);

    $reservation = new Reservation();
    $reservation->setNombre_reservation($nombre);
    $reservation->setEnfants_reservation($enfants);
    $reservation->setNombreCasque_reservation($nombreCasque);
    $reservation->setNombreLuge_reservation($nombreLuge);
    $reservation->setPrixTotal_reservation($prixTotal);
    $reservation->setId_user($userId);

    if ($reservationRepository->createReservation($reservation)) {
        echo "Done!";
        /*************************inserer les Nuits/Passes**************************/
        $reservationRepository->insertNuitReservation($reservation->getId_reservation(), $nuitId);
        $reservationRepository->insertReservationPass($reservation->getId_reservation(), $passId);
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
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./asset/style.css">
    <link rel="stylesheet" href="./asset/responsive.css">
</head>

<body class="relative bg-[url('./asset/medias/concert-852575_1920.jpg')] bg-cover bg-fixed bg-center">
    <a href="index.php" class="absolute top-6 right-[28%] rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold mx-14 bg-[#800080] hover:bg-[#808080] duration-300 z-20">Retour</a>
    <form action="#" id="inscription" method="POST" name="create_reservation">
        <div id="reservation" class="blocFormulaire">

            <h2 class="text-2xl font-bold mb-10">Réservation</h2>
            <h3 class="text-xl font-bold my-4">Nombre de réservation(s) :</h3>
            <input type="number" name="Nombre_reservation" id="Nombre_reservation" min="1" class="border-2 border-gray-800" required>
            <h3 class="text-xl font-bold my-4">Réservation(s) en tarif réduit</h3>
            <div>
                <input type="checkbox" name="tarifReduit" id="tarifreduitRadio">
                <label for="tarifReduit">Ma réservation sera en tarif réduit</label>
            </div>

            <h3 class="text-xl font-bold my-4">Choisissez votre formule :</h3>
            <div class="divPass1Jour">
                <input type="checkbox" name="pass1jour" id="pass1jour">
                <label for="pass1jour">Pass 1 jour : 40€</label>
            </div>

            <section id="pass1jourDate" class="tarifHidden">
                <input type="checkbox" name="choixJour1" id="choixJour1">
                <label for="choixJour1">Pass pour la journée du 01/07</label>
                <input type="checkbox" name="choixJour2" id="choixJour2">
                <label for="choixJour2">Pass pour la journée du 02/07</label>
                <input type="checkbox" name="choixJour3" id="choixJour3">
                <label for="choixJour3">Pass pour la journée du 03/07</label>
            </section>

            <div class="divPass2Jours">
                <input type="checkbox" name="pass2jours" id="pass2jours">
                <label for="pass2jours">Pass 2 jours : 70€</label>
            </div>

            <section id="pass2joursDate" class="tarifHidden">
                <input type="checkbox" name="choixJour12" id="choixJour12">
                <label for="choixJour12">Pass pour deux journées du 01/07 au 02/07</label>
                <input type="checkbox" name="choixJour23" id="choixJour23">
                <label for="choixJour23">Pass pour deux journées du 02/07 au 03/07</label>
            </section>

            <div class="divPass3Jours">
                <input type="checkbox" name="pass3jours" id="pass3jours">
                <label for="pass3jours">Pass 3 jours : 100€</label>
            </div>


            <div id="tarifreduit" class="tarifHidden">

                <div class="divPass1JourReduit">
                    <input type="checkbox" name="pass1jourReduit" id="pass1jourReduit">
                    <label for="pass1jourReduit">Pass 1 jour, Tarif réduit : 25€</label>
                </div>

                <section id="pass1jourDateReduit" class="tarifHidden">
                    <input type="checkbox" name="choixJour1Reduit" id="choixJour1Reduit">
                    <label for="choixJour1Reduit">Pass pour la journée du 01/07, Tarif réduit</label>
                    <input type="checkbox" name="choixJour2Reduit" id="choixJour2Reduit">
                    <label for="choixJour2Reduit">Pass pour la journée du 02/07, Tarif réduit</label>
                    <input type="checkbox" name="choixJour3Reduit" id="choixJour3Reduit">
                    <label for="choixJour3Reduit">Pass pour la journée du 03/07, Tarif réduit</label>
                </section>

                <div class="divPass2JoursReduit">
                    <input type="checkbox" name="pass2joursReduit" id="pass2joursReduit">
                    <label for="pass2joursReduit">Pass 2 jours, Tarif réduit : 50€</label>
                </div>

                <section id="pass2joursDateReduit" class="tarifHidden">
                    <input type="checkbox" name="choixJour12Reduit" id="choixJour12Reduit">
                    <label for="choixJour12Reduit">Pass pour deux journées du 01/07 au 02/07, Tarif réduit</label>
                    <input type="checkbox" name="choixJour23Reduit" id="choixJour23Reduit">
                    <label for="choixJour23Reduit">Pass pour deux journées du 02/07 au 03/07, Tarif réduit</label>
                </section>

                <div class="divPass3JoursReduit">
                    <input type="checkbox" name="pass3joursReduit" id="pass3joursReduit">
                    <label for="pass3joursReduit">Pass 3 jours, Tarif réduit : 65€</label>
                </div>

            </div>


            <p class="bouton" onclick="suivant(blocReservation, blocOptions)">Suivant</p>
            <div class="messageErreurReservation"></div>

        </div>
        <div id="options" class="blocFormulaire options">

            <h2 class="text-2xl font-bold mb-10">Options</h2>
            <h3 class=" text-xl font-bold my-4">Réserver un emplacement de tente : </h3>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit1" name="tenteNuit1">
                <label for="tenteNuit1">Pour la nuit du 01/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit2" name="tenteNuit2">
                <label for="tenteNuit2">Pour la nuit du 02/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit3" name="tenteNuit3">
                <label for="tenteNuit3">Pour la nuit du 03/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tente3Nuits" name="tente3Nuits">
                <label for="tente3Nuits">Pour les 3 nuits (12€)</label>
            </div>

            <h3 class="text-xl font-bold my-4">Réserver un emplacement de camion aménagé : </h3>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit1" name="vanNuit1">
                <label for="vanNuit1">Pour la nuit du 01/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit2" name="vanNuit2">
                <label for="vanNuit2">Pour la nuit du 02/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit3" name="vanNuit3">
                <label for="vanNuit3">Pour la nuit du 03/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="van3Nuits" name="van3Nuits">
                <label for="van3Nuits">Pour les 3 nuits (12€)</label>
            </div>

            <h3 class="text-xl font-bold my-4">Venez-vous avec des enfants ?</h3>
            <div class="divenfants">
                <input type="checkbox" name="enfantsOui"><label for="enfantsOui">Oui</label>
            </div>
            <div class="divenfants">
                <input type="checkbox" name="enfantsNon"><label for="enfantsNon">Non</label>
            </div>


            <!-- Si oui, afficher : -->
            <section class="casqueEnfant tarifHidden">
                <h4 class="text-lg font-bold my-4">Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
                <label for="NombreCasque_reservation">Nombre de casques souhaités :</label>
                <input type="number" name="NombreCasque_reservation" id="NombreCasque_reservation" min="0" class="border-2 border-gray-800">
                <p>*Dans la limite des stocks disponibles.</p>
                <div class="messageErreurCasques"></div>
            </section>

            <h3 class="text-xl font-bold my-4">Profitez de descentes en luge d'été à tarifs avantageux !</h3>

            <div class="divluge">
                <label for="NombreLuge_reservation">Nombre de descentes en luge d'été (5€/descentes) :</label>
                <input type="number" name="NombreLuge_reservation" id="NombreLuge_reservation" min="0" class="border-2 border-gray-800">
                <div class="messageErreurLuge"></div>
            </div>

            <div class="flex items-start my-6">
                <input type="checkbox" name="RGPD" id="RGPD" require>
                <label for="RGPD">Mentions légales RGPD : J'autorise ce site à conserver mes données transmises via ce formulaire</label>

            </div>

            <p class="bouton" onclick="precedent(blocOptions, blocReservation)">Précédent</p>

            <button type="submit" name="soumission" class="bouton">Réserver</button>
        </div>

    </form>
</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="./asset/scriptForm.js"></script>

</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Create Reservation</h1>
        <form action="#" method="post" name="create_reservation">
            <div class="mb-4">
                <label for="Nombre_reservation" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                <input type="number" name="Nombre_reservation" id="Nombre_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="Enfants_reservation" class="block text-gray-700 font-bold mb-2">Enfants:</label>
                <input type="number" name="Enfants_reservation" id="Enfants_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="NombreCasque_reservation" class="block text-gray-700 font-bold mb-2">Nombre Casques:</label>
                <input type="number" name="NombreCasque_reservation" id="NombreCasque_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="NombreLuge_reservation" class="block text-gray-700 font-bold mb-2">Nombre Luges:</label>
                <input type="number" name="NombreLuge_reservation" id="NombreLuge_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
            </div>
            
            <div class="mb-4">
                <label for="Nuit_reservation" class="block text-gray-700 font-bold mb-2">Nuit:</label>
                <select name="Nuit_reservation" id="Nuit_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
                    <? php // foreach ($nuitOptions as $nuit): 
                    ?>
                        <option value="<? php // echo $nuit->getId_nuit(); 
                                        ?>"><?php //echo $nuit->getType_nuit(); 
                                            ?></option>
                    <? php // endforeach; 
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="Pass_reservation" class="block text-gray-700 font-bold mb-2">Pass:</label>
                <select name="Pass_reservation" id="Pass_reservation" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
                    <? php // foreach ($passOptions as $pass): 
                    ?>
                        <option value="<? php // echo $pass->getId_pass(); 
                                        ?>"><?php //echo $pass->getPass_pass(); 
                                            ?></option>
                    <? php // endforeach; 
                    ?>
                </select>
            </div>
            <button name="create_reservation" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Reservation</button>
        </form>
    </div>
</body>
</html> -->