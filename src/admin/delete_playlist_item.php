<?php
require_once '../../config/config.php';
require_once '../../src/db.php';

$id = $_GET['id'];
$playlist_id = $_GET['playlist_id'];

$sql = "DELETE FROM playlist_items WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: index.php?page=admin_manage_playlist&id=' . $playlist_id);
?>