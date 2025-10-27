<?php
require_once '../../config/config.php';
require_once '../../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playlist_id = $_GET['id'];
    $url = $_POST['url'];

    $sql = "INSERT INTO playlist_items (playlist_id, url) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $playlist_id, $url);
    $stmt->execute();

    header('Location: index.php?page=admin_manage_playlist&id=' . $playlist_id);
}
?>