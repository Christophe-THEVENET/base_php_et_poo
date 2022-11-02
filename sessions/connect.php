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

  /* ============ REQUETE PREPAREE POUR RECUPERER LE USER LOGIN ========= */
  $stmt = $pdo->prepare("SELECT * FROM users WHERE `login`=:login");
  $stmt->bindValue(":login", htmlentities($_POST['login']), PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
/*   ========================================================================= */


 /* 
 
 var_dump(xxxxxxxx)
 exit;  pour debugger et eviter la redirection ci dessous permet d afficher la valeur de retour $result */ 

  session_start();

  // avoir le login ds la session
  $_SESSION['login'] = $_POST['login'];

// login: Robert
  // password: test

/* ============ VERIFICATION DU PASSWORD ET REDIRECTION ========= */
  if ($result === false) {
    $_SESSION['connection_error_code'] = ConnectionErrorCode::INVALID_CREDENTIALS;
    redirect('login.php');
  } else {
    if (password_verify(htmlentities($_POST['password']), $result['password'])) {
      $_SESSION['connected'] = true;
      redirect('admin.php');
    } else {
      $_SESSION['connection_error_code'] = ConnectionErrorCode::INVALID_CREDENTIALS;
      redirect('login.php');
    }
  }

  $_SESSION['login'] = $_POST['login'];

}
