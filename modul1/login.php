<?php
session_start();
include "connect.php";
$sql = sprintf("SELECT * FROM `users` WHERE `email`='%s'", $_POST["email"]);
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->query);
if ($user = $result->fetch_assoc() && $user["password"] == $_POST["password"]) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["role"] = $user["role"];
    http_response_code(200);
} else {
    http_response_code(401);
    header("Content-Type: application/json");
    echo ('{
    "code": 401,
    "message": "Authentication failed"
}');
}