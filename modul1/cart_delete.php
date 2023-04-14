<?php
	include "check.php";
	include "connect.php";
	$id = $_GET["id"];

	$connect->query(sprintf("DELETE FROM `cart` WHERE `id`='%s'", $id));

	http_response_code(200);
    header("Content-Type: application/json");
    echo ('{
		"message": "Item removed from cart"
}');