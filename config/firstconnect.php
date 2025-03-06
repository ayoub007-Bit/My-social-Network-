<?php 
//try tente d'exécuter le code entre les accolades
try {
    //new PDO = new PHP Data Object crée une connexion à la base de donnée
    /*and because it's a class, we use the keyword new and every-time 
    we use want to use its properties or methodes we need to write ->*/
    $mysqlClient = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=utf8", $user, $password);

    //Activer l'affichage des erreurs PDO
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Créer la table users pour stocker les utilisateurs dés la première connexion à la base de donnée
    $userTable = "CREATE TABLE IF NOT EXISTS users (
        userID INT(11) NOT NULL AUTO_INCREMENT,
        password VARCHAR(200) NOT NULL,
        email VARCHAR(200) NOT NULL,
        firstname VARCHAR(255),
        lastname VARCHAR(255),
        profilePic VARCHAR(256),
        PRIMARY KEY (userID) /*clé primaire pour que chaque utilisateur ait un id unique*/
        );";

        $mysqlClient->exec($userTable); //cette fonc exec() permet d'exécuter une requête SQL

    $postTable = "CREATE TABLE IF NOT EXISTS posts (
        postID INT(11) NOT NULL AUTO_INCREMENT,
        personID INT(11),
        postContent TEXT NOT NULL,
        postImage VARCHAR(256),
        postDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
        PRIMARY KEY (postID), /*clé primaire pour que chaque post ait un id unique*/
        FOREIGN KEY (personID) REFERENCES  users(userID) /*clé etranger qui lie personID à userID*/
        );";

        $mysqlClient->exec($postTable);

    

}catch(Exception $e){ /*capture les erreurs PDO et le stock dans $e*/

    die('Erreur : ' . $e->getMessage()); /*die() affiche un message et termine le script courant*/
}


