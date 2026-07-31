<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Fournit les comportements communs à tous les contrôleurs.
 */
abstract class AbstractController
{
  protected array $config;

  /**
   * Indique si un utilisateur est authentifié.
   * ----------------------------------------------------------------------------
   */
  protected function isAuthenticated(): bool
  {
    return isset($_SESSION["user_id"]);
  }

  /**
   * Empêche l'accès aux pages réservées aux utilisateurs connectés.
   * ----------------------------------------------------------------------------
   */
  protected function requireAuthentication(): void
  {
    if (!$this->isAuthenticated()) {
      $this->redirect("/login");
    }

    return;
  }

  /**
   * Empêche l'accès aux pages nécessitant l'authentification d'un utilisateur
   * possédant les droits d'accès spécifiques en fonction du rôle.
   * ----------------------------------------------------------------------------
   */
  protected function requireRole(string $role): void
  {
    $this->requireAuthentication();

    $currentRole = $_SESSION["role"] ?? "";

    if ($currentRole !== $role) {
      $this->redirect("/");
    }
  }

  /**
   * Charge la configuration de l'application.
   * ----------------------------------------------------------------------------
   */
  public function __construct()
  {
    $this->config = require __DIR__ . "/../../config/app.php";
  }

  /**
   * Affiche une vue dans le layout principal de l'application.
   * ----------------------------------------------------------------------------
   * @param string $view ─ Chemin de la vue depuis le dossier templates
   */
  protected function render(string $view): void
  {
    $isAuthenticated = $this->isAuthenticated();

    $firstname = $_SESSION["firstname"] ?? "";
    $lastname = $_SESSION["lastname"] ?? "";
    $role = $_SESSION["role"] ?? "";

    $baseUrl = $this->config["base_url"];

    require __DIR__ . "/../../templates/layouts/app.php";
  }

  /**
   * Redirige vers une page spécifique.
   * ----------------------------------------------------------------------------
   * @param string $url ─ URL de redirection
   */
  protected function redirect(string $url): void
  {
    header("Location: " . $this->config["base_url"] . $url);
    exit;
  }
}
