<?php
var_dump(session_status() === PHP_SESSION_NONE); // est ce que session_status = PHP_SESSION_NONE voir doc les sessions sont activés mais y en a pas

session_start();

var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sessions</title>
</head>

<body>
  <a href="admin.php">Administration</a>
</body>

</html>

