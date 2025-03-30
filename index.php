<?php
// Підключення файлу конфігурації бази даних
require_once 'model/database.php';
// Отримуємо параметр "action" з URL або встановлюємо значення за замовчуванням
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
// Шлях до контролера
$controllerPath = "controllers/login.php";
// Перевіряємо, чи існує файл контролера
if (file_exists($controllerPath)) {
    require_once $controllerPath;
} else {
    echo "404 - Page not found";
}
?>