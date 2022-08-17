<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>PHP Studi</title>
</head>

<body style="background-color: #0d1328;color:azure; font-family:Verdana, Geneva, Tahoma, sans-serif; padding: 50px">
  <!-- Commentaire HTML -->
  <h1><?= "Hello Studi la meilleure école !" ?></h1>
  <main style="min-height: 80vh;">
    <?php
    const SOFTWARE_VERSION = 1;
    // Le égal '=' est un opérateur d'affectation
    // Il fonctionne de droite à gauche
    $age = 38;
    // Le point '.' est un opérateur de concaténation
    // On pourra chaîner l'affichage de plusieurs données à la suite
    echo 'J\'ai ' . $age . ' ans';
    ?>
    <br />
    <?php
    echo "J'ai $age ans";

    $numero = 1;
    echo "<br />" . $numero;
    $numero += 3; // Equivalent :  $numero = $numero + 3;
    echo "<br />" . $numero;
    $numero++; // Equivalent : $numero += 1;
    echo "<br />" . $numero;
    ?>

  </main>
  <footer>
    <p id="version">Version : <?= SOFTWARE_VERSION ?></p>
  </footer>
</body>





</html>