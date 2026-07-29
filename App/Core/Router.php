<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\ErrorController;
use Exception;

/**
 * Gère les routes de l'application.
 * Rôle : Faire le lien entre une URL et le contrôleur qui doit traiter la requête.
 */
class Router
{
  /**
   * Tableau contenant toutes les routes de l'application.
   */
  private array $routes = [
    "GET" => [],
    "POST" => []
  ];

  /**
   * Ajoute une route à la liste des routes.
   * 
   * @param string $method ─ Méthode HTTP (GET, POST...)
   * @param string $path ─ URL de la route
   * @param array $action ─ Contrôleur et méthode à exécuter
   */
  private function addRoute(string $method, string $path, array $action): void
  {
    $this->routes[$method][$path] = $action;
  }

  /**
   * Enregistre une nouvelle route GET.
   * 
   * @param string $path ─ URL de la route
   * @param array $action ─ Contrôleur et méthode à exécuter
   */
  public function get(string $path, array $action): void
  {
    $this->addRoute("GET", $path, $action);
  }

  /**
   * Enregistre une nouvelle route POST.
   * 
   * @param string $path ─ URL de la route
   * @param array $action ─ Contrôleur et méthode à exécuter
   */
  public function post(string $path, array $action): void
  {
    $this->addRoute("POST", $path, $action);
  }

  /**
   * Recherche la route demandée puis exécute le contrôleur correspondant.
   * 
   * @param string $method ─ Méthode HTTP (GET, POST...)
   * @param string $path ─ URL de la route
   * @param string $baseUrl ─ URL de base de l'application
   */
  public function dispatch(string $method, string $path, string $baseUrl): void
  {
    // Supprime les paramètres éventuels pour ne conserver que le chemin de l'URL.
    $path = parse_url($path, PHP_URL_PATH);

    // Récupère le chemin de base de l'application.
    $basePath = parse_url($baseUrl, PHP_URL_PATH);

    // Enlève le chemin de base si l'URL commence par celui-ci.
    if (str_starts_with($path, $basePath)) {
      $path = substr($path, strlen($basePath));
    }

    // Si l'utilisateur est à la racine du site, on considère qu'il demande la route "/".
    if ($path === "") {
      $path = "/";
    }

    // Vérifie si une route correspondant à la méthode HTTP
    //et à l'URL demandée existe dans le routeur.
    if (!isset($this->routes[$method][$path])) {

      http_response_code(404);

      $controler = new ErrorController();
      $controler->notFound();

      return;
    }

    // Récupère le contrôleur et la méthode associées à la route demandée.
    [$controlerClass, $action] = $this->routes[$method][$path];

    // Vérifie que le contrôleur existe.
    if (!class_exists($controlerClass)) {
      throw new Exception("Le contrôleur est introuvable.");
    }

    // Instancie le contrôleur.
    $controler = new $controlerClass();
    
    // Vérifie que la méthode existe.
    if (!method_exists($controler, $action)) {
      throw new Exception("La méthode '$action' n'existe pas");
    }

    // Exécute la méthode du contrôleur.
    $controler->$action();
  }
}