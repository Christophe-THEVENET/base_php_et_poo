<?php

require_once 'functions.php';

// Déconnexion
session_start();
$_SESSION = []; // on vide le tableau de sessions
session_destroy(); // on detruit la session
// Redirection vers la page d'accueil
redirect('index.php');

