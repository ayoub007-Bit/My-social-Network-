<?php

session_start(); //Démarrer session pour voir si l'utilisateur est connecté
session_unset(); //Détruit toutes les variables de session
session_destroy(); //Détruit la session
header("Location: ../index.php"); //redirige l'utilisateur vers la page d'accueil
exit(); //termine le script courant