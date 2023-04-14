<?php
session_start();
include "connect.php";
include "check.php";
$sql = sprintf( "SELECT * FROM `orders` WHERE `user_id`=%s", $_SESSION["user_id"]);
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->error);

$data = "";
while ($row = $result->fetch_assoc()) {
    $data .= sprintf('{
        "id": %s,
        "servises":[ %s ],
        "order_price": %s
    },', $row["id"], $row["service_ids"], $row["price"]);
}
http_response_code(200);
header("Content-Type: application/json");
echo ('{"data": [' . substr($data, 0, -1) . '
    ]
}');