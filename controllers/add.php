<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);
// Перевіряємо, чи користувач авторизований
if (!isset($_SESSION["name"])) {
    header("Location: ../index.php");
    exit();
}
// Перевіряємо, чи користувач є адміністратором
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
    header("Location: ../model/site.php");
    exit();
}
// Підключаємо клас Database
require_once __DIR__ . '/../model/database.php';
$database = new Database("Products");
$database->connect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $producer = $_POST['producer'];
    $price = $_POST['price'];
    // Додаємо новий товар
    if ($database->insert($name, $country, $producer, $price)) {
        header('Location: ../model/site.php'); // Перенаправляємо на головну сторінку після успішного додавання
        exit();
    } else {
        echo "Помилка при додаванні товару.";
    }

}
include __DIR__ . '/../templates/add_items.html';
?>
