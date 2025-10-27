<?php
require_once '../src/db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM playlists WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$playlist = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Playlist</title>
</head>
<body>
    <h2>Edit Playlist</h2>
    <form action="index.php?page=admin_update_playlist&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($playlist['name']); ?>" required><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($playlist['description']); ?></textarea><br><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        <img src="uploads/<?php echo htmlspecialchars($playlist['image']); ?>" width="100"><br><br>
        <input type="submit" value="Update Playlist">
    </form>
</body>
</html>