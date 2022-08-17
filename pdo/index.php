<?php

try {
  // DSN = Data Source Name
  $pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=base_php_et_poo_delobelle;charset=utf8mb4",
    "base_php_et_poo_delobelle",
    "1kyA2ZqAFEo]Ro7/"
  );
} catch (PDOException $e) {
  echo "La connexion à la base de données a échoué";
  exit;
}

var_dump($pdo);

$query = "SELECT * FROM users";
$stmt = $pdo->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC); // row = ligne
var_dump($row);


