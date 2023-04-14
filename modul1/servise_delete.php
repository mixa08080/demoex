<?php
    include "check_admin.php";
	include "connect.php";
	$id = $_GET["id"];

	$connect->query(sprintf("DELETE FROM `services` WHERE `id`='%s'", $id));

	http_response_code(200);
    header("Content-Type: application/json");
    echo ('{
		"message": "Service removed"
}');