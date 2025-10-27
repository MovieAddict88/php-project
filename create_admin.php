<?php
// Use this script to generate a hashed password for the admin user.
// Run this script from the command line: php create_admin.php <username> <password>
// Then, insert the username and hashed password into the `admins` table.

if ($argc < 3) {
    echo "Usage: php create_admin.php <username> <password>\n";
    exit(1);
}

$username = $argv[1];
$password = $argv[2];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo "Username: $username\n";
echo "Hashed Password: $hashed_password\n";
?>