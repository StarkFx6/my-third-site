<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);
require "database.php";
$database = new Database("Products");
$database->connect();
// Перевірка чи користувач авторизований
if (isset($_SESSION["name"])) {
    $currentUser = $_SESSION["name"];
    $isAdmin = $_SESSION["admin"];
} else {
    header("Location: ../index.php");
    exit();
}
$result = $database->readAll();
include __DIR__ . '/../templates/main_site.php';
?>