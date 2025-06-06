<?php
header("Content-Type: application/json");
require($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
$userId = (int)$_GET['userId'];
<<<<<<< HEAD
echo json_encode(["Url" => "https://localhost".getUserHeadshotThumbnail($con,$userId)]);
=======
echo json_encode(["Url" => "https://www.voidrev.us".getUserHeadshotThumbnail($con,$userId)]);
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
?>