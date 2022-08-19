<?php

require_once 'functions.php';
require_once 'ConnectionErrorCode.php';

if (!empty($_POST['login']) && !empty($_POST['password'])) { // si on a un login et un password
  $dbConfig = parse_ini_file('../pdo/db.ini'); // renvoi un tableau des donnees du fichier db.ini


  // a factoriser le script de connexion pour eviter de répéter
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

  $stmt = $pdo->prepare("SELECT * FROM users WHERE `login`= :login AND `password` = :password");

  $stmt->bindValue("login", $_POST['login'], PDO::PARAM_STR);
  $stmt->bindValue("password", $_POST['password'], PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

 /*  $id = trim(htmlspecialchars($_GET["id"], ENT_QUOTES));
  $sql = "DELETE FROM `list` WHERE id = :id";
  $req = $pdo->prepare($sql);
  $req->bindParam(":id", $id, PDO::PARAM_INT);
  $req->execute(); */

  var_dump($user);

  session_start();

  $_SESSION['login'] = $_POST['login']; 

  if ($user === false) {
    $_SESSION['connection_error_code'] = ConnectionErrorCode::INVALID_CREDENTIALS;
    redirect('login.php');
  } else {
    if (isset($_POST['password'], $user['password'])) {
      $_SESSION['connected'] = true;
     
      redirect('admin.php');
    } else {
      $_SESSION['connection_error_code'] = ConnectionErrorCode::INVALID_CREDENTIALS;
      redirect('login.php');
    }
  }
}
