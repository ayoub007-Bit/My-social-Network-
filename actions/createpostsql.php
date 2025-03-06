<?php

session_start();

require_once __DIR__. '/../config/sqlconstants.php'; //require_once permet d'inclure et d'évaluer le fichier spécifié lors de l'exécution du script
require_once __DIR__. '/../config/firstconnect.php';

$data= $_POST;
$_SESSION['error_post'] = "";

//ImageUrl pour le post 
function setupImageUrl($img, $temp): String {
    if (empty($img)) { return "";}
    $directory = '../actions/uploads/';
    $file = basename($img);
    $path = $directory . $file;
    $type = pathinfo($file, PATHINFO_EXTENSION);
    $allowTypes = array("jpg", "png", "gif", "jpeg", "mp4", "mov", "avi", "mkv");
    if (!is_dir($directory)) {return "";}
    if (!is_writable($directory)) {return "";}
    if (!in_array($type, $allowTypes)) {return "";}
    if (!is_file($temp)) {return "";}
    if (!move_uploaded_file($temp, $path)) {return "";}
    return $file;
}


//securisation du texte

function setupText($string): String {
    if(empty($string)) {return "";}
    return htmlspecialchars($string);
}

//envoi vers MySQL
if(isset($data['description']) && isset($_SESSION['currentUser']['userId']) ){

    $personID = $_SESSION['currentUser']['userId'];
    $image = setupImageUrl($_FILES['file']['name'], $_FILES['file']['tmp_name']);
    $text = setupText($data['description']);
    $post = $mysqlClient->prepare("INSERT INTO posts (personID, postContent, postImage) VALUES (?,?,?)");
    $post->execute([$personID, $text, $image]);

}else{
    $_SESSION['error_post'] = "Données manquantes";
}

header('Location: ../index.php');
exit();
?>