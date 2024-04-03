const tarifreduitRadio = document.getElementById('tarifreduitRadio');
const passOptions = document.querySelectorAll('.divPass input[type="checkbox"]');
const passDates = document.querySelectorAll('.passDates');

function updatePassPricesAndDates() {
    passOptions.forEach(function (passOption) {
        const passPrice = passOption.nextElementSibling.querySelector('.passPrice');
        const passDatesSection = document.getElementById('passDates' + passOption.value);
        const reducedPassDatesSection = document.getElementById('reducedPassDates' + passOption.value);

        if (tarifreduitRadio.checked) {
            passPrice.textContent = passOption.getAttribute('data-reduced-price');
            passDatesSection.classList.add('hidden');
            reducedPassDatesSection.classList.remove('hidden');
        } else {
            passPrice.textContent = passOption.getAttribute('data-price');
            passDatesSection.classList.remove('hidden');
            reducedPassDatesSection.classList.add('hidden');
        }
    });
}

function updateSelectedPassDates() {
    passDates.forEach(function (passDate) {
        passDate.classList.add('hidden');
    });

    passOptions.forEach(function (passOption) {
        if (passOption.checked) {
            const selectedPassDates = document.getElementById('passDates' + passOption.value);
            const selectedReducedPassDates = document.getElementById('reducedPassDates' + passOption.value);

            if (tarifreduitRadio.checked) {
                selectedReducedPassDates.classList.remove('hidden');
            } else {
                selectedPassDates.classList.remove('hidden');
            }
        }
    });
}

passOptions.forEach(function (passOption) {
    passOption.addEventListener('change', function () {
        if (passOption.checked) {
            passOptions.forEach(function (otherPassOption) {
                if (otherPassOption !== passOption) {
                    otherPassOption.checked = false;
                }
            });
        }
        updateSelectedPassDates();
    });
});

passDates.forEach(function (passDate) {
    const passDateCheckboxes = passDate.querySelectorAll('input[type="checkbox"]');
    passDateCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                passDateCheckboxes.forEach(function (otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
});

tarifreduitRadio.addEventListener('change', function () {
    updatePassPricesAndDates();
    updateSelectedPassDates();
});



let blocReservation = document.querySelector("#reservation");
let blocOptions = document.querySelector("#options");

if (blocOptions) {
  blocOptions.classList.add("hidden");
}

let NombrePlaces = document.querySelector("#Nombre_reservation");

function isPassOptionSelected() {
  const passOptions = document.querySelectorAll('.divPass input[type="checkbox"]');

  for (let i = 0; i < passOptions.length; i++) {
    if (passOptions[i].checked) {
      return true;
    }
  }

  return false;
}
function isDateOptionSelected() {
  const dateOptions = document.querySelectorAll('.passDates input[type="checkbox"]');

  for (let i = 0; i < dateOptions.length; i++) {
    if (dateOptions[i].checked) {
      return true;
    }
  }

  return false;
}


/**
 * [Passer de la page Réservation à la page Option si le nombre de réservation est rentré et si une formule est cochée]
 *
 * @param   {[string]}  blocACacher    [Bloc A Cacher ]
 * @param   {[string]}  blocAAfficher  [Bloc A Afficher ]
 *
 */
function suivant(blocACacher, blocAAfficher) {
  if (NombrePlaces && NombrePlaces.value > 0) {
    if (isPassOptionSelected() && isDateOptionSelected()) {
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
  if (nombreCasquesEnfants && nombreCasquesEnfants.value < 0) {
    document.querySelector(".messageErreurCasques").innerText =
      "Merci d'indiquer le nombre de casque souhaité";
  } else if (NombreLugesEte && NombreLugesEte.value < 0) {
    document.querySelector(".messageErreurLuge").innerText =
      "Merci d'indiquer le nombre de descente souhaité";
  } else {
    blocACacher.classList.add("hidden");
    blocAAfficher.classList.remove("hidden");
  }
}

function precedent(blocACacher, blocAAfficher) {
  blocACacher.classList.add("hidden");
  blocAAfficher.classList.remove("hidden");
}

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

if (tenteNuit1) {
  tenteNuit1.addEventListener("change", () => {
    decocher(tenteNuit1, tenteTroisNuits);
    decocher3nuit("tente");
  });
}

if (tenteNuit2) {
  tenteNuit2.addEventListener("change", () => {
    decocher(tenteNuit2, tenteTroisNuits);
    decocher3nuit("tente");
  });
}

if (tenteNuit3) {
  tenteNuit3.addEventListener("change", () => {
    decocher(tenteNuit3, tenteTroisNuits);
    decocher3nuit("tente");
  });
}

if (tenteTroisNuits) {
  tenteTroisNuits.addEventListener("change", () => {
    decocher(tenteTroisNuits, tenteNuit1);
    decocher(tenteTroisNuits, tenteNuit2);
    decocher(tenteTroisNuits, tenteNuit3);
  });
}

if (vanNuit1) {
  vanNuit1.addEventListener("change", () => {
    decocher(vanNuit1, vanTroisNuits);
    decocher3nuit("van");
  });
}

if (vanNuit2) {
  vanNuit2.addEventListener("change", () => {
    decocher(vanNuit2, vanTroisNuits);
    decocher3nuit("van");
  });
}

if (vanNuit3) {
  vanNuit3.addEventListener("change", () => {
    decocher(vanNuit3, vanTroisNuits);
    decocher3nuit("van");
  });
}

if (vanTroisNuits) {
  vanTroisNuits.addEventListener("change", () => {
    decocher(vanTroisNuits, vanNuit1);
    decocher(vanTroisNuits, vanNuit2);
    decocher(vanTroisNuits, vanNuit3);
  });
}

if (enfantsOui && enfantsNon && casqueEnfant) {
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
}

/**
 * [Decocher : permet de décocher une proposition]
 *
 * @param   {[string]}  boutoncoche      [Bouton coché par la personne]
 * @param   {[string]}  boutonadechoche  [Bouton à dechoché car un autre est coché]
 */
function decocher(boutoncoche, boutonadechoche) {
  if (boutoncoche && boutonadechoche && boutoncoche.checked === true) {
    boutonadechoche.checked = false;
  }
}

function decocher3nuit(tenteouvan) {
  if (tenteouvan === "tente") {
    if (
      tenteNuit1 && tenteNuit2 && tenteNuit3 && tenteTroisNuits &&
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
      vanNuit1 && vanNuit2 && vanNuit3 && vanTroisNuits &&
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
