<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\TripModel;
use App\Model\AgencyModel;
use App\Validators\TripValidator;
use Exception;

class TripController extends AbstractController
{
  /**
   * Affiche la liste des trajets.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->requireRole("admin");
    $this->render("trip/index.php");
  }

  /**
   * Affiche les détails d'un trajet.
   * ---------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   */
  public function show(int $id): void
  {
    $tripModel = new TripModel();

    $trip = $tripModel->findDetailsById($id);

    header("Content-Type: application/json");

    echo json_encode($trip);
  }

  /**
   * Affiche le formulaire de création de trajet.
   * ----------------------------------------------------------------------------
   */
  public function create(): void
  {
    $this->requireAuthentication();

    // Récupération des trajets
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->getAll();

    $this->render("trip/create.php", [
      "agencies" => $agencies,
    ]);
  }

  /**
   * Traite le formulaire de création de trajet.
   * ----------------------------------------------------------------------------
   */
  public function store(): void
  {
    $this->requireAuthentication();

    // Récupération des données du formulaire.
    $data = $this->getTripFormData();

    // Validation des données.
    $tripValidator = new TripValidator();
    $errors = $tripValidator->validate($data);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderTripForm("trip/create.php",
        $data,
        $errors,
      );

      return;
    }

    // Insertion des données dans la base.
    $tripModel = new TripModel();
    $tripModel->insert($data);

    $this->setFlash(
      "success",
      "Le trajet a été créé avec succès."
    );

    $this->redirect("/");
  }

  /**
   * Affiche le formulaire d'édition de trajet.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   */
  public function edit(int $id): void
  {
    $this->requireAuthentication();

    // Vérifie que le trajet appartient à l'utilisateur connecté.
    try {
      $trip = $this->getOwnedTrip($id);
    } catch (Exception $e) {
      $this->setFlash(
        "danger",
        $e->getMessage()
      );

      $this->redirect("/");
      return;
    }

    // Récupération des agences.
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->getAll();

    $this->render("trip/edit.php", [
      "data" => $trip,
      "agencies" => $agencies,
    ]);
  }

  /**
   * Traite le formulaire d'édition de trajet.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   */
  public function update(int $id): void
  {
    $this->requireAuthentication();

    // Vérifie que le trajet appartient à l'utilisateur connecté.
    $this->getOwnedTrip($id);

    // Récupération des données du formulaire.
    $data = $this->getTripFormData();

    // Nécessaire pour garder le formulaire en mode édition (côté vue)
    // après une erreur de validation.
    $data["idTrip"] = $id;

    // Validation des données.
    $tripValidator = new TripValidator();
    $errors = $tripValidator->validate($data);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderTripForm("trip/edit.php",
        $data,
        $errors,
      );

      return;
    }

    // Mise à jour des données dans la base.
    $tripModel = new TripModel();
    $tripModel->update($id, $data);

    $this->setFlash(
      "success",
      "Le trajet a été modifié avec succès."
    );

    $this->redirect("/");
  }

  /**
   * Traite le formulaire de suppression de trajet.
   * ----------------------------------------------------------------------------
   */
  public function delete(): void
  {
    $this->requireAuthentication();
    echo "<p>Trajet en cours de suppression...</p>";
  }

  /**
   * Récupère un trajet appartenant à l'utilisateur connecté.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   * @return array ─ Données du trajet
   */
  private function getOwnedTrip(int $id): array
  {
    // Récupération du trajet.
    $tripModel = new TripModel();
    $trip = $tripModel->findById($id);

    // Vérifie que le trajet existe.
    if (!$trip) {
      throw new Exception("Le trajet demandé est introuvable.");
    }

    // Vérifier que le trajet appartient à l'utilisateur connecté.
    if (!$trip["idUser"] !== $_SESSION["user_id"]) {
      throw new Exception("Vous n'êtes pas autorisé à modifier ce trajet.");
    }

    return $trip;
  }

  /**
   * Récupère et normalise les données du formulaire de trajet.
   * ----------------------------------------------------------------------------
   */
  private function getTripFormData(): array
  {
    return [
      "startDate"       => trim($_POST["startDate"] ?? ""),
      "startHour"       => trim($_POST["startHour"] ?? ""),
      "idStartAgency"   => (int) ($_POST["idStartAgency"] ?? 0),
      "endDate"         => trim($_POST["endDate"] ?? ""),
      "endHour"         => trim($_POST["endHour"] ?? ""),
      "idEndAgency"     => (int) ($_POST["idEndAgency"] ?? 0),
      "numberSeats"     => (int) ($_POST["numberSeats"] ?? 0),
      "availableSeats"  => (int) ($_POST["numberSeats"] ?? 0),
      "idUser"          => (int) ($_SESSION["user_id"])
    ];
  }

  /**
   * Réaffiche le formulaire de trajet avec les données et les erreurs.
   * ----------------------------------------------------------------------------
   * @param string $view ─ Url de la vue à afficher
   * @param array $data ─ Tableau des données à afficher
   * @param array $errors ─ Tableau des erreurs à retourner
   */
  private function renderTripForm(
    string $view,
    array $data,
    array $errors
  ): void
  {
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->getAll();
    
    $this->render($view, [
      "agencies" => $agencies,
      "data" => $data,
      "errors" => $errors,
    ]);
  }
}
