<?php
<<<<<<< HEAD

$json = json_decode(file_get_contents("php://input"), true);
$placeId = (int) $json['placeId'];
$_GET['placeId'] = $placeId;
$_GET['request'] = "RequestGame";
require($_SERVER['DOCUMENT_ROOT'] . "/game/PlaceLauncher.ashx")

    ?>
=======
$json = json_decode(file_get_contents("php://input"),true);
$placeId = (int)$json['placeId'];
$_GET['placeId'] = $placeId;
$_GET['request'] = "RequestGame";
require($_SERVER['DOCUMENT_ROOT']."/game/PlaceLauncher.ashx")
?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
