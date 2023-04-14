<?php
include "connect.php";
include "check_admin.php";
$name = htmlspecialchars(trim($_POST['name']));
$description = htmlspecialchars(trim($_POST['description']));
$price = htmlspecialchars(trim($_POST['price']));

$errors='';
if ($name ==null){
    $errors.='"name": ["field name can not be blank"],';
}
if ($description ==null){
    $errors.='"description": ["field description can not be blank"],';
}
if (is_numeric($price) && $price==null){
    $errors.='"price": ["field price was entered incorrectly"]';
}

if($errors==""){
$sql = sprintf("INSERT INTO `servises` VALUES(NULL, '%s', '%s', '%s')", $name, $description, $price);
if (!$connect->query($sql))
    return die("Ошибка добавления данных: " . $connect->error);
    http_response_code(200);
    header("Content-Type: application/json");
    echo('{
        "message": "Service added"
}');
}
else{
    http_response_code(422);
    header("Content-Type: application/json");
    echo('{
        "code": 422,
        "errors": {
            '.$errors.'
        }
}');}
