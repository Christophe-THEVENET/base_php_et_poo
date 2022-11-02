<?php

if (!isset($_GET['id'])) {
  echo "Veuillez renseigner un identifiant utilisateur";
  exit;
}

$dbConfig = parse_ini_file('db.ini');



try {
  // DSN = Data Source Name
  $pdo = new PDO(
    "mysql:host={$dbConfig['DB_HOST']};dbname={$dbConfig['DB_NAME']};charset={$dbConfig['DB_CHARSET']}",
    $dbConfig['DB_USER'],
    $dbConfig['DB_PASSWORD']
  );
} catch (PDOException $e) {
  echo "La connexion à la base de données a échoué";
  exit;
}

// récupérer l'ID de l'utilisateur depuis l'URL
$id = intval($_GET['id']); // transfome en int car tout dans l url ($_GET) est string

var_dump($id);

if ($id === 0) {
  echo "Veuillez renseigner un identifiant utilisateur correct";
  exit;
}



// récupérer l'utilisateur dans la BDD

// Requête non préparée
// $query = "SELECT * FROM users WHERE id = $id";
// $stmt = $pdo->query($query);

// Requête préparée : plus sécurisé
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Afficher les infos de l'utilisateur
if ($user === false) {
  echo "Utilisateur non trouvé";
  exit;
} else {
  //var_dump($user);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <img src="../forms-file-upload/profile_pics/<?php echo $user['profile_pic'] ?>" alt="<?php echo $user['name']; ?>">
  <p><?php echo $user['name']; ?></p>
</body>

</html>