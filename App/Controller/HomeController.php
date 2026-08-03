<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\TripModel;

class HomeController extends AbstractController
{
  /**
   * Affiche la page d'accueil.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    // Récupération de la liste des trajets disponibles
    $tripModel = new TripModel();

    $trips = $tripModel->findAllAvailable();

    $this->render("home/index.php", [
      "trips" => $trips,
    ]);
  }
}