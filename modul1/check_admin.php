<?php
	include "check.php";
	if($_SESSION["role"] != "admin"){
		http_response_code(403);
		header("Content-Type: application/json");
		echo ('{
			“code”: 403,
			“message”: “Forbidden for you”
	   }');}