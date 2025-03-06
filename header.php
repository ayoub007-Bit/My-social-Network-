<?php require_once __DIR__."/logic/data_handler.php"?>

<header>
    <a href="index.php"><h1>AYOUBTOPIA 🌟</h1></a>
    <a href="profile.php"><img src=<?php echo getImageUrl($_SESSION['currentUser']['profilePicture'] ?? null) ; ?> alt="" class="logo"></a>
</header>