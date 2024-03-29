let blocReservation = document.querySelector("#reservation");

let blocOptions = document.querySelector("#options");

blocOptions.classList.add("hidden");

let NombrePlaces = document.querySelector("#Nombre_reservation");

let choixJour1 = document.querySelector("#choixJour1");
let choixJour2 = document.querySelector("#choixJour2");
let choixJour3 = document.querySelector("#choixJour3");

let choixJour1Reduit = document.querySelector("#choixJour1Reduit");
let choixJour2Reduit = document.querySelector("#choixJour2Reduit");
let choixJour3Reduit = document.querySelector("#choixJour3Reduit");

let choixJour12 = document.querySelector("#choixJour12");
let choixJour23 = document.querySelector("#choixJour23");

let choixJour12Reduit = document.querySelector("#choixJour12Reduit");
let choixJour23Reduit = document.querySelector("#choixJour23Reduit");

let pass3Jour = document.querySelector("#pass3jours");
let pass3JourReduit = document.querySelector("#pass3joursReduit");

let pass1jourreduit = document.querySelector("#pass2joursDateReduit");
let pass2joursreduit = document.querySelector("#pass2joursDateReduit");
let pass3joursreduit = document.querySelector("#pass3joursreduit");

/**
 * [Passer de la page Réservation à la page Option si le nombre de réservation est rentré et si une formule est cochée]
 *
 * @param   {[string]}  blocACacher    [Bloc A Cacher ]
 * @param   {[string]}  blocAAfficher  [Bloc A Afficher ]
 *
 */
function suivant(blocACacher, blocAAfficher) {
  if (NombrePlaces.value > 0) {
    if (
      choixJour1.checked === true ||
      choixJour2.checked === true ||
      choixJour3.checked === true ||
      choixJour12.checked === true ||
      choixJour23.checked === true ||
      pass3jours.checked === true ||
      choixJour1Reduit.checked === true ||
      choixJour2Reduit.checked === true ||
      choixJour3Reduit.checked === true ||
      choixJour12Reduit.checked === true ||
      choixJour23Reduit.checked === true ||
      choixJour3Reduit.checked === true ||
      pass3joursReduit.checked === true
    ) {
      blocACacher.classList.add("hidden");
      blocAAfficher.classList.remove("hidden");
    } else {
      //Message erreur jour choisi
      document.querySelector(".messageErreurReservation").innerText =
        "Merci de choisir une formule";
    }
  } else {
    // Message erreur réservation
    document.querySelector(".messageErreurReservation").innerText =
      "Merci d'indiquer le nombre de réservation souhaité";
  }
}

let nombreCasquesEnfants = document.querySelector("#nombreCasquesEnfants");
let NombreLugesEte = document.querySelector("#NombreLugesEte");

function suivant2(blocACacher, blocAAfficher) {
  if (nombreCasquesEnfants.value < 0) {
    // Message erreur casque
    document.querySelector(".messageErreurCasques").innerText =
      "Merci d'indiquer le nombre de casque souhaité";
  } else if (NombreLugesEte.value < 0) {
    // Message erreur luge
    document.querySelector(".messageErreurLuge").innerText =
      "Merci d'indiquer le nombre de descente souhaité";
  } else {
    blocACacher.classList.add("hidden");
    blocAAfficher.classList.remove("hidden");
  }
}

// fin code Salome

// code Aubin

let tarifreduit = document.querySelector("#tarifreduitRadio");
let pass1Jour = document.querySelector("#pass1jour");
let pass2Jour = document.querySelector("#pass2jours");
let pass1JourReduit = document.querySelector("#pass1jourReduit");
let pass2JourReduit = document.querySelector("#pass2joursReduit");
let displayPass1Jour = document.querySelector("#pass1jourDate");
let displayPass2Jour = document.querySelector("#pass2joursDate");
let displayPass1JourReduit = document.querySelector("#pass1jourDateReduit");
let displayPass2JourReduit = document.querySelector("#pass2joursDateReduit");
let displayTarifReduit = document.querySelector("#tarifreduit");
let divPass1Jour = document.querySelector(".divPass1Jour");
let divPass2Jours = document.querySelector(".divPass2Jours");
let divPass3Jours = document.querySelector(".divPass3Jours");

