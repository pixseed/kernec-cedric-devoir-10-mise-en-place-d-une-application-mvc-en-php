<?php

declare(strict_types=1);

namespace Tests\Model;

use App\Model\TripModel;
use Override;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tests\Database\TestDatabase;

/**
 * Teste les opération d'écriture du modèle TripModel.
 * ----------------------------------------------------------------------------
 */
// Indique à PHPUnit que cette classe de tests couvre TripModel.
#[CoversClass(TripModel::class)]
class TripModelTest extends TestCase
{
  private PDO $connection;
  private TripModel $tripModel;

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
    $this->tripModel = new TripModel($this->connection);
  }

  /**
   * Vérifie qu'un trajet peut être inséré dans la base de données.
   * ----------------------------------------------------------------------------
   * Le test contrôle :
   * - le succès retourné par la méthode insert()
   * - la présence du trajet dans la base
   * - la conformité des données enregistrées
   */
  public function testInsert(): void
  {
    // Arrange : Prépare les données nécessaires au test.
    $stmt = $this->connection->prepare(
      "INSERT INTO users (
        lastName,
        firstName,
        email,
        phone,
        password,
        role
      )
      VALUES (
        :lastName,
        :firstName,
        :email,
        :phone,
        :password,
        :role
      )"
    );

    $stmt->execute([
      ":lastName"   => "Test",
      ":firstName"  => "PHPUnit",
      ":email"      => "phpunit@test.fr",
      ":phone"      => "0600000000",
      ":password"   => "password",
      ":role"       => "user"
    ]);

    $idUser = (int) $this->connection->lastInsertId();

    $stmt = $this->connection->prepare(
      "INSERT INTO agencies (name)
      VALUES (:name)"
    );

    $stmt->execute([
      ":name" => "Agence PHPUnit 1"
    ]);

    $idDepartureAgency = (int) $this->connection->lastInsertId();

    $stmt->execute([
      ":name" => "Agence PHPUnit 2"
    ]);

    $idArrivalAgency = (int) $this->connection->lastInsertId();

    $data = [
      "startDate"       => "2026-09-01",
      "startHour"       => "08:00:00",
      "endDate"         => "2026-09-01",
      "endHour"         => "10:30:00",
      "numberSeats"     => 4,
      "availableSeats"  => 3,
      "idUser"          => $idUser,
      "idStartAgency"   => $idDepartureAgency,
      "idEndAgency"     => $idArrivalAgency
    ];

    // Act : Exécute l'opération que l'on souhaite tester.
    $result = $this->tripModel->insert($data);
    $idTrip = (int) $this->connection->lastInsertId();

    // Assert : Vérifie que l'insertion a été exécutée avec succès.
    $this->assertTrue($result);

    // Recherche directement le trajet dans la base de données de test par son id.
    $stmt = $this->connection->prepare(
      "SELECT
          idTrip,
          startDate,
          startHour,
          endDate,
          endHour,
          numberSeats,
          availableSeats,
          idUser,
          idStartAgency,
          idEndAgency
      FROM trips
      WHERE idTrip = :idTrip"
    );

    $stmt->execute([
      ":idTrip" => $idTrip
    ]);

    $trip = $stmt->fetch();

    // Vérifie qu'un trajet a bien été trouvé.
    $this->assertIsArray($trip);

    // Vérifie que les valeurs enregistrées correspondent aux valeurs attendues.
    $this->assertSame(
      [
        $data["startDate"],
        $data["startHour"],
        $data["endDate"],
        $data["endHour"],
        $data["numberSeats"],
        $data["availableSeats"],
        $data["idUser"],
        $data["idStartAgency"],
        $data["idEndAgency"]
      ],
      [
        $trip["startDate"],
        $trip["startHour"],
        $trip["endDate"],
        $trip["endHour"],
        $trip["numberSeats"],
        $trip["availableSeats"],
        $trip["idUser"],
        $trip["idStartAgency"],
        $trip["idEndAgency"]
      ]
    );
  }

  /**
   * Vérifie qu'un trajet peut être modifié dans la base de données.
   * ----------------------------------------------------------------------------
   * Le test contrôle :
   * - le succès retourné par la méthode update()
   * - la présence du trajet dans la base
   * - la conformité des données enregistrées
   */
  public function testUpdate(): void
  {
    // Arrange : Prépare les données nécessaires au test.
    $stmt = $this->connection->prepare(
      "INSERT INTO users (
        lastName,
        firstName,
        email,
        phone,
        password,
        role
      )
      VALUES (
        :lastName,
        :firstName,
        :email,
        :phone,
        :password,
        :role
      )"
    );

    $stmt->execute([
      ":lastName"   => "Test",
      ":firstName"  => "PHPUnit",
      ":email"      => "phpunit@test.fr",
      ":phone"      => "0600000000",
      ":password"   => "password",
      ":role"       => "user"
    ]);

    $idUser = (int) $this->connection->lastInsertId();

    $stmt = $this->connection->prepare(
      "INSERT INTO agencies (name)
      VALUES (:name)"
    );

    $stmt->execute([
      ":name" => "Agence PHPUnit 1"
    ]);

    $idDepartureAgency = (int) $this->connection->lastInsertId();

    $stmt->execute([
      ":name" => "Agence PHPUnit 2"
    ]);

    $idArrivalAgency = (int) $this->connection->lastInsertId();

    $stmt->execute([
      ":name" => "Agence PHPUnit 3"
    ]);

    $idNewDepartureAgency = (int) $this->connection->lastInsertId();

    $stmt->execute([
      ":name" => "Agence PHPUnit 4"
    ]);

    $idNewArrivalAgency = (int) $this->connection->lastInsertId();

    $data = [
      "startDate"       => "2026-09-01",
      "startHour"       => "08:00:00",
      "endDate"         => "2026-09-01",
      "endHour"         => "10:30:00",
      "numberSeats"     => 4,
      "availableSeats"  => 3,
      "idUser"          => $idUser,
      "idStartAgency"   => $idDepartureAgency,
      "idEndAgency"     => $idArrivalAgency
    ];

    $newData = [
      "startDate"       => "2026-09-02",
      "startHour"       => "08:30:00",
      "endDate"         => "2026-09-02",
      "endHour"         => "11:00:00",
      "numberSeats"     => 5,
      "availableSeats"  => 4,
      "idStartAgency"   => $idNewDepartureAgency,
      "idEndAgency"     => $idNewArrivalAgency
    ];

    $this->tripModel->insert($data);
    $idTrip = (int) $this->connection->lastInsertId();
    
    // Act : Exécute l'opération que l'on souhaite tester.
    $result = $this->tripModel->update($idTrip, $newData);

    // Assert : Vérifie que la modifiation a été exécutée avec succès.
    $this->assertTrue($result);

    // Recherche directement le trajet dans la base de données de test par son id.
    $stmt = $this->connection->prepare(
      "SELECT
          idTrip,
          startDate,
          startHour,
          endDate,
          endHour,
          numberSeats,
          availableSeats,
          idUser,
          idStartAgency,
          idEndAgency
      FROM trips
      WHERE idTrip = :idTrip"
    );

    $stmt->execute([
      ":idTrip" => $idTrip
    ]);

    $trip = $stmt->fetch();

    // Vérifie qu'un trajet a bien été trouvé.
    $this->assertIsArray($trip);

    // Vérifie que l'auteur du trajet reste celui d'origine.
    $this->assertSame($idUser, $trip["idUser"]);

    // Vérifie que les valeurs enregistrées correspondent aux valeurs attendues.
    $this->assertSame(
      [
        $newData["startDate"],
        $newData["startHour"],
        $newData["endDate"],
        $newData["endHour"],
        $newData["numberSeats"],
        $newData["availableSeats"],
        $newData["idStartAgency"],
        $newData["idEndAgency"]
      ],
      [
        $trip["startDate"],
        $trip["startHour"],
        $trip["endDate"],
        $trip["endHour"],
        $trip["numberSeats"],
        $trip["availableSeats"],
        $trip["idStartAgency"],
        $trip["idEndAgency"]
      ]
    );
  }

  /**
   * Vérifie qu'un trajet peut être supprimé dans la base de données.
   * ----------------------------------------------------------------------------
   * Le test contrôle :
   * - le succès retourné par la méthode delete()
   * - l'inexistence du trajet dans la base
   */
  public function testDelete(): void
  {
    // Arrange : Prépare les données nécessaires au test.
    $stmt = $this->connection->prepare(
      "INSERT INTO users (
        lastName,
        firstName,
        email,
        phone,
        password,
        role
      )
      VALUES (
        :lastName,
        :firstName,
        :email,
        :phone,
        :password,
        :role
      )"
    );

    $stmt->execute([
      ":lastName"   => "Test",
      ":firstName"  => "PHPUnit",
      ":email"      => "phpunit@test.fr",
      ":phone"      => "0600000000",
      ":password"   => "password",
      ":role"       => "user"
    ]);

    $idUser = (int) $this->connection->lastInsertId();

    $stmt = $this->connection->prepare(
      "INSERT INTO agencies (name)
      VALUES (:name)"
    );

    $stmt->execute([
      ":name" => "Agence PHPUnit 1"
    ]);

    $idDepartureAgency = (int) $this->connection->lastInsertId();

    $stmt->execute([
      ":name" => "Agence PHPUnit 2"
    ]);

    $idArrivalAgency = (int) $this->connection->lastInsertId();

    $data = [
      "startDate"       => "2026-09-01",
      "startHour"       => "08:00:00",
      "endDate"         => "2026-09-01",
      "endHour"         => "10:30:00",
      "numberSeats"     => 4,
      "availableSeats"  => 3,
      "idUser"          => $idUser,
      "idStartAgency"   => $idDepartureAgency,
      "idEndAgency"     => $idArrivalAgency
    ];

    $this->tripModel->insert($data);
    $idTrip = (int) $this->connection->lastInsertId();
    
    // Act : Exécute l'opération que l'on souhaite tester.
    $result = $this->tripModel->delete($idTrip);

    // Assert : Vérifie que la suppression a été exécutée avec succès.
    $this->assertTrue($result);

    // Recherche directement le trajet dans la base de données de test par son id.
    $stmt = $this->connection->prepare(
      "SELECT idTrip
      FROM trips
      WHERE idTrip = :idTrip"
    );

    $stmt->execute([
      ":idTrip" => $idTrip
    ]);

    $trip = $stmt->fetch();

    // Vérifie que le trajet n'existe plus dans la base de données.
    $this->assertFalse($trip);
  }
}