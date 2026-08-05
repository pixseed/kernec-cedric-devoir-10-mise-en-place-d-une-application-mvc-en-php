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
   * @param array $data ─ Tableau de données intégré
   */
  protected function render(string $view, array $data = []): void
  {
    extract($data);

    $flash = $this->getFlash();
    
    $isAuthenticated = $this->isAuthenticated();

    $firstname = $_SESSION["firstname"] ?? "";
    $lastname = $_SESSION["lastname"] ?? "";
    $role = $_SESSION["role"] ?? "";

    // URL absolue de l'application → À utiliser pour les ressources et redirections.
    // Ex : CSS, JS, img...
    $baseUrl = $this->config["base_url"];
    
    // Chemin de base de l'pplication → À utiliser pour les routes internes
    // Ex : href, action de formulaire, fetch, data-url...
    $baseFolder = $this->config["base_folder"];

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

  /**
   * Enregistre un message flash en session.
   * ----------------------------------------------------------------------------
   * @param string $type ─ Type du message (success, danger, warning, info)
   * @param string $message ─ Contenu du message
   */
  protected function setFlash(string $type, string $message): void
  {
    $_SESSION["flash"] = [
      "type" => $type,
      "message" => $message,
    ];
  }

  /**
   * Récupère le flash de la session, le supprime de la session puis le retourne.
   */
  protected function getFlash(): array
  {
    $flash = $_SESSION["flash"] ?? [];

    unset($_SESSION["flash"]);

    return $flash;
  }
}
