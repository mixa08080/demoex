<?php
session_start();
include "check.php";
include "connect.php";
$sql = sprintf( "SELECT * FROM `cart` WHERE `user_id`=%s", $_SESSION["user_id"]);
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->error);

$data = "";
while ($row = $result->fetch_assoc()) {
    $sql =  sprintf( "SELECT * FROM `services` WHERE `id`=%s",$row["service_id"]);

    if (!$services = $connect->query($sql))
        return die("Ошибка получения данных: " . $connect->error);


    while($service = $services->fetch_assoc()){
    $data .= sprintf('{
        "id": %s,
        "name": "%s",
        "description": "%s",
        "price": %s
    },', $service["id"], $service["name"], $service["description"], $service["price"]);
}
}
http_response_code(200);
header("Content-Type: application/json");
echo ('{"data": [' . substr($data, 0, -1) . '
    ]
}');