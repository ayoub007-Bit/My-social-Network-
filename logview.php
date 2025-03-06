<form action="actions/login.php" method="post">
    <label for="email">
        <p>Email:</p>
        <input type="email" name="email" id="" placeholder="Enter your email">
    </label>
    <label for="password">
        <p>Password: </p>
        <input type="password" name="password" id="" placeholder="Enter your password">
    </label>
    <button type="submit" class="logandsign">Log in</button>
    <p><?php echo $_SESSION['error'] ?? "" ?></p>
    
</form>