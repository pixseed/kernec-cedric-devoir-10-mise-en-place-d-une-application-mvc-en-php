/**
 * Initialise la fermeture automatique des messages flash.
 * ---------------------------------------------------------------------------- 
 */
function initFlash() {
  const flashMessage = document.getElementById("flash-message");

  if (!flashMessage) {
    return;
  }

  const flashContainer = flashMessage.closest(".container");

  // Supprime le container une fois l'alerte fermée.
  flashMessage.addEventListener("closed.bs.alert", () => {
    flashContainer?.remove();
  });

  const alert = bootstrap.Alert.getOrCreateInstance(flashMessage);

  setTimeout(() => {
    alert.close();
  }, 5000);
}

/**
 * Initialise la modale affichant les détails d'un trajet.
 * ---------------------------------------------------------------------------- 
 */
function initTripModal() {
  const buttons = document.querySelectorAll("[data-url]");
  const modalElement = document.getElementById("tripDetailsModal");

  if (!modalElement) {
    return;
  }

  const modal = new bootstrap.Modal(modalElement);

  // Associe un événement à chaque bouton de suppression.
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // Récupère les données du trajet puis met à jour la modale.
      fetch(button.dataset.url)
        .then((response) => response.json())
        .then((trip) => {
          document.getElementById("tripAuthor").textContent = trip.author;
          document.getElementById("tripPhone").textContent = trip.phone;
          document.getElementById("tripEmail").textContent = trip.email;
          document.getElementById("tripNumberSeats").textContent =
            trip.numberSeats;

          modal.show();
        })
        .catch((error) => {
          console.error(
            "Erreur lors de la récupération des détails du trajet :",
            error,
          );
        });
    });
  });
}

/**
 * Initialise la modale de confirmation de suppression d'un trajet.
 */
function initDeleteTripModal() {
  const buttons = document.querySelectorAll("[data-delete-trip]");
  const modalElement = document.getElementById("deleteTripModal");
  const form = document.getElementById("delete-trip-form");

  if (!modalElement || !form) {
    return;
  }

  const departure = document.getElementById("delete-trip-departure");
  const startDate = document.getElementById("delete-trip-start-date");
  const startHour = document.getElementById("delete-trip-start-hour");
  const arrival = document.getElementById("delete-trip-arrival");
  const endDate = document.getElementById("delete-trip-end-date");
  const endHour = document.getElementById("delete-trip-end-hour");

  const modal = new bootstrap.Modal(modalElement);

  // Associe un événement à chaque bouton de suppression.
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      form.action = button.dataset.action;

      // Définit le contenu variable dans la modale.
      departure.textContent = button.dataset.departure;
      startDate.textContent = button.dataset.startDate;
      startHour.textContent = button.dataset.startHour;

      arrival.textContent = button.dataset.arrival;
      endDate.textContent = button.dataset.endDate;
      endHour.textContent = button.dataset.endHour;

      modal.show();
    });
  });
}

/**
 * Initialise la modale de confirmation de suppression d'une agence.
 */
function initDeleteAgencyModal() {
  const buttons = document.querySelectorAll("[data-delete-agency]");
  const modalElement = document.getElementById("deleteAgencyModal");
  const form = document.getElementById("delete-agency-form");
  const agencyName = document.getElementById("delete-agency-name");

  if (!modalElement || !form || !agencyName) {
    return;
  }

  const modal = new bootstrap.Modal(modalElement);

  // Associe un événement à chaque bouton de suppression.
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      form.action = button.dataset.action;

      // Définit le contenu variable dans la modale.
      agencyName.textContent = button.dataset.name;

      modal.show();
    });
  });
}

// ==========================================================================
// Initialisation des fonctionnalités
// ==========================================================================

initFlash();
initTripModal();
initDeleteAgencyModal();
initDeleteTripModal();