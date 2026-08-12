<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\UserModel;

class UserController extends AbstractController
{
  /**
   * Affiche la liste des utilisateurs.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->requireRole("admin");

    // Récupération des utilisateurs triés par nom puis prénom.
    $userModel = new UserModel();
    $users = $userModel->findAll();

    $this->render("user/index.php", [
      "bodyClass" => "app-body--fixed",
      "users" => $users
    ]);
  }
}