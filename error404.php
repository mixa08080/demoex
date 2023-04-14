<?php
    http_response_code(404);
    header ("Content-Type: application/json");
    echo('{
        "code": 404,
        "message": "Not found"
}');
