<?php
require_once '../config/config.php';
require_once '../src/db.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo "Playlist ID is required.";
    exit();
}

$playlist_id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT url FROM playlist_items WHERE playlist_id = ?");
$stmt->bind_param("i", $playlist_id);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: application/vnd.apple.mpegurl');
header('Content-Disposition: attachment; filename="playlist.m3u8"');

echo "#EXTM3U\n";

while ($row = $result->fetch_assoc()) {
    // For simplicity, we assume each item is a direct link to a media file.
    // A more complex M3U8 file might have more metadata.
    echo "#EXTINF:-1," . basename($row['url']) . "\n";
    echo $row['url'] . "\n";
}
