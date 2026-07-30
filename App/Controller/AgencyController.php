<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;

class AgencyController extends AbstractController
{
  /**
   * Affiche la liste des agences.
   */
  public function index(): void
  {
    $this->render("agency/index.php");
  }
}
