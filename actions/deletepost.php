<?php  
session_start();
require_once __DIR__. '/../config/sqlconstants.php'; //require_once permet d'inclure et d'évaluer le fichier spécifié lors de l'exécution du script
require_once __DIR__. '/../config/firstconnect.php';

$get = $_GET;

if(isset($get["postId"]) && isset($get['userId'])){
    if($get['userId'] == $_SESSION['currentUser']['userId'])
    $deletePost = $mysqlClient->prepare('DELETE FROM posts WHERE postID=?');
    $deletePost->execute([(int) $get['postId']]);
}


header("Location: ../index.php");
exit();
?>