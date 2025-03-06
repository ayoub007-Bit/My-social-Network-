<?php require_once __DIR__."/logic/data_handler.php"?>
<?php if(isset($_SESSION['currentUser'])) : ?>
    <div class="container">
        <div class="new-post-top">
            <img src=<?php echo getImageUrl($_SESSION['currentUser']['profilePicture'] ?? null) ; ?> alt="" class="logo">
            <h3>What's new?</h3>
        </div>
        <form action="actions/createpostsql.php" method="POST" enctype="multipart/form-data" >
                <input type="file" name="file">
                <input type="text" name="description" placeholder="Description">
                <button type="submit" class="logandsign">OK</button>
        </form>
        <p><?php echo $_SESSION['error_post'] ?? "" ?></p>
    </div>
<?php else: ?>
        <h1>Veuillez vous connecter pour accéder au site</h1>
<?php endif; ?>
        