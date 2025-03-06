<?php
/*ce fichier permet de créer un utilisateur dans la base de donnée 
  et il est liés a createuser.php*/
 //Démarrer session pour voir si l'utilisateur est connecté


 session_start();
 require_once __DIR__ .'/../config/sqlconstants.php';
 require_once __DIR__ .'/../config/connect.php';
 
 $data = $_POST;
 
 if (isset($data['email']) && isset($data['password']) && isset($data['username'])) {
     if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
         $_SESSION['error'] = "L'adresse mail n'est pas valide";
     } else {
         $email = $data["email"];
         $password = $data["password"];
         $username = $data["username"];
 
         $usersQuery = $mysqlClient->prepare("INSERT INTO users (email, password, username, profilePic) VALUES (?, ?, ?, ?)");
         $user = $usersQuery->execute([$email, $password, $username, ""]);
         
         $usersQuery = $mysqlClient->prepare("SELECT * FROM users WHERE email=? AND password=?");
         $usersQuery->execute([$email, $password]);
         $userSelected = $usersQuery->fetch();
 
         if ($userSelected != null) {
             $_SESSION["error"] = "Nous avons réussi";
             $_SESSION["currentUser"] = array(
                 "firstname"=> $userSelected['firstname'],
                 "lastname"=> $userSelected['lastname'],
                 "email"=> $userSelected['email'],
                 "password"=> $userSelected['password'],
                 "profilePicture"=> $userSelected['profilePic'],
                 "userId"=> $userSelected['userID'],
             );
         } else {
             $_SESSION["error"] = "Nous n'avons pas pu récupérer l'utilisateur";
         }
 
     }
 } else {
     $_SESSION['error'] = "Veuillez entrer tous les champs pour continuer";
 }
 
 header('Location: ../index.php');
 exit();

