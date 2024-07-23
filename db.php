<?php
$host = 'localhost';
$dbname = 'attendance_system';
$username = 'your_username';
$password = 'your_password';

// Create a PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
