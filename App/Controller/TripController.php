<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\TripModel;
use App\Model\AgencyModel;
use App\Model\UserModel;
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

    // Récupération de la liste des trajets triés par date et heure et de départ.
    $tripModel = new TripModel();
    $trips = $tripModel->findAll();
    
    $this->render("trip/index.php", [
      "bodyClass" => "app-body--fixed",
      "trips" => $trips
    ]);
  }

  /**
   * Affiche les détails d'un trajet.
   * ---------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   */
  public function show(int $id): void
  {
    $this->requireAuthentication();

    // Récupération des données du trajet.
    $tripModel = new TripModel();
    $trip = $tripModel->findDetailsById($id);

    // Envoie des données du trajet au format JSON
    // afin qu'elles puissent être exploitées par JavaScript.
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

    // Récupération des informations de l'utilisateur connecté.
    $userModel = new UserModel();
    $user = $userModel->findById((int) $_SESSION["user_id"]);

    // Récupération des agences.
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->findAll();

    $this->render("trip/create.php", [
      "user"      => $user,
      "agencies"  => $agencies,
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

    // Initialisation du nombre de places disponibles à la création du trajet.
    $data["availableSeats"] = $data["numberSeats"];

    // Récupération de l'identifiant de l'utilisateur.
    $data["idUser"] = (int) $_SESSION["user_id"];

    // Validation des données.
    $tripValidator = new TripValidator();
    $errors = $tripValidator->validate($data);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderTripForm("trip/create.php",
        $data,
        $errors,
        (int) $_SESSION["user_id"]
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

    $this->redirectAfterTripAction();
  }

  /**
   * Affiche le formulaire d'édition de trajet.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   */
  public function edit(int $id): void
  {
    $this->requireAuthentication();

    // Vérification d'autorisation de gestion du trajet par l'utilisateur.
    try {
      $trip = $this->getAuthorizedTrip($id);
    } catch (Exception $e) {
      $this->setFlash(
        "danger",
        $e->getMessage()
      );

      $this->redirect("/");
      return;
    }

    // Récupération des données de l'auteur du trajet.
    $userModel = new UserModel();
    $user = $userModel->findById((int) $trip["idUser"]);

    // Récupération des agences.
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->findAll();

    $this->render("trip/edit.php", [
      "user"      => $user,
      "data"      => $trip,
      "agencies"  => $agencies,
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

    // Vérification d'autorisation de gestion du trajet par l'utilisateur.
    $trip = $this->getAuthorizedTrip($id);

    // Récupération des données du formulaire.
    $data = $this->getTripFormData();

    // Détermination du nombre de places déjà réservées.
    $reservedSeats = $trip["numberSeats"] - $trip["availableSeats"];

    // Conservation de l'identifiant : Nécessaire pour garder le formulaire
    // en mode édition (côté vue) après une erreur de validation.
    $data["idTrip"] = $id;

    // Validation des données.
    $tripValidator = new TripValidator();
    $errors = $tripValidator->validate($data, $reservedSeats);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderTripForm("trip/edit.php",
        $data,
        $errors,
        (int) $trip["idUser"]
      );

      return;
    }

    // Détermination du nouveau nombre de places disponibles.
    $data["availableSeats"] = $data["numberSeats"] - $reservedSeats;

    // Mise à jour des données dans la base.
    $tripModel = new TripModel();
    $tripModel->update($id, $data);

    $this->setFlash(
      "success",
      "Le trajet a été modifié avec succès."
    );

    $this->redirectAfterTripAction();
  }

  /**
   * Traite le formulaire de suppression de trajet.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   */
  public function delete(int $id): void
  {
    $this->requireAuthentication();

    // Vérification d'autorisation de gestion du trajet par l'utilisateur.
    try {
      $this->getAuthorizedTrip($id);
    } catch (Exception $e) {
      $this->setFlash(
        "danger",
        $e->getMessage()
      );

      $this->redirect("/");
      return;
    }

    // Suppression des données dans la base.
    $tripModel = new TripModel();
    $tripModel->delete($id);

    $this->setFlash(
      "success",
      "Le trajet a été supprimé avec succès."
    );

    $this->redirectAfterTripAction();
  }

  /**
   * Vérifie que le trajet peut être géré par l'utilisateur.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique du trajet
   * @return array ─ Données du trajet
   */
  private function getAuthorizedTrip(int $id): array
  {
    // Récupération du trajet.
    $tripModel = new TripModel();
    $trip = $tripModel->findById($id);

    // Vérifie que le trajet existe.
    if (!$trip) {
      throw new Exception("Le trajet demandé est introuvable.");
    }

    // Vérification que l'utilisateur peut gérer le trajet.
    $isOwner = $trip["idUser"] === $_SESSION["user_id"];
    $isAdmin = $_SESSION["role"] === "admin";

    if (!$isOwner && !$isAdmin) {
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
    ];
  }

  /**
   * Réaffiche le formulaire de trajet avec les données et les erreurs.
   * ----------------------------------------------------------------------------
   * @param string $view ─ Url de la vue à afficher
   * @param array $data ─ Tableau des données à afficher
   * @param array $errors ─ Tableau des erreurs à retourner
   * @param int $userId ─ Identifiant unique de l'utilisateur
   */
  private function renderTripForm(
    string $view,
    array $data,
    array $errors,
    int $userId
  ): void
  {
    $agencyModel = new AgencyModel();
    $agencies = $agencyModel->findAll();

    $userModel = new UserModel();
    $user = $userModel->findById($userId);
    
    $this->render($view, [
      "user"      => $user,
      "agencies"  => $agencies,
      "data"      => $data,
      "errors"    => $errors,
    ]);
  }

  /**
   * Redirige après une action vers une page en fonction du rôle de l'utilisateur.
   * ----------------------------------------------------------------------------
   */
  private function redirectAfterTripAction(): void
  {
    if ($_SESSION["role"] === "admin") {
      $this->redirect("/trips");
    }

    $this->redirect("/");
  }
}
