<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;

class HomeController extends AbstractController
{
  /**
   * Affiche la page d'accueil.
   */
  public function index(): void
  {
    $this->render("home/index.php");
  }
}