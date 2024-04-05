<?php
require_once "../init.php";

use App\Repositories\UserRepositories;

$userId = $_SESSION['user_id'] ?? null;

$userRepositorie = new UserRepositories();
$user = $userRepositorie->getUserbyId($userId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body class="relative bg-[url('./asset/medias/concert-852575_1920.jpg')] bg-cover bg-fixed bg-center">

    <div class=" flex justify-center items-center relative">
        <button onclick="affichageMessageSuppression()">
            <i class="fa-solid fa-trash absolute top-6 right-[35%] text-xl"></i>
        </button>

        <div class="divSupprimerUser absolute z-20 mx-[500px] w-96 top-[40vh] border-2 bg-[#dfdfdf] border-[#800080] rounded-2xl py-2 text-center p-4 hidden">
            <p class="mb-6 font-semibold text-xl">Voulez-vous supprimer ce compte ?</p>
            <div class="divBoutton">
            <button class="rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans bg-[#800080] hover:bg-[#808080] duration-300 mx-4" onclick="supprimerUser(<?= $userId?>)">Oui</button>
                <button class="rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans bg-[#800080] hover:bg-[#808080] duration-300 mx-4" onclick="retour()">Non</button>
            </div>
        </div>

        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form id="modificationProfilForm" class="divModificationProfil bg-white p-10 rounded-lg shadow-lg min-w-full">               
                 <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Modification profil</h1>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="nomModification">Nom</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="nomModification" id="nomModification" value="<?= $user->getNom_user() ?>" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="prenomModification">Prenom</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="prenomModification" id="prenomModification" value="<?= $user->getPrenom_user() ?>" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="emailModification">Email</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="emailModification" id="emailModification" value="<?= $user->getEmail_user() ?>" />
                </div>
                <div class="emailIncorrectModification text-red-700"></div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="telephoneModification">Téléphone</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="telephoneModification" id="telephoneModification" value="0<?= $user->getTelephone_user() ?>" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="adressePostaleModification">Adresse Postale</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="adressePostaleModification" id="adressePostaleModification" value="<?= $user->getAdressePostale_user() ?>" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="motDePasseModification">Mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="motDePasseModification" id="motDePasseModification" placeholder="Mot de passe" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="confirmationMotDePasseModification">Confirmation mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="confirmationMotDePasseModification" id="confirmationMotDePasseModification" placeholder="Confirmation du mot de passe" />
                </div>
                <div class="champVideMDPModification text-red-700"></div>
                <button type="submit" class="w-full mt-6 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans boutonModification bg-[#800080] hover:bg-[#808080] duration-300">Modifier</button>
               </form>

</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="./asset/modificationProfil.js"></script>
<script src="https://kit.fontawesome.com/97cd5da9a0.js" crossorigin="anonymous"></script>

</html>