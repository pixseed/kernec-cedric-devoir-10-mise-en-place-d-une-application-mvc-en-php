<?php

declare(strict_types=1);

namespace App\Validators;

class AuthValidator
{
  /**
   * Valide les données du formulaire d'authentification.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @return array ─ Liste des erreurs de validation
   */
  public function validate(array $data): array
  {
    $errors = [];

    // Exécute l'ensemble des validations du formulaire.
    $this->validateEmail($data, $errors);
    $this->validatePassword($data, $errors);

    return $errors;
  }

  /**
   * Vérifie que le champ email n'est pas vide et que le format est correct.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validateEmail(array $data, array &$errors): void
  {
    if (empty($data["email"])) {
      $errors["email"] = "L'adresse email est obligatoire.";

      return;
    }
    
    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "Le format de l'adresse email est invalide.";
    }
  }

  /**
   * Vérifie que le champ du mot de passe n'est pas vide.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validatePassword(array $data, array &$errors): void
  {
    if (empty($data["password"])) {
      $errors["password"] = "Le mot de passe est obligatoire.";
    }
  }
}