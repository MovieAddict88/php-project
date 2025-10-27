<?php
include 'header.php';
require_once '../src/db.php';

$result = $conn->query("SELECT id, name FROM playlists ORDER BY name ASC");
?>

<h2>Register</h2>

<form action="index.php?page=register_user" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="free_playlist_id">Choose your free playlist:</label>
    <select id="free_playlist_id" name="free_playlist_id">
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Register">
</form>

<?php include 'footer.php'; ?>
