<?php
include "check.php";
include "connect.php";

$sql = sprintf("SELECT * FROM `cart` WHERE `user_id`=%s", $_SESSION["user_id"]);
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->error);
$ids = [];
while ($row = $result->fetch_assoc()) {
    array_push($ids[], $row["service_id"]);
}
$price = 0;
if ($ids != null) {
    $ids_string = implode(", ", $ids);

    while ($id = $ids) {
        $sql = sprintf("SELECT * FROM `services` WHERE `id`=%s", $id);
        while ($service = $result->fetch_assoc()) {
            $price+=$service["price"];
        }
    }

    $connect->query(sprintf("INSERT INTO `orders` VALUES(null,'%s', '%s ,%s')", $_SESSION["user_id"], $ids_string, $price));
    http_response_code(201);
    header("Content-Type: application/json");
    echo ('{
        "message": "Order is processed"
}
');
} else {
    http_response_code(422);
    header("Content-Type: application/json");
    echo ('{
        "code": 422,
        "message": "Cart is empty"
}
');
}