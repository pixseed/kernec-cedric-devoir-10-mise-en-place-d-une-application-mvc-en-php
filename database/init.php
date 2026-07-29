<?php

declare(strict_types=1);

// Charge les dépendances Composer et les variables d'environnement.
require_once __DIR__ . "/../config/init.php";

// Charge la configuration de la base de données.
$config = require __DIR__ . "/../config/database.php";

// Construit le DSN pour se connecter au serveur MySQL.
$dsn = "mysql:host={$config['host']};port={$config['port']};charset={$config['charset']}";

/**
 * Exécute un fichier SQL.
 * 
 * @param PDO $pdo ─ Instance de connexion à la base de données
 * @param string $filePath ─ Chemin du fichier SQL à exécuter
 * 
 * @throws RuntimeException ─ Si le fichier ne peut-être lu
 */
function executeSqlFile(PDO $pdo, string $filePath): void
{
  $sql = file_get_contents($filePath);

  if ($sql === false) {
    throw new RuntimeException("Impossible de lire le fichier : {$filePath}");
  }

  $pdo->exec($sql);

  echo "✅ " . basename($filePath) . " exécuté avec succès !" . PHP_EOL;
}

// Initialise la base de données.
try {
  $pdo = new PDO(
    $dsn,
    $config["username"],
    $config["password"],
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]
  );

  echo "------------------------------------------------------" . PHP_EOL;
  echo "✅ Connexion au serveur MySQL réussie !" . PHP_EOL;
  executeSqlFile($pdo, __DIR__ . "/schema.sql");
  executeSqlFile($pdo, __DIR__ . "/seed.sql");
  echo "------------------------------------------------------" . PHP_EOL;
  echo "🚀 Base de données initialisée avec succès !" . PHP_EOL;
  echo "------------------------------------------------------" . PHP_EOL;
  
  $tables = [
    "users",
    "agencies",
    "trips",
    ];
    
    echo PHP_EOL . "📊 Vérification des données :" . PHP_EOL;
    echo "──────────────────────────────────────────────────────" . PHP_EOL;
  
  foreach ($tables as $table) {
    $result = $pdo->query("SELECT COUNT(*) FROM {$table}");
    $count = $result->fetchColumn();
    $pluralization = $count > 1 ? "s" : "";

    echo "- {$table} : {$count} enregistrement{$pluralization}" . PHP_EOL;
  }

} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}