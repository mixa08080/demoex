<?php
include "connect.php";
include "check_admin.php";
$id = htmlspecialchars(trim($_POST['id']));
$name = htmlspecialchars(trim($_POST['name']));
$description = htmlspecialchars(trim($_POST['description']));
$price = htmlspecialchars(trim($_POST['price']));

$sql = sprintf("SELECT * FROM `services` WHERE `id` = '%s')", $id);
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->error);
while ($row = $result->fetch_assoc()) {
    if (!isset($_POST['name']))
        $name = $row["name"];
    if (!isset($_POST['description']))
        $description = $row["description"];
    if (!isset($_POST['price']))
        $price = $row["price"];
}

$sql = sprintf("INSERT INTO `servises` VALUES(NULL, '%s', '%s', '%s')", $name, $description, $price);
if (!$connect->query($sql))
    return die("Ошибка добавления данных: " . $connect->error);
http_response_code(200);
header("Content-Type: application/json");
echo (sprintf('{
    "id": %s,
    "name": "%s",
    "description": "%s",
    "price": %s

}',$id,$name,$description,$price));