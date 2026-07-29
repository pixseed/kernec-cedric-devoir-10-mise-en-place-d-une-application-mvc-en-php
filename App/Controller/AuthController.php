<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;

class AuthController extends AbstractController
{
  /**
   * Affiche le formulaire de connexion.
   */
  public function index(): void
  {
    $this->render("auth/index.php");
  }

  /**
   * Traite le formulaire de connexion.
   */
  public function login():void
  {
    echo "Connexion...";
  }
}
