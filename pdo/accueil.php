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
  exit; // stop l execution du script
}

// récupérer l'ID de l'utilisateur depuis l'URL
$id = $_GET['id'];

// récupérer l'utilisateur dans la BDD
$query = "SELECT * FROM users WHERE id = $id";
$statement = $pdo->query($query); // la requete est lancée
$user = $statement->fetch(PDO::FETCH_ASSOC);  // FETCH_ASSOC retourne un tableau associatif et fetch retourne une seule ligne des données de la table

// Afficher les infos de l'utilisateur
echo '<pre>';
print_r(($user) ? $user :  'utilisteur non trouvé');
echo '</pre>';


/* !!!! IL FAUT PLUS SECURISER EN PRODUCTION !!! */

/* ATTENTION AUX INJECTIONS SQL IL FAUT SECURISER LES REQUETES */

/* VALIDATION DE DONNEES */





