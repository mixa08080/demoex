<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	http_response_code(403);
	header("Content-Type: application/json");
	echo ('{
		“code”: 403,
		“message”: “Login failed”
   }');
}