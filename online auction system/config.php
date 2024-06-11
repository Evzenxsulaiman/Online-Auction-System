<?php
$host = 'localhost';
$db = 'auction_system1';
$user = 'admin321';
$pass = 'Passwordkoto2k24'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
