<?php

declare(strict_types=1);

namespace Tests\Model;

use App\Model\AgencyModel;
use Override;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tests\Database\TestDatabase;

/**
 * Teste les opération d'écriture du modèle AgencyModel.
 * ----------------------------------------------------------------------------
 */
// Indique à PHPUnit que cette classe de tests couvre AgencyModel.
#[CoversClass(AgencyModel::class)]
class AgencyModelTest extends TestCase
{
  private PDO $connection;
  private AgencyModel $agencyModel;

  /**
   * Prépare l'environnement nécessaire avant l'exécution de chaque test.
   * ----------------------------------------------------------------------------
   * Une base de donnée de test propre est créée
   * puis sa connexion PDO est injectée dans le modèle à tester.
   */
  #[Override]
  protected function setUp(): void
  {
    parent::setUp();

    $this->connection = TestDatabase::create();
    $this->agencyModel = new AgencyModel($this->connection);
  }

  /**
   * Vérifie qu'une agence peut être insérée dans la base de données.
   * ----------------------------------------------------------------------------
   * Le test contrôle :
   * - le succès retourné par la méthode insert()
   * - la présence de l'agence dans la base
   * - la conformité du nom enregistré
   */
  public function testInsert(): void
  {
    // Arrange : Prépare les données nécessaires au test.
    $data = [
      "name" => "Agence PHPUnit"
    ];

    // Act : Exécute l'opération que l'on souhaite tester.
    $result = $this->agencyModel->insert($data);

    // Assert : Vérifie que l'insertion a été exécutée avec succès.
    $this->assertTrue($result);

    // Recherche directement l'agence dans la base de données de test par son nom.
    $stmt = $this->connection->prepare(
      "SELECT name
      FROM agencies
      WHERE name = :name"
    );

    $stmt->execute([
      ":name" => $data["name"]
    ]);

    $agency = $stmt->fetch();

    // Vérifie qu'une aggence a bien été trouvée.
    $this->assertIsArray($agency);

    // Vérifie que la valeur enregistrée correspond à la valeur attendue.
    $this->assertSame("Agence PHPUnit", $agency["name"]);
  }

  /**
   * Vérifie qu'une agence peut être modifiée dans la base de données.
   * ----------------------------------------------------------------------------
   * Le test contrôle :
   * - le succès retourné par la méthode update()
   * - la présence de l'agence dans la base
   * - la conformité du nom enregistré
   */
  public function testUpdate(): void
  {
    // Arrange : Prépare les données nécessaires au test.
    $data = [
      "name" => "Agence PHPUnit"
    ];

    $this->agencyModel->insert($data);
    $idAgency = (int) $this->connection->lastInsertId();

    $newData = [
      "name" => "Agence PHPUnit Update"
    ];

    // Act : Exécute l'opération que l'on souhaite tester.
    $result = $this->agencyModel->update($idAgency, $newData);

    // Assert : Vérifie que la modifiation a été exécutée avec succès.
    $this->assertTrue($result);

    // Recherche directement l'agence dans la base de données de test par son id.
    $stmt = $this->connection->prepare(
      "SELECT name
      FROM agencies
      WHERE idAgency = :idAgency"
    );

    $stmt->execute([
      ":idAgency" => $idAgency
    ]);

    $agency = $stmt->fetch();

    // Vérifie qu'une agence a bien été trouvée.
    $this->assertIsArray($agency);

    // Vérifie que la valeur enregistrée correspond à la valeur attendue.
    $this->assertSame("Agence PHPUnit Update", $agency["name"]);
  }

  /**
   * Vérifie qu'une agence peut être supprimée dans la base de données.
   * ----------------------------------------------------------------------------
   * Le test contrôle :
   * - le succès retourné par la méthode delete()
   * - l'inexistence de l'agence dans la base
   */
  public function testDelete(): void
  {
    // Arrange : Prépare les données nécessaires au test.
    $data = [
      "name" => "Agence PHPUnit"
    ];

    $this->agencyModel->insert($data);
    $idAgency = (int) $this->connection->lastInsertId();

    // Act : Exécute l'opération que l'on souhaite tester.
    $result = $this->agencyModel->delete($idAgency);

    // Assert : Vérifie que la suppression a été exécutée avec succès.
    $this->assertTrue($result);

    // Recherche directement l'agence dans la base de données de test par son id.
    $stmt = $this->connection->prepare(
      "SELECT name
      FROM agencies
      WHERE idAgency = :idAgency"
    );

    $stmt->execute([
      ":idAgency" => $idAgency
    ]);

    $agency = $stmt->fetch();

    // Vérifie que l'agence n'existe plus dans la base de données.
    $this->assertFalse($agency);
  }
}