<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\UserModel;
use App\Validators\AuthValidator;
use App\Constants\Role;

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
  public function login(): void
  {
    // Récupération des données du formulaire.
    $data = $this->getAuthFormData();

    // Validation des données.
    $authValidator = new AuthValidator();
    $errors = $authValidator->validate($data);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderLogin([
        "errors" => $errors,
        "email" => $data["email"]
      ]);

      return;
    }

    // Validation des identifiants dans la base de données.
    $userModel = new UserModel();
    $user = $userModel->findByEmail($data["email"]);

    // Si l'authentification est invalide, réaffichage du formulaire avec l'erreur.
    if (!$user || !password_verify($data["password"], $user["password"])) {
      $this->renderLogin([
        "errors" => [
          "auth" => "Adresse email ou mot de passe incorrect."
        ],
        "email" => $data["email"]
      ]);
      
      return;
    }

    // Données récupérées dans la session utilisateur.
    $_SESSION["user_id"] = $user["idUser"];
    $_SESSION["firstName"] = $user["firstName"];
    $_SESSION["lastName"] = $user["lastName"];
    $_SESSION["role"] = $user["role"];

    // Enregistrement du flash de connexion dans la session.
    $this->setFlash(
      "success",
      "Vous êtes connecté avec succès."
    );

    if($_SESSION["role"] === Role::ADMIN) {
      $this->redirect("/admin");
    }
    
    $this->redirect("/");
  }

  /**
   * Déconnecte l'utilisateur. Supprime les données de session
   * puis redirige l'utilisateur vers la page d'accueil.
   * ----------------------------------------------------------------------------
   */
  public function logout(): void
  {
    session_unset();
    session_destroy();
    $this->redirect("/");
  }

  /**
   * Récupère et normalise les données du formulaire d'authentification.
   * ----------------------------------------------------------------------------
   */
  private function getAuthFormData(): array
  {
    return [
      "email"     => trim($_POST["email"] ?? ""),
      "password"  => trim($_POST["password"] ?? ""),
    ];
  }
}
