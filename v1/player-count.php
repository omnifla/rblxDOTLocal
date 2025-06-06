<?php header("Content-Type: application/json");
<<<<<<< HEAD
$placeId = (int) $_GET['placeId'];
include($_SERVER['DOCUMENT_ROOT'] . '/SOAP.php');
$playercount = json_decode(PlayerCount($placeId))->Value;
$jsondata = array('PlayerCount' => $playercount);
=======
$placeId = (int)$_GET['placeId'];
include ($_SERVER['DOCUMENT_ROOT'].'/SOAP.php');
$playercount = json_decode(PlayerCount($placeId))->Value;
$jsondata = array('PlayerCount'=>$playercount);
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
echo json_encode($jsondata);