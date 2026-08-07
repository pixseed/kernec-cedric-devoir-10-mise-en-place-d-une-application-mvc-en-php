<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\AgencyModel;
use App\Validators\AgencyValidator;
use Exception;

class AgencyController extends AbstractController
{
  /**
   * Affiche la liste des agences.
   * ----------------------------------------------------------------------------
   */
  public function index(): void
  {
    $this->requireRole("admin");

    // Affiche la liste des agences avec la vue par défaut.
    $this->renderAgencyForm(
      null,
      "default"
    );
  }

  /**
   * Affiche le formulaire de création d'agence.
   * ----------------------------------------------------------------------------
   */
  public function create(): void
  {
    $this->requireRole("admin");

    // Affiche la liste des agences et le formulaire de création.
    $this->renderAgencyForm(
      [],
      "create"
    );
  }

  /**
   * Traite le formulaire de création d'agence.
   * ----------------------------------------------------------------------------
   */
  public function store(): void
  {
    $this->requireRole("admin");

    // Récupération des données du formulaire.
    $data = $this->getAgencyFormData();

    // Validation des données.
    $agencyValidator = new AgencyValidator();
    $errors = $agencyValidator->validate($data);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderAgencyForm(
        $data,
        "create",
        $errors
      );

      return;
    }

    // Insertion des données dans la base.
    $this->getAgencyModel()->insert($data);

    $this->setFlash(
      "success",
      "L'agence a été créée avec succès."
    );

    $this->redirect("/agencies");
  }

  /**
   * Affiche le formulaire d'édition d'agence.
   * ----------------------------------------------------------------------------
   * @param int $idAgency ─ Identifiant unique de l'agence
   */
  public function edit(int $idAgency): void
  {
    $this->requireRole("admin");

    // Affiche la liste des agences et le formulaire d'édition pré-rempli.
    $this->renderAgencyForm(
      $this->getAgency($idAgency),
      "edit"
    );
  }

  /**
   * Traite le formulaire de modification d'agence.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique de l'agence
   */
  public function update(int $id): void
  {
    $this->requireRole("admin");

    // Vérifie que l'agence existe.
    $this->getAgency($id);

    // Récupération des données du formulaire.
    $data = $this->getAgencyFormData();

    // Conserve l'identifiant : Nécessaire pour garder le formulaire en mode édition (côté vue)
    // après une erreur de validation.
    $data["idAgency"] = $id;

    // Validation des données.
    $agencyValidator = new AgencyValidator();
    $errors = $agencyValidator->validate($data, $id);

    // Si des erreurs existent, réaffichage du formulaire avec les erreurs.
    if (!empty($errors)) {
      $this->renderAgencyForm(
        $data,
        "edit",
        $errors,
      );

      return;
    }

    // Mise à jour des données dans la base.
    $this->getAgencyModel()->update($id, $data);

    $this->setFlash(
      "success",
      "L'agence a été modifiée avec succès."
    );

    $this->redirect("/agencies");
  }

  /**
   * Traite le formulaire de suppression d'agence.
   * ----------------------------------------------------------------------------
   * @param int $id ─ Identifiant unique de l'agence
   */
  public function delete(int $id): void
  {
    $this->requireRole("admin");

    // Vérifie que l'agence existe.
    try {
      $this->getAgency($id);
    } catch (Exception $e) {
      $this->setFlash(
        "danger",
        $e->getMessage()
      );

      $this->redirect("/agencies");
      return;
    }

    // Suppression des données dans la base.
    $this->getAgencyModel()->delete($id);

    $this->setFlash(
      "success",
      "L'agence a été supprimé avec succès."
    );

    $this->redirect("/agencies");
  }

  /**
   * Instancie le modèle des agences.
   * ----------------------------------------------------------------------------
   * @return AgencyModel ─ Instance du modèles des agences
   */
  private function getAgencyModel(): AgencyModel
  {
    return new AgencyModel();
  }

  /**
   * Récupère la liste des agences.
   * ----------------------------------------------------------------------------
   * @return array ─ Tableau des agences
   */
  private function getAgencies(): array
  {
    return $this->getAgencyModel()->findAll();
  }

  /**
   * Recherche une agence à partir de son identifiant.
   * ----------------------------------------------------------------------------
   * @param int $idAgency ─ Identifiant unique de l'agence
   * @return array ─ Données de l'agence
   * @throws Exception ─ Si l'agence n'existe pas
   */
  private function getAgency(int $idAgency): array
  {
    $agency = $this->getAgencyModel()->findById($idAgency);

    if (!$agency) {
      throw new Exception("Cette agence n'existe pas.");
    }

    return $agency;
  }

  /**
   * Affiche la page de gestion des agences avec le formulaire de création ou d'édition.
   * ----------------------------------------------------------------------------
   * @param array|null $agency ─ Agence à modifier ou null si aucun agence n'est sélectionnée
   * @param string $mode ─ Vue affichée en fonction du contexte
   * @param array $errors ─ Tableau d'erreurs relevées
   */
  private function renderAgencyForm(
    ?array $agency,
    string $mode,
    array $errors = []
  ): void
  {
    $this->render("agency/index.php", [
      "agencies"  => $this->getAgencies(),
      "agency"    => $agency,
      "mode"      => $mode,
      "errors"    => $errors
    ]);
  }

  /**
   * Récupère et normalise les données du formulaire d'agence.
   * ----------------------------------------------------------------------------
   */
  private function getAgencyFormData(): array
  {
    return [
      "name" => trim($_POST["name"] ?? "")
    ];
  }
}
