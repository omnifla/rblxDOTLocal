<?php
<<<<<<< HEAD
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/includes.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SOAP.php');
$logged = false;
if ($_COOKIE['password'] || $_COOKIE['_ROBLOSECURITY']) {
    $password = filter_var($_COOKIE['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $roblosec = filter_var($_COOKIE['_ROBLOSECURITY'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $usrquery = $con->prepare("SELECT * FROM `users` WHERE `password` = :password OR `ROBLOSECURITY` = :ROBLOSECURITY");
    $usrquery->execute(['password' => $password, 'ROBLOSECURITY' => $roblosec]);
    $usr = $usrquery->fetch();
    if (is_array($usr)) {
        $logged = true;
    } else {
        die("no.");
    }
} else {
    die("bro where are your cookies");
=======
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/includes.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/SOAP.php');
$logged = false;
if($_COOKIE['password'] || $_COOKIE['_ROBLOSECURITY']){
$password = filter_var($_COOKIE['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$roblosec = filter_var($_COOKIE['_ROBLOSECURITY'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$usrquery = $con->prepare("SELECT * FROM `users` WHERE `password` = :password OR `ROBLOSECURITY` = :ROBLOSECURITY");
$usrquery->execute(['password' => $password, 'ROBLOSECURITY' => $roblosec]);
$usr = $usrquery->fetch();
if(is_array($usr)){
$logged = true;
}else{
die("no.");
}
}else{
die("bro where are your cookies");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
$username = $usr['username'];
$uID = $usr['id'];
if ($usr['Admin'] === 0) {
<<<<<<< HEAD
    header('HTTP/1.0 403 Forbidden', true, 403);
    http_response_code(403);
    exit();
}
if ($usr['SuperAdmin'] === 0) {
    header('HTTP/1.0 403 Forbidden', true, 403);
    http_response_code(403);
    exit();
}
if ($_POST['text']) {
    $text = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $sql = "INSERT INTO `alerts` (`text`) VALUES (:text)";
    $stmt = $con->prepare($sql);
    $stmt->execute([':text' => $text]);
    header("Location: https://localhost/admi/?tab=WebsiteControl&item=Alerts");
} else {
    $sql = "DELETE FROM `alerts`";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    header("Location: https://localhost/admi/?tab=WebsiteControl&item=Alerts");
=======
header('HTTP/1.0 403 Forbidden', true, 403);
http_response_code(403);
exit();
}
if ($usr['SuperAdmin'] === 0) {
header('HTTP/1.0 403 Forbidden', true, 403);
http_response_code(403);
exit();
}
if($_POST['text']){
$text = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$sql = "INSERT INTO `alerts` (`text`) VALUES (:text)";
$stmt = $con->prepare($sql);
$stmt->execute([':text' => $text]);
header("Location: https://www.voidrev.us/admi/?tab=WebsiteControl&item=Alerts");
}else{
$sql = "DELETE FROM `alerts`";
$stmt = $con->prepare($sql);
$stmt->execute();
header("Location: https://www.voidrev.us/admi/?tab=WebsiteControl&item=Alerts");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}