tarifreduit.addEventListener("click", function () {
  if (tarifreduit.checked === true) {
    displayPass1Jour.classList.add("tarifHidden");
    displayPass2Jour.classList.add("tarifHidden");
    divPass1Jour.classList.add("tarifHidden");
    divPass2Jours.classList.add("tarifHidden");
    divPass3Jours.classList.add("tarifHidden");
    displayTarifReduit.classList.remove("tarifHidden");

    decocher(tarifreduit, pass3jours);

    decocher(tarifreduit, pass1jour);
    decocher(tarifreduit, choixJour1);
    decocher(tarifreduit, choixJour2);
    decocher(tarifreduit, choixJour3);
    decocher(tarifreduit, pass2jours);
    decocher(tarifreduit, choixJour12);
    decocher(tarifreduit, choixJour23);
  } else {
    divPass1Jour.classList.remove("tarifHidden");
    divPass2Jours.classList.remove("tarifHidden");
    divPass3Jours.classList.remove("tarifHidden");
    displayTarifReduit.classList.add("tarifHidden");

    decocher(pass1jour, pass3joursReduit);
    decocher(pass1jour, pass1JourReduit);
    decocher(pass1jour, choixJour1Reduit);
    decocher(pass1jour, choixJour2Reduit);
    decocher(pass1jour, choixJour3Reduit);
    decocher(pass1jour, pass2JourReduit);
    decocher(pass1jour, choixJour12Reduit);
    decocher(pass1jour, choixJour23Reduit);
  }
});
pass1Jour.addEventListener("click", function () {
  displayTarifReduit.classList.add("tarifHidden");
  displayPass2Jour.classList.add("tarifHidden");
  displayPass1Jour.classList.remove("tarifHidden");
});
pass2Jour.addEventListener("click", function () {
  displayTarifReduit.classList.add("tarifHidden");
  displayPass1Jour.classList.add("tarifHidden");
  displayPass2Jour.classList.remove("tarifHidden");
});
pass3Jour.addEventListener("click", function () {
  displayPass1Jour.classList.add("tarifHidden");
  displayPass2Jour.classList.add("tarifHidden");
});

pass1JourReduit.addEventListener("click", function () {
  displayPass2JourReduit.classList.add("tarifHidden");
  displayPass1JourReduit.classList.remove("tarifHidden");
});
pass2JourReduit.addEventListener("click", function () {
  displayPass1JourReduit.classList.add("tarifHidden");
  displayPass2JourReduit.classList.remove("tarifHidden");
});
pass3JourReduit.addEventListener("click", function () {
  displayPass1Jour.classList.add("tarifHidden");
  displayPass2Jour.classList.add("tarifHidden");
});

function precedent(blocACacher, blocAAfficher) {
  blocACacher.classList.add("hidden");
  blocAAfficher.classList.remove("hidden");
}
// fin code Aubin

// début code Elodie

//Réservation
let pass1jour = document.querySelector("#pass1jour");
let pass2jours = document.querySelector("#pass2jours");
let pass3jours = document.querySelector("#pass3jours");
let pass3joursReduit = document.querySelector("#pass3joursReduit");

pass1jour.addEventListener("change", () => {
  decocher(pass1jour, pass2jours);
  decocher(pass1jour, choixJour12);
  decocher(pass1jour, choixJour23);
  decocher(pass1jour, pass3jours);
});
pass2jours.addEventListener("change", () => {
  decocher(pass2jours, pass1jour);
  decocher(pass2jours, choixJour1);
  decocher(pass2jours, choixJour2);
  decocher(pass2jours, choixJour3);
  decocher(pass2jours, pass3jours);
});
pass3jours.addEventListener("change", () => {
  decocher(pass3jours, pass1jour);
  decocher(pass3jours, choixJour1);
  decocher(pass3jours, choixJour2);
  decocher(pass3jours, choixJour3);
  decocher(pass3jours, pass2jours);
  decocher(pass3jours, choixJour12);
  decocher(pass3jours, choixJour23);
});

choixJour1.addEventListener("change", () => {
  decocher(choixJour1, choixJour2);
  decocher(choixJour1, choixJour3);
});
choixJour2.addEventListener("change", () => {
  decocher(choixJour2, choixJour1);
  decocher(choixJour2, choixJour3);
});
choixJour3.addEventListener("change", () => {
  decocher(choixJour3, choixJour1);
  decocher(choixJour3, choixJour2);
});

choixJour12.addEventListener("change", () => {
  decocher(choixJour12, choixJour23);
});
choixJour23.addEventListener("change", () => {
  decocher(choixJour23, choixJour12);
});

//Reuduit

pass1JourReduit.addEventListener("change", () => {
  decocher(pass1JourReduit, pass2JourReduit);
  decocher(pass1JourReduit, choixJour12Reduit);
  decocher(pass1JourReduit, choixJour23Reduit);
  decocher(pass1JourReduit, pass3joursReduit);
});
pass2JourReduit.addEventListener("change", () => {
  decocher(pass2JourReduit, pass1JourReduit);
  decocher(pass2JourReduit, choixJour1Reduit);
  decocher(pass2JourReduit, choixJour2Reduit);
  decocher(pass2JourReduit, choixJour3Reduit);
  decocher(pass2JourReduit, pass3joursReduit);
});
pass3joursReduit.addEventListener("change", () => {
  decocher(pass3joursReduit, pass2JourReduit);
  decocher(pass3joursReduit, pass1JourReduit);
  decocher(pass3joursReduit, choixJour1Reduit);
  decocher(pass3joursReduit, choixJour2Reduit);
  decocher(pass3joursReduit, choixJour3Reduit);
  decocher(pass3joursReduit, choixJour12Reduit);
  decocher(pass3joursReduit, choixJour23Reduit);
});

