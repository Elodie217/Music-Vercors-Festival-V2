document.getElementById("modificationProfilForm").addEventListener("submit", function (event) {
    event.preventDefault();
    let nomModification = document.querySelector("#nomModification").value;
    let prenomModification = document.querySelector(
      "#prenomModification"
    ).value;
    let emailModification = document.querySelector("#emailModification").value;
    let telephoneModification = document.querySelector(
      "#telephoneModification"
    ).value;
    let adressePostaleModification = document.querySelector(
      "#adressePostaleModification"
    ).value;
    let motDePasseModification = document.querySelector(
      "#motDePasseModification"
    ).value;
    let confirmationMotDePasseModification = document.querySelector(
      "#confirmationMotDePasseModification"
    ).value;

    if (
      nomModification !== "" &&
      prenomModification !== "" &&
      emailModification !== "" &&
      telephoneModification !== "" &&
      adressePostaleModification !== "" &&
      motDePasseModification !== "" &&
      confirmationMotDePasseModification !== ""
    ) {
      document.querySelector(".champVideMDPModification").innerText = "";
      if (checkEmail(emailModification) == true) {
        document.querySelector(".emailIncorrectModification").innerText = "";
        if (
          motDePasseModification.length > 5 &&
          confirmationMotDePasseModification.length > 5
        ) {
          document.querySelector(".champVideMDPModification").innerText = "";
          if (motDePasseModification == confirmationMotDePasseModification) {
            document.querySelector(".champVideMDPModification").innerText = "";

            modificationProfil();
          } else {
            document.querySelector(
              ".champVideMDPModification"
            ).innerText = `Vos mots de passe sont différents.`;
            evenement.preventDefault();
          }
        } else {
          document.querySelector(
            ".champVideMDPModification"
          ).innerText = `Merci d'entrer au moins 6 caractères.`;
          evenement.preventDefault();
        }
      } else {
        document.querySelector(
          ".emailIncorrectModification"
        ).innerText = `Merci de mettre un email valide.`;
        evenement.preventDefault();
      }
    } else {
      document.querySelector(
        ".champVideMDPModification"
      ).innerText = `Merci de remplir tous les champs.`;
      evenement.preventDefault();
    }
  });

function modificationProfil(userId) {
  let nomModification = document.querySelector("#nomModification").value;
  let prenomModification = document.querySelector("#prenomModification").value;
  let emailModification = document.querySelector("#emailModification").value;
  let telephoneModification = document.querySelector(
    "#telephoneModification"
  ).value;
  let adressePostaleModification = document.querySelector(
    "#adressePostaleModification"
  ).value;
  let motDePasseModification = document.querySelector(
    "#motDePasseModification"
  ).value;
  let confirmationMotDePasseModification = document.querySelector(
    "#confirmationMotDePasseModification"
  ).value;

  let userInscription = {
    nomModification: nomModification,
    prenomModification: prenomModification,
    emailModification: emailModification,
    telephoneModification: telephoneModification,
    adressePostaleModification: adressePostaleModification,
    motDePasseModification: motDePasseModification,
    confirmationMotDePasseModification: confirmationMotDePasseModification,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(userInscription),
  };

  fetch(`/cours/Music-Vercors-Festival-V2-dev/profile/update/${userId}`, params)
        .then((res) => res.text())
        .then((data) => {
            if (data === "success") {
                window.location.href = `/cours/Music-Vercors-Festival-V2-dev/profile`;
            }
        });
}

function reussiteEchecInscription(reponse) {
  if (reponse == "success") {
    document.querySelector(".InscriptionReussite").classList.remove("hidden");
    setTimeout(() => {
      document.querySelector(".InscriptionReussite").classList.add("hidden");
    }, 4000);
  } else {
    document.querySelector(".champVideMDPInscription").innerText =
      "Email déjà utilisé";
  }
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

////////Supprimer User///////////

function affichageMessageSuppression() {
  document.querySelector(".divSupprimerUser").classList.remove("hidden");
}

function retour() {
  document.querySelector(".divSupprimerUser").classList.add("hidden");
}

function supprimerUser(userId) {
  let UserId = {
    userID: userId,
  };
  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(UserId),
  };

  fetch(`/cours/Music-Vercors-Festival-V2-dev/profile/delete/${userId}`, params)
  .then((res) => res.text())
  .then((data) => {
    if (data === "success") {
      window.location.href = "/cours/Music-Vercors-Festival-V2-dev/login";
    } else if (data === "Erreur") {
      console.error("Error w/deleting user ");
    } else {
      console.error("Error W/server:", data);
    }
  })
  .catch((error) => {
    console.error("Error w/deleting user :", error);
  });
}
