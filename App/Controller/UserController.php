<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;

class UserController extends AbstractController
{
  /**
   * Affiche la liste des utilisateurs.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->requireRole("admin");
    $this->render("user/index.php");
  }
}