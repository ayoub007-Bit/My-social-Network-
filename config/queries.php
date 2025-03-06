
<?php


$query = 'SELECT posts.*, users.* FROM posts LEFT JOIN users ON posts.personID = users.userID ORDER BY posts.postDate DESC'; //cette requête permet de récupérer les posts et les utilisateurs associés
$postWithUsers = $mysqlClient->prepare($query);
$postWithUsers->execute();
$postComplet = $postWithUsers->fetchAll();
