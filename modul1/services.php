<?php
session_start();
include "connect.php";
$sql = "SELECT * FROM `services`";
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->error);

$data = "";
while ($row = $result->fetch_assoc())
    $data .= sprintf('{
        "id": %s,
        "name": "%s",
        "description": "%s",
        "price": %s
    },', $row["id"], $row["name"], $row["description"], $row["price"]);

http_response_code(200);
header("Content-Type: application/json");
echo ('"data": [' . substr($data, 0, -1) . '
    ]
}
');