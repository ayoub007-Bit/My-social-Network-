<?php
session_start();

require_once __DIR__. '/config/sqlconstants.php'; 
require_once __DIR__. '/config/firstconnect.php';


$getDatas =$_GET;
$isMe = (empty($getDatas) || ($getDatas['userId'] == $_SESSION["currentUser"]['userId']));

$personId = ($isMe) ? $_SESSION["currentUser"]['userId']: $getDatas['userId'];
$firstname = ($isMe) ? $_SESSION['currentUser']['firstname']:  $getDatas['firstname'];
$lastname = ($isMe) ? $_SESSION['currentUser']['lastname']:  $getDatas['lastname'];
$profilePicture = ($isMe) ? $_SESSION['currentUser']['profilePicture']:  $getDatas['profilePicture'];

$query = "SELECT * FROM posts WHERE personID = ?";
$allPosts = $mysqlClient->prepare($query);
$allPosts->execute([$personId]);
$posts = $allPosts->fetchAll();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Mon Profile</title>
</head>
<body>
<?php require_once __DIR__.'/header.php' ?>

        <?php if ($isMe): ?>
                <div class="container">
                    <form action="actions/profilepicsql.php"  method = "post" enctype="multipart/form-data">
                        <p>Upload a profile picture</p>
                        <input type="file" name="file" id="">
                        <input type="submit" name="submit" id="" value = "Upload">  
                    </form>
                    <p><?php echo $_SESSION['upload'] ?? ""?></p>
                    <a href="actions/logout.php" class="disconnect">Log out</a>
                    <br>
                </div>
        <?php endif;?>
 <?php foreach($posts as $post): ?>
    <?php echo createPost($post, $personId, $firstname, $lastname, $profilePicture)?>
 <?php endforeach; ?>
    
<?php require_once __DIR__.'/footer.php' ?>
</body>
</html>