//////////////////Inscription //////////////////

document
  .querySelector(".boutonInscription")
  .addEventListener("click", function (evenement) {
    let nom = document.querySelector("#nom").value;
    let prenom = document.querySelector("#prenom").value;
    let email = document.querySelector("#email").value;
    let telephone = document.querySelector("#telephone").value;
    let adressePostale = document.querySelector("#adressePostale").value;
    let motDePasse = document.querySelector("#motDePasse").value;
    let confirmationMotDePasse = document.querySelector(
      "#confirmationMotDePasse"
    ).value;
    if (
      nom !== "" &&
      prenom !== "" &&
      email !== "" &&
      telephone !== "" &&
      adressePostale !== "" &&
      motDePasse !== "" &&
      confirmationMotDePasse !== ""
    ) {
      document.querySelector(".champVideMDPInscription").innerText = "";
      if (checkEmail(email) == true) {
        document.querySelector(".emailIncorrectInscription").innerText = "";
        if (motDePasse.length > 5 && confirmationMotDePasse.length > 5) {
          document.querySelector(".champVideMDPInscription").innerText = "";
          if (motDePasse == confirmationMotDePasse) {
            document.querySelector(".champVideMDPInscription").innerText = "";

            inscription();
          } else {
            document.querySelector(
              ".champVideMDPInscription"
            ).innerText = `Vos mots de passe sont différents.`;
            evenement.preventDefault();
          }
        } else {
          document.querySelector(
            ".champVideMDPInscription"
          ).innerText = `Merci d'entrer au moins 6 caractères.`;
          evenement.preventDefault();
        }
      } else {
        document.querySelector(
          ".emailIncorrectInscription"
        ).innerText = `Merci de mettre un email valide.`;
        evenement.preventDefault();
      }
    } else {
      document.querySelector(
        ".champVideMDPInscription"
      ).innerText = `Merci de remplir tous les champs.`;
      evenement.preventDefault();
    }
  });

function inscription() {
  let nom = document.querySelector("#nom").value;
  let prenom = document.querySelector("#prenom").value;
  let email = document.querySelector("#email").value;
  let telephone = document.querySelector("#telephone").value;
  let adressePostale = document.querySelector("#adressePostale").value;
  let motDePasse = document.querySelector("#motDePasse").value;
  let confirmationMotDePasse = document.querySelector(
    "#confirmationMotDePasse"
  ).value;

  let userInscription = {
    nom: nom,
    prenom: prenom,
    email: email,
    telephone: telephone,
    adressePostale: adressePostale,
    motDePasse: motDePasse,
    confirmationMotDePasse: confirmationMotDePasse,
  };
  console.log(userInscription);

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(userInscription),
  };

  fetch("./inscription.php", params)
    .then((res) => res.text())
    .then((data) => console.log(data));
}

/**
 * Vérification Email
 *
 * @param   {[string]}  email  Email à vérifier
 *
 * @return  {[boolean]}
 */
function checkEmail(email) {
  let re =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
