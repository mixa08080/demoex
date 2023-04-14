<?php
include "connect.php";
$fio = htmlspecialchars(trim($_POST['fio']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

$errors='';
if ($fio==null ){
    $errors.='"fio": "field fio can not be blank",';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors.='"email": "field email was entered incorrectly",';
}
if (!ctype_alnum($password) || $password==null){
    $errors.='"password": "field password was entered incorrectly"';
}

if($errors==""){
$sql = sprintf("INSERT INTO `users` VALUES(NULL, '%s', '%s', '%s','%s')", $fio, $email, $password, "user");
if (!$connect->query($sql))
    return die("Ошибка добавления данных: " . $connect->error);
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["role"] = $user["role"];
    http_response_code(200);
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