choixJour1Reduit.addEventListener("change", () => {
  decocher(choixJour1Reduit, choixJour2Reduit);
  decocher(choixJour1Reduit, choixJour3Reduit);
});
choixJour2Reduit.addEventListener("change", () => {
  decocher(choixJour2Reduit, choixJour1Reduit);
  decocher(choixJour2Reduit, choixJour3Reduit);
});
choixJour3Reduit.addEventListener("change", () => {
  decocher(choixJour3Reduit, choixJour1Reduit);
  decocher(choixJour3Reduit, choixJour2Reduit);
});

choixJour12Reduit.addEventListener("change", () => {
  decocher(choixJour12Reduit, choixJour23Reduit);
});
choixJour23Reduit.addEventListener("change", () => {
  decocher(choixJour23Reduit, choixJour12Reduit);
});

//Option
let tenteNuit1 = document.querySelector("#tenteNuit1");
let tenteNuit2 = document.querySelector("#tenteNuit2");
let tenteNuit3 = document.querySelector("#tenteNuit3");
let tenteTroisNuits = document.querySelector("#tente3Nuits");

let vanNuit1 = document.querySelector("#vanNuit1");
let vanNuit2 = document.querySelector("#vanNuit2");
let vanNuit3 = document.querySelector("#vanNuit3");
let vanTroisNuits = document.querySelector("#van3Nuits");

let enfantsOui = document.querySelector("input[name=enfantsOui]");
let enfantsNon = document.querySelector("input[name=enfantsNon]");
let casqueEnfant = document.querySelector(".casqueEnfant");

tenteNuit1.addEventListener("change", () => {
  decocher(tenteNuit1, tenteTroisNuits);
  decocher3nuit("tente");
});
tenteNuit2.addEventListener("change", () => {
  decocher(tenteNuit2, tenteTroisNuits);
  decocher3nuit("tente");
});
tenteNuit3.addEventListener("change", () => {
  decocher(tenteNuit3, tenteTroisNuits);
  decocher3nuit("tente");
});
tenteTroisNuits.addEventListener("change", () => {
  decocher(tenteTroisNuits, tenteNuit1);
  decocher(tenteTroisNuits, tenteNuit2);
  decocher(tenteTroisNuits, tenteNuit3);
});

vanNuit1.addEventListener("change", () => {
  decocher(vanNuit1, vanTroisNuits);
  decocher3nuit("van");
});
vanNuit2.addEventListener("change", () => {
  decocher(vanNuit2, vanTroisNuits);
  decocher3nuit("van");
});
vanNuit3.addEventListener("change", () => {
  decocher(vanNuit3, vanTroisNuits);
  decocher3nuit("van");
});
vanTroisNuits.addEventListener("change", () => {
  decocher(vanTroisNuits, vanNuit1);
  decocher(vanTroisNuits, vanNuit2);
  decocher(vanTroisNuits, vanNuit3);
});

enfantsOui.addEventListener("change", () => {
  decocher(enfantsOui, enfantsNon);
  if (enfantsOui.checked === true) {
    casqueEnfant.classList.remove("tarifHidden");
  } else {
    casqueEnfant.classList.add("tarifHidden");
  }
});
enfantsNon.addEventListener("change", () => {
  decocher(enfantsNon, enfantsOui);
  if (enfantsNon.checked === true) {
    casqueEnfant.classList.add("tarifHidden");
  }
});

/**
 * [Decocher : permet de décocher une proposition]
 *
 * @param   {[string]}  boutoncoche      [Bouton coché par la personne]
 * @param   {[string]}  boutonadechoche  [Bouton à dechoché car un autre est coché]
 */
function decocher(boutoncoche, boutonadechoche) {
  if (boutoncoche.checked === true) {
    boutonadechoche.checked = false;
  }
}

function decocher3nuit(tenteouvan) {
  if (tenteouvan === "tente") {
    if (
      tenteNuit1.checked === true &&
      tenteNuit2.checked === true &&
      tenteNuit3.checked === true
    ) {
      tenteNuit1.checked = false;
      tenteNuit2.checked = false;
      tenteNuit3.checked = false;
      tenteTroisNuits.checked = true;
    }
  }
  if (tenteouvan === "van") {
    if (
      vanNuit1.checked === true &&
      vanNuit2.checked === true &&
      vanNuit3.checked === true
    ) {
      vanNuit1.checked = false;
      vanNuit2.checked = false;
      vanNuit3.checked = false;
      vanTroisNuits.checked = true;
    }
  }
}

// fin code Elodie
