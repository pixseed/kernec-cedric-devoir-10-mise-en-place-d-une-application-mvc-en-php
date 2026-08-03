<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\TripModel;

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
   * 
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
    $this->render("trip/create.php");
  }

  /**
   * Traite le formulaire de création de trajet.
   * ----------------------------------------------------------------------------
   */
  public function store(): void
  {
    $this->requireAuthentication();
    echo "<p>Trajet en cours de création...</p>";
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
