<?php

// --------on execute le script que si $_POST contient des donnees
if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
  $dbConfig = parse_ini_file('../pdo/db.ini'); // on va chercher les param de connexion bdd

  /* ========= CONNEXION BDD ==================== */
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

  /* ========= TELECHARGEMENT FICHIER ==================== */
  if (isset($_FILES['profile_pic']) && is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
    $uploadDir = 'profile_pics' . DIRECTORY_SEPARATOR;
    $fileInfo = pathinfo($_FILES['profile_pic']['name']);
    $filename = $fileInfo['filename'] . '_' . mt_rand() . '.' . $fileInfo['extension'];
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadDir . $filename);
  }

/*   ======================== REQUETE PREPAREE = AJOUTER UN USER ========================= */
  // A FAIRE EN PLUS EN PROD: Gestion d'erreurs (check false, exceptions) + validation données
  $stmt = $pdo->prepare("INSERT INTO users (name, firstname, login, email, password, profile_pic) VALUES (:name, :firstname, :login, :email, :password, :profile_pic)");
  $stmt->bindValue(":name", htmlentities($_POST['name'] ?? ""), PDO::PARAM_STR); // si non renseigné ds formulaire: entrer chaine vide
  $stmt->bindValue(":firstname",htmlentities($_POST['firstname'] ?? ""), PDO::PARAM_STR);
  $stmt->bindValue(":login", htmlentities($_POST['login']), PDO::PARAM_STR);
  $stmt->bindValue(":email", htmlentities($_POST['email']), PDO::PARAM_STR);
  $stmt->bindValue(":password", htmlentities(password_hash($_POST['password'], PASSWORD_BCRYPT)), PDO::PARAM_STR);
  $stmt->bindParam(":profile_pic", $filename, PDO::PARAM_STR);
  $stmt->execute();


 /*  $stmt->execute([
    'name' => $_POST['name'] ?? "", // si pas de name (pas requi) on met une chaine vide
    'firstname' => $_POST['firstname'] ?? "", // si pas de name (pas requi) on met une chaine vide
    'login' => $_POST['login'],
    'email' => $_POST['email'],
    'password' => password_hash($_POST['password'], PASSWORD_BCRYPT), // on crypte le password
    'profile_pic' => $filename
  ]); */
} 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forms & File Upload</title>
  <style>
    div {
      margin: 10px;
    }
  </style>
</head>

<body>
  <form method="POST" enctype="multipart/form-data">
    <div>
      <label for="name">Nom :</label>
      <input type="text" name="name" id="name" />
    </div>
    <div>
      <label for="firstname">Prénom :</label>
      <input type="text" name="firstname" id="firstname" />
    </div>
    <div>
      <label for="login">Login :</label>
      <input type="text" name="login" id="login" required />
    </div>
    <div>
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" required />
    </div>
    <div>
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" required />
    </div>
    <div>
      <label for="profile_pic">Photo de profil :</label>
      <input type="file" name="profile_pic" id="profile_pic" />
    </div>
    <div>
      <input type="submit" value="Enregistrer" />
    </div>
  </form>
</body>

</html>
