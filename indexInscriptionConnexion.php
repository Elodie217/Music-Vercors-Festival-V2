<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class=" bg-indigo-100 flex justify-center items-center">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <div class="bg-white p-10 rounded-lg shadow-lg min-w-full">
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
                <div class="emailIncorrectInscription"></div>
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
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="motDePasse" id="motDePasse" placeholder="Mot de passe" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="confirmationMotDePasse">Confirmation mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="confirmationMotDePasse" id="confirmationMotDePasse" placeholder="confirmation mot de passe password" />
                </div>
                <div class="champVideMDPInscription"></div>
                <button class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans boutonInscription">Inscritpion</button>
                <button type="submit" class="w-full mt-6 mb-3 bg-indigo-100 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Connexion</button>
            </div>

            <form class="bg-white p-10 rounded-lg shadow-lg min-w-full">
                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Connexion</h1>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="email">Email</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" id="email" placeholder="email@email" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="motDePasseConnexion">Mot de passe</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="motDePasseConnexion" id="motDePasseConnexion" placeholder="Mot de passe" />
                </div>
                <button type="submit" class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Connexion</button>
                <button type="submit" class="w-full mt-6 mb-3 bg-indigo-100 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Inscription</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="./scriptInscriptionConnexion.js"></script>

</html>