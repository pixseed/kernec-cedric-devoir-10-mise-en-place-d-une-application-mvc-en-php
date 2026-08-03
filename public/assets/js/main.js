function initFlash() {
  const flashMessage = document.getElementById("flash-message");

  if (!flashMessage) {
    return;
  }

  const flashContainer = flashMessage.closest(".container");

  flashMessage.addEventListener("closed.bs.alert", () => {
    flashContainer?.remove();
  });

  const alert = bootstrap.Alert.getOrCreateInstance(flashMessage);

  setTimeout(() => {
    alert.close();
  }, 5000);
}

function initTripModal() {
  const buttons = document.querySelectorAll("[data-url]");
  const modalElement = document.getElementById("tripDetailsModal");

  const modal = new bootstrap.Modal(modalElement);

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      
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
          console.error("Erreur lors de la récupération des détails du trajet :", error);
        });
    });
  });
}

// ==========================================================================
// Initialisation des fonctionnalités
// ==========================================================================

initFlash();
initTripModal();