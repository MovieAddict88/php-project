<?php
require_once '../src/db.php';

// Fetch all playlists
$result = $conn->query("SELECT * FROM playlists ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>

    <h3>Add New Playlist</h3>
    <form action="index.php?page=admin_add_playlist" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>
        <input type="submit" value="Add Playlist">
    </form>

    <hr>

    <h3>Existing Playlists</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="100"></td>
            <td>
                <a href="index.php?page=admin_edit_playlist&id=<?php echo $row['id']; ?>">Edit</a>
                <a href="index.php?page=admin_manage_playlist&id=<?php echo $row['id']; ?>">Manage</a>
                <a href="index.php?page=admin_delete_playlist&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <a href="m3u8.php?id=<?php echo $row['id']; ?>" target="_blank">Share (M3U8)</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
