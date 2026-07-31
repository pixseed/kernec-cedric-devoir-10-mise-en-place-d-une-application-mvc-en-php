<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\UserModel;

class AuthController extends AbstractController
{
  /**
   * Affiche le formulaire de connexion.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->render("auth/login.php");
  }

  /**
   * Traite le formulaire de connexion.
   * ----------------------------------------------------------------------------
   */
  public function login():void
  {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    $userModel = new UserModel();

    $user = $userModel->findByEmail($email);

    if (!$user) {
      echo "Utilisateur inconnu.";
      return;
    }

    if (!password_verify($password, $user["password"])) {
      echo "Mot de passe incorrect.";
      return;
    }

    // Données récupérées dans la session utilisateur.
    $_SESSION["user_id"] = $user["idUser"];
    $_SESSION["firstname"] = $user["firstName"];
    $_SESSION["lastname"] = $user["lastName"];
    $_SESSION["role"] = $user["role"];

    $this->redirect("/");
  }

  public function logout():void
  {
    session_unset();
    session_destroy();
    $this->redirect("/");
  }
}
