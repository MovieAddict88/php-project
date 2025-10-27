<!DOCTYPE html>
<html>
<head>
    <title>Playlist App</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="manifest" href="manifest.json">
</head>
<body>
    <header>
        <h1><a href="index.php">Playlist App</a></h1>
        <nav>
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="index.php?page=logout">Logout</a>
            <?php else: ?>
                <a href="index.php?page=login">Login</a>
                <a href="index.php?page=register">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>