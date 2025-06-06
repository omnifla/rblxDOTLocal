<?php
include ($_SERVER['DOCUMENT_ROOT'].'/config/includes.php');
$getid = (int)$_REQUEST['PlaceId'];
$gamequery = $con->prepare("SELECT id,name FROM `games` WHERE `id` = :id");
$gamequery->bindValue(':id', $getid, PDO::PARAM_INT);
$gamequery->execute();
$game = $gamequery->fetch(PDO::FETCH_ASSOC);
<<<<<<< HEAD
header("Location: https://localhost/games/".$getid."/".NoXSSPlz(str_replace(" ","-",$game['name'])));
=======
header("Location: https://www.voidrev.us/games/".$getid."/".NoXSSPlz(str_replace(" ","-",$game['name'])));
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
?>