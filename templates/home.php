<?php
include 'header.php';
require_once '../src/db.php';

$result = $conn->query("SELECT * FROM playlists ORDER BY id DESC");
?>

<h2>All Playlists</h2>

<div class="playlist-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="playlist-card">
            <a href="index.php?page=playlist&id=<?php echo $row['id']; ?>">
                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
            </a>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'footer.php'; ?>
