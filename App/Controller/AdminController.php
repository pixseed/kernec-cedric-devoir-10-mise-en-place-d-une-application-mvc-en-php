<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\AgencyModel;
use App\Model\TripModel;
use App\Model\UserModel;

class AdminController extends AbstractController
{
  /**
   * Affiche le tableau de bord d'administration.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->requireRole("admin");

    // Récupération du nombre total d'utilisateurs.
    $userModel = new UserModel();
    $numberUsers = $userModel->countAll();
    
    // Récupération du nombre total d'agences.
    $agencyModel = new AgencyModel();
    $numberAgencies = $agencyModel->countAll();
    
    // Récupération du nombre total de trajets.
    $tripModel = new TripModel();
    $numberTrips = $tripModel->countAll();

    $this->render("admin/index.php", [
      "numberUsers" => $numberUsers,
      "numberAgencies" => $numberAgencies,
      "numberTrips" => $numberTrips,
    ]);
  }
}