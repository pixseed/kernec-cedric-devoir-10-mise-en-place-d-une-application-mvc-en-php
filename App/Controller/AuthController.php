<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\UserModel;

class AuthController extends AbstractController
{
  /**
   * Affiche la page de connexion.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données transmises à la vue
   */
  private function renderLogin(array $data = []): void
  {
    $this->render("auth/login.php", array_merge([
      "mainClass" => "d-flex justify-content-center align-items-center",
    ], $data));
  }

  /**
   * Affiche le formulaire de connexion.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->renderLogin();
  }

  /**
   * Traite le formulaire de connexion.
   * ----------------------------------------------------------------------------
   */
  public function login():void
  {
    $errors = [];

    // Récupération des données du formulaire.
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // Validation de l'email.
    if (empty($email)) {
      $errors["email"] = "L'adresse email est obligatoire.";

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "Le format de l'adresse email est invalide.";
    }
    
    // Validation du mot de passe.
    if (empty($password)) {
      $errors["password"] = "Le mot de passe est obligatoire.";
    }

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderLogin([
        "errors" => $errors,
        "email" => $email
      ]);

      return;
    }

    // Validation des identifiants dans la base de données.
    $userModel = new UserModel();

    $user = $userModel->findByEmail($email);

    // Si l'authentification est invalide, réaffichage du formulaire avec l'erreur.
    if (!$user || !password_verify($password, $user["password"])) {
      $this->renderLogin([
        "errors" => [
          "auth" => "Adresse email ou mot de passe incorrect."
        ]
      ]);
      
      return;
    }

    // Données récupérées dans la session utilisateur.
    $_SESSION["user_id"] = $user["idUser"];
    $_SESSION["firstname"] = $user["firstName"];
    $_SESSION["lastname"] = $user["lastName"];
    $_SESSION["role"] = $user["role"];

    // Enregistrement du flash de connexion dans la session.
    $this->setFlash(
      "success",
      "Vous êtes connecté avec succès."
    );

    $this->redirect("/");
  }

  /**
   * Déconnecte l'utilisateur. Supprime les données de session
   * puis redirige l'utilisateur vers la page d'accueil.
   * ----------------------------------------------------------------------------
   */
  public function logout():void
  {
    session_unset();
    session_destroy();
    $this->redirect("/");
  }
}
