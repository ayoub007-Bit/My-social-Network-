<?php 
//try tente d'exécuter le code entre les accolades
try {
    //new PDO = new PHP Data Object crée une connexion à la base de donnée
    $mysqlClient = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=utf8", $user, $password);

    //Activer l'affichage des erreurs PDO
    /*setAttribute() permet de définir un attribut(يصف) PDO maintenant
    on veut définir l'attribut ERRMODE à ERRMODE_EXCEPTION(qui est une des trois autres attr)*/
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(Exception $e){ /*capture les erreurs PDO et le stock dans $e*/

    die('Erreur : ' . $e->getMessage()); /*die() affiche un message et termine le script courant*/
}



?>