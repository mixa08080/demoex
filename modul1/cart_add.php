<?php
	include "check.php";
	include "connect.php";

	$id = $_POST["service_id"];
	$connect->query(sprintf("INSERT INTO `cart` VALUES(null,'%s', '%s')", $_SESSION["user_id"], $id));
	
	http_response_code(201);
    header("Content-Type: application/json");
    echo ('{
		"message": "Service add to card"
}');