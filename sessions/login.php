<?php
require_once 'ConnectionErrorCode.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Connexion</title>
</head>

<body>
  <h1>Coucou c'est moi le login</h1>
  <!-- // gestion des messages d erreur -->
  <?php if (isset($_SESSION['connection_error_code'])) {
    switch ($_SESSION['connection_error_code']) {
      case ConnectionErrorCode::INVALID_CREDENTIALS:
        $errorMsg = 'Identifiants incorrects';
        break;
      case ConnectionErrorCode::DB_ERROR:
        $errorMsg = 'Erreur de base de données';
        break;
      case ConnectionErrorCode::SERVICE_UNAVAILABLE:
        $errorMsg = "Service indisponible";
        break;
      default:
        $errorMsg = "Une erreur est survenue";
    }
    unset($_SESSION['connection_error_code']); // il faut bien supprimer les messages d erreur de la session sinon ils seront tjrs affichés
  ?>
    <div class="error"><?php echo $errorMsg; ?></div>
  <?php
  } ?>
  <form action="connect.php" method="POST">
    <div>
      <label for="login">Login :</label>
      <input type="text" name="login" id="login">
    </div>
    <div>
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password">
    </div>
    <div>
      <button type="submit">Connexion</button>
    </div>
  </form>
</body>

</html>