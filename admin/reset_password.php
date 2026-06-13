<?php
// ONE-TIME USE — DELETE THIS FILE AFTER USE
require_once '../db.php';

$username = 'admin';
$password = 'Renova@2025';
$hash     = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->fetch()) {
    $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = ?")->execute([$hash, $username]);
    echo "Password updated. <a href='login.php'>Login now</a>";
} else {
    $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)")->execute([$username, $hash]);
    echo "Admin created. <a href='login.php'>Login now</a>";
}
?>
