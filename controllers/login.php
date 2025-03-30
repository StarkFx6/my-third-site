<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);
require_once __DIR__ . '/../model/database.php'; // Підключення класу Database
function validatePost()
{
    $user = [
        "login" => isset($_POST["login"]) ? strip_tags(trim($_POST["login"])) : "",
        "pswd" => isset($_POST["pswd"]) ? $_POST["pswd"] : ""
    ];
    return (strlen($user["login"]) > 0 && strlen($user["pswd"]) > 0) ? $user : false;
}
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = "Невірний пароль або логін";
    $postUser = validatePost();
    
    if ($postUser) {
        $db = new Database("Products");
        if ($db->connect()) {
            $user = $db->readUser($postUser["login"]);
            if ($user &&  $user["Password"] == $postUser["pswd"]) {
                $_SESSION["name"] = $user["Login"];
                $_SESSION["admin"] = $db->isAdmin($user["ID"]);
                header("Location: ../model/site.php");
                exit();
            }
        }
    }
}
// Завантаження шаблону форми логіну
include __DIR__ . '/../templates/login_form.php';