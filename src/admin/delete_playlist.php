<?php
require_once '../../config/config.php';
require_once '../../src/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM playlists WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: index.php?page=admin_dashboard');
?>