<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\TripModel;
use App\Model\AgencyModel;
use App\Validators\TripValidator;

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

    $trip = $tripModel->findById($id);

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
    $data = [
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

    // Validation des données.
    $tripValidator = new TripValidator();
    $errors = $tripValidator->validate($data);

    // Récupération des agences.
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->getAll();

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->render("trip/create.php", [
        "agencies" => $agencies,
        "errors" => $errors,
        "data" => $data,
      ]);

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
   */
  public function edit(): void
  {
    $this->requireAuthentication();
    $this->render("trip/edit.php");
  }

  /**
   * Traite le formulaire de modification de trajet.
   * ----------------------------------------------------------------------------
   */
  public function update(): void
  {
    $this->requireAuthentication();
    echo "<p>Trajet en cours de modification...</p>";
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
}
