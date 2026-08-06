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

  const modal = new bootstrap.Modal(modalElement);

  // Associe un événement à chaque bouton de suppression.
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // Récupère les données du trajet puis met à jour la modale.
      const url = button.dataset.url;

      fetch(url)
        .then((response) => response.json())
        .then((trip) => {
          document.getElementById("tripAuthor").textContent = trip.author;
          document.getElementById("tripPhone").textContent = trip.phone;
          document.getElementById("tripEmail").textContent = trip.email;
          document.getElementById("tripNumberSeats").textContent = trip.numberSeats;

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
function initDeleteModal() {
  const buttons = document.querySelectorAll("[data-action]");
  const modalElement = document.getElementById("deleteTripModal");
  const form = document.getElementById("delete-trip-form");

  const modal = new bootstrap.Modal(modalElement);

  // Associe un événement à chaque bouton de suppression.
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // Définit l'action du formulaire selon le trajet sélectionné.
      const action = button.dataset.action;
      form.action = action;

      modal.show();
    });
  });
}

// ==========================================================================
// Initialisation des fonctionnalités
// ==========================================================================

initFlash();
initTripModal();
initDeleteModal();