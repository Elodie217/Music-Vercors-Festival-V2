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
    <form action=".php" id="inscription" method="POST">
        <div id="reservation" class="blocFormulaire">

            <h2 class="text-2xl font-bold mb-10">Réservation</h2>
            <h3 class="text-xl font-bold my-4">Nombre de réservation(s) :</h3>
            <input type="number" name="nombrePlaces" id="NombrePlaces" min="1" class="border-2 border-gray-800" required>
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
                <label for="nombreCasquesEnfants">Nombre de casques souhaités :</label>
                <input type="number" name="nombreCasquesEnfants" id="nombreCasquesEnfants" min="0" class="border-2 border-gray-800">
                <p>*Dans la limite des stocks disponibles.</p>
                <div class="messageErreurCasques"></div>
            </section>

            <h3 class="text-xl font-bold my-4">Profitez de descentes en luge d'été à tarifs avantageux !</h3>

            <div class="divluge">
                <label for="NombreLugesEte">Nombre de descentes en luge d'été (5€/descentes) :</label>
                <input type="number" name="NombreLugesEte" id="NombreLugesEte" min="0" class="border-2 border-gray-800">
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
