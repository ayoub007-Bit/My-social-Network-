
<?php
    session_start(); //Démarrer session pour voir si l'utilisateur est connecté

    //mise en place de la connexion à la base de donnée mysql *

    require_once __DIR__. '/config/sqlconstants.php'; //require_once permet d'inclure et d'évaluer le fichier spécifié lors de l'exécution du script
    require_once __DIR__. '/config/firstconnect.php';
    require_once __DIR__. '/config/queries.php';
    require_once __DIR__. '/logic/data_handler.php';
 

?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MysocialNetwork</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

    <?php require_once __DIR__. '/header.php';
          require_once __DIR__. '/logcontainer.php';
     //ensures that the path is correct ?>
       <?php require_once __DIR__. '/newpost.php';?>

       <?php if(isset($_SESSION['currentUser'])) : ?>
                <?php foreach($postComplet as $post) : ?>
                    <?php 
                    $id = $post['postID'];
                    $firstname = $post['firstname'];
                    $lastname = $post['lastname'];
                    $userId = $post['userID'];
                    $profilePicture = $post['profilePic'];
                    $postDate = $post['postDate'];
                    $postContent = $post['postContent'];
                    $postImage = $post['postImage'];
                    echo createPost($post, $id, $firstname, $lastname, $profilePicture) ?>
                <?php endforeach; ?> 
        <?php endif; ?>

    <?php require_once __DIR__. '/footer.php';?>  

</body>
</html>