<?php

if (!isset($_GET['id'])) { // gere l erreur absence de recherche d id ds l url
  echo "Veuillez renseigner un identifiant utilisateur";
  exit; // tres important, arrete le script
}

$dbConfig = parse_ini_file('db.ini'); // renvoi un tableau des donnees du fichier db.ini

var_dump($dbConfig);

// le db.ini est ignoré, on peut decrire un chapitre configuration ds le readme en indiquant: créer un fichier db.ini a u format:

/* DB_HOST = "xxxxxxxxxxxxx"
DB_NAME = "xxxxxxxxxxxxx"
DB_USER="xxxxxxxxxxxx"
DB_PASSWORD="xxxxxxxxxxxxxx"
DB_CHARSET = "xxxxxxxxxxxxxxxxxxxx" */

try {
  // DSN = Data Source Name
  $pdo = new PDO(
    "mysql:host={$dbConfig['DB_HOST']};dbname={$dbConfig['DB_NAME']};charset={$dbConfig['DB_CHARSET']}",
    $dbConfig['DB_USER'],
    $dbConfig['DB_PASSWORD']
  );
} catch (PDOException $e) {
  echo "La connexion à la base de données a échoué";
  exit; // stop l execution du script
}

// récupérer l'ID de l'utilisateur depuis l'URL
$id = intval($_GET["id"]);



/* =============== REQUETE NON PREPAREE =============== */

// récupérer l'utilisateur dans la BDD (methode non safe direcit)
/* $query = "SELECT * FROM users WHERE id = $id"; */
/* $statement = $pdo->query($query); */ // la requete est lancée
/* $user = $statement->fetch(PDO::FETCH_ASSOC); */  // FETCH_ASSOC retourne un tableau associatif et fetch retourne une seule ligne des données de la table


/* !!!! IL FAUT PLUS SECURISER EN PRODUCTION !!! */

/* ATTENTION AUX INJECTIONS SQL IL FAUT SECURISER LES REQUETES */

/* VALIDATION DE DONNEES */


/* =============== REQUETE PREPAREE =============== */

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


// Afficher les infos de l'utilisateur
echo '<pre>';
print_r(($user) ? $user :  'utilisteur non trouvé');
echo '</pre>';

