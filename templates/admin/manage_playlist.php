<?php
require_once '../src/db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM playlists WHERE id = $id");
$playlist = $result->fetch_assoc();

$items_result = $conn->query("SELECT * FROM playlist_items WHERE playlist_id = $id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Playlist</title>
</head>
<body>
    <h2>Manage Playlist: <?php echo htmlspecialchars($playlist['name']); ?></h2>

    <h3>Add New Item</h3>
    <form action="index.php?page=admin_add_playlist_item&id=<?php echo $id; ?>" method="post">
        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required><br><br>
        <input type="submit" value="Add Item">
    </form>

    <hr>

    <h3>Playlist Items</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $items_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['url']); ?></td>
            <td>
                <a href="index.php?page=admin_delete_playlist_item&id=<?php echo $row['id']; ?>&playlist_id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>