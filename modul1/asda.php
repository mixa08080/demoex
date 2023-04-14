<?php
include "connect.php";
$sql = "SELECT * FROM `services`";
if (!$result = $connect->query($sql))
    return die("Ошибка получения данных: " . $connect->error);
print_r($result);