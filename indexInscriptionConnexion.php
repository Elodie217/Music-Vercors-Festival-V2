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
    <div class=" divAccueil w-[50%] mx-[25%] mt-52">
        <h1 class="text-white text-6xl mb-11 text-center" style="  font-family: 'Satisfy', cursive; ">Vercors Musique Festival</h1>
        <div class=" flex justify-between">
            <button class="rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold mx-14 bg-[#800080] hover:bg-[#808080] duration-300" onclick="redirection('divAccueil', 'divInscription')">Inscription</button>
            <button class="rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold mx-14 bg-[#800080] hover:bg-[#808080] duration-300" onclick="redirection('divAccueil', 'divConnexion')">Connexion</button>
        </div>
    </div>

    <div class=" flex justify-center items-center ">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <div class="divInscription bg-white p-10 rounded-lg shadow-lg min-w-full hidden">
                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Inscription</h1>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="nom">Nom</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="nom" id="nom" placeholder="Nom" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="prenom">Prenom</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="prenom" id="prenom" placeholder="Prenom" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="email">Email</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" id="email" placeholder="email@email" />
                </div>
                <div class="emailIncorrectInscription text-red-700"></div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="telephone">Téléphone</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="telephone" id="telephone" placeholder="06 01 23 45 67" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="adressePostale">Adresse Postale</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="adressePostale" id="adressePostale" placeholder="3 Rue Victor Hugo" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="motDePasse">Mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="motDePasse" id="motDePasse" placeholder="Mot de passe" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="confirmationMotDePasse">Confirmation mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="confirmationMotDePasse" id="confirmationMotDePasse" placeholder="Confirmation du mot de passe" />
                </div>
                <div class="champVideMDPInscription text-red-700"></div>
                <button class="w-full mt-6  rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans boutonInscription bg-[#800080] hover:bg-[#808080] duration-300">Inscritpion</button>
                <button type="submit" class="w-full mt-6 mb-3 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans bg-[#808080] hover:bg-[#800080] duration-300" onclick="redirection('divInscription', 'divConnexion')">Connexion</button>
            </div>

            <div class="divConnexion bg-white p-10 rounded-lg shadow-lg min-w-full my-24 hidden">
                <div class="InscriptionReussite text-lime-600 hidden my-2 text-center">Inscription réussite !</div>

                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Connexion</h1>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="emailConnexion">Email</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="emailConnexion" id="emailConnexion" placeholder="email@email" />
                </div>
                <div class="emailIncorrectConnexion text-red-700"></div>

                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="motDePasseConnexion">Mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="motDePasseConnexion" id="motDePasseConnexion" placeholder="Mot de passe" />
                </div>
                <div class="champVideConnexion text-red-700">

                </div>
                <div>
                    <button type="submit" class="bouttonConnexion w-full mt-6 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans bg-[#800080] hover:bg-[#808080] duration-300">Connexion</button>
                    <button type="submit" class="w-full mt-6 mb-3 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans bg-[#808080] hover:bg-[#800080] duration-300" onclick="redirection('divConnexion', 'divInscription')">Inscription</button>
                </div>
            </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="./scriptInscriptionConnexion.js"></script>

</html>