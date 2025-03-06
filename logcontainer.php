<?php if(isset($_SESSION['currentUser'])) :?>
    <h1 class="welcome"> &nbsp &nbsp Welcome <?php echo $_SESSION['currentUser']['firstname']?></h1>
    <?php else : ?>
        <div class="container">
            <div class="buttons">
                <a href="index.php?log=connect"><button>Log in</button></a>
                <a href="index.php?log=create"><button>Sign up</button></a>
            </div>
            <hr>
                <?php if(isset($_GET['log']) && $_GET['log'] == "create") : ?>       
                    <?php require_once __DIR__. "/createuser.php"; ?> 
                <?php else: ?>
                    <?php require_once __DIR__. "/logview.php"; ?>
                <?php endif; ?> 
        </div>
        <?php endif; ?>    