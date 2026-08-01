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

// ==========================================================================
// Initialisation des fonctionnalités
// ==========================================================================

initFlash();