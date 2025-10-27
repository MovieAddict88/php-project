<?php
include 'header.php';
require_once '../src/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM playlists WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$playlist = $result->fetch_assoc();

$items_stmt = $conn->prepare("SELECT * FROM playlist_items WHERE playlist_id = ? ORDER BY id ASC");
$items_stmt->bind_param("i", $id);
$items_stmt->execute();
$items_result = $items_stmt->get_result();
$items = [];
while ($row = $items_result->fetch_assoc()) {
    $items[] = $row;
}

$can_play_all = false;
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
    $user_id = $_SESSION['user_id'];
    $user_stmt = $conn->prepare("SELECT free_playlist_id FROM users WHERE id = ?");
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user = $user_result->fetch_assoc();
    if ($user['free_playlist_id'] == $id) {
        $can_play_all = true;
    }
}
?>

<h2><?php echo htmlspecialchars($playlist['name']); ?></h2>
<p><?php echo htmlspecialchars($playlist['description']); ?></p>

<video id="player" width="100%" controls></video>

<h3>Playlist Items</h3>
<ul id="playlist-items">
    <?php foreach ($items as $index => $item): ?>
        <li>
            <?php if ($can_play_all || $index === 0): ?>
                <a href="#" data-src="<?php echo htmlspecialchars($item['url']); ?>">
                    <?php echo ($index + 1) . '. ' . basename($item['url']); ?>
                </a>
            <?php else: ?>
                <span>
                    <?php echo ($index + 1) . '. ' . basename($item['url']); ?>
                    (<a href="index.php?page=register">Register</a> to play)
                </span>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const player = document.getElementById('player');
    const playlistItems = document.querySelectorAll('#playlist-items a');
    let currentItem = 0;

    function loadTrack(index) {
        const item = playlistItems[index];
        if (item) {
            player.src = item.dataset.src;
            player.play();
            currentItem = index;
        }
    }

    playlistItems.forEach((item, index) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            loadTrack(index);
        });
    });

    player.addEventListener('ended', () => {
        if (currentItem < playlistItems.length - 1) {
            loadTrack(currentItem + 1);
        }
    });

    if (playlistItems.length > 0) {
        loadTrack(0);
    }
});
</script>

<?php include 'footer.php'; ?>
