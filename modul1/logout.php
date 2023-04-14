<?php
    include "check.php";
    unset($_SESSION["user_id"]);
    unset($_SESSION["role"]);
    http_response_code(200);
    header("Content-Type: application/json");
    echo ('{
        "message": "logout"
}
');