<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "playlist_maker";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Select the database
$conn->select_db($dbname);

// Read the SQL file
$sql = file_get_contents('config/schema.sql');

// Execute multi query
if ($conn->multi_query($sql)) {
    echo "Tables created successfully\n";
} else {
    echo "Error creating tables: " . $conn->error . "\n";
}

$conn->close();
?>