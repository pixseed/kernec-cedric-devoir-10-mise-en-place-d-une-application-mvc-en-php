<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Fournit les comportements communs à tous les contrôleurs.
 */
abstract class AbstractController
{
  /**
   * Charge une vue depuis le dossier templates.
   * 
   * @param string $view ─ Chemin de la vue depuis le dossier templates
   */
  protected function render(string $view): void
  {
    require __DIR__ . "/../../templates/" . $view;
  }
}