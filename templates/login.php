<?php include 'header.php'; ?>

<h2>Login</h2>

<form action="index.php?page=login_user" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<?php include 'footer.php'; ?>
