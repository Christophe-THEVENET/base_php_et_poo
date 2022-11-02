<?php

require_once 'Email.php';

try {
  $email = new Email("test@test.com");
  var_dump($email);
} catch (InvalidArgumentException $e) {
  echo $e->getCode(); // on attrappe l'erreur pour afficher que un message d'erreur a l utilisateur et non le message Fatal error natif qui fait peur.
}

