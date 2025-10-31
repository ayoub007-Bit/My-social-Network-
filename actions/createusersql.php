<?php
/*Ce fichier permet de créer un utilisateur dans la base de donnée 
  et il est liés a createuser.php*/

session_start();
require_once __DIR__ .'/../config/sqlconstants.php';
require_once __DIR__ .'/../config/connect.php';

$data = $_POST;

// Vérifier que tous les champs sont présents
if (isset($data['email']) && isset($data['password']) && isset($data['firstname']) && isset($data['lastname'])) {
    
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "L'adresse mail n'est pas valide";
        header('Location: ../createuser.php');
        exit();
    }
    
    $email = $data["email"];
    $password = $data["password"];
    $firstname = $data["firstname"];
    $lastname = $data["lastname"];
    
    // Vérifier si l'email existe déjà
    $checkQuery = $mysqlClient->prepare("SELECT * FROM users WHERE email=?");
    $checkQuery->execute([$email]);
    
    if ($checkQuery->fetch()) {
        $_SESSION['error'] = "Cet email est déjà utilisé";
        header('Location: ../createuser.php');
        exit();
    }
    
    // Créer le nouvel utilisateur (avec firstname et lastname au lieu de username)
    $usersQuery = $mysqlClient->prepare("INSERT INTO users (email, password, firstname, lastname, profilePic) VALUES (?, ?, ?, ?, ?)");
    $user = $usersQuery->execute([$email, $password, $firstname, $lastname, ""]);
    
    if ($user) {
        // Récupérer l'utilisateur créé
        $usersQuery = $mysqlClient->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $usersQuery->execute([$email, $password]);
        $userSelected = $usersQuery->fetch();
        
        if ($userSelected != null) {
            $_SESSION["currentUser"] = array(
                "firstname"=> $userSelected['firstname'],
                "lastname"=> $userSelected['lastname'],
                "email"=> $userSelected['email'],
                "password"=> $userSelected['password'],
                "profilePicture"=> $userSelected['profilePic'],
                "userId"=> $userSelected['userID']
            );
            $_SESSION['success'] = "Inscription réussie ! Bienvenue " . $firstname;
            // Redirection vers la page d'accueil après inscription réussie
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION["error"] = "Erreur lors de la récupération de l'utilisateur";
            header('Location: ../createuser.php');
            exit();
        }
    } else {
        $_SESSION["error"] = "Erreur lors de la création du compte";
        header('Location: ../createuser.php');
        exit();
    }
    
} else {
    $_SESSION['error'] = "Veuillez entrer tous les champs pour continuer";
    header('Location: ../createuser.php');
    exit();
}
?>