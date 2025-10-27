<?php
session_start();
require_once '../config/config.php';
require_once '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $free_playlist_id = $_POST['free_playlist_id'];

    $sql = "INSERT INTO users (username, password, free_playlist_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $password, $free_playlist_id);

    if ($stmt->execute()) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>