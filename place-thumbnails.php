<?php
set_time_limit(600);
<<<<<<< HEAD
if (!isset($_GET['placeId'])) {
    $getid = (int) $_SERVER['argv'][1];
} else {
    $getid = (int) $_GET['placeId'];
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/SOAP.php");
=======
$_SERVER['DOCUMENT_ROOT'] = 'C:\wamp64\www';
if(!isset($_GET['placeId'])){
$getid = (int)$_SERVER['argv'][1];
}else{
$getid = (int)$_GET['placeId'];
}
include_once($_SERVER['DOCUMENT_ROOT']."/SOAP.php");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
$query = $con->prepare('SELECT id,version,approved,active,name,generatedthumbnailhash,thumbnail1,thumb1approved,thumbnail2,thumb2approved,thumbnail3,thumb3approved,video,refreshthumbnail,description,creatorid,created,updated,MaxPlayers,visits,currencyearned,banned,featured,AvatarType,likes,dislikes FROM games WHERE id=:id');
$query->bindParam(':id', $getid);
$query->execute();
$game = $query->fetch();
header("Content-Type: image/png");
$thumb = $game['thumbnail1'];
$thumb2 = $game['generatedthumbnailhash'];
<<<<<<< HEAD
if ($thumb) {
    readfile($_SERVER['DOCUMENT_ROOT'] . "/img/games/thumb1for" . $getid . ".png");
}
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/thumbnails/" . $thumb2 . ".png")) {
    readfile($_SERVER['DOCUMENT_ROOT'] . gamethumbnail($getid));
} else {
    readfile($_SERVER['DOCUMENT_ROOT'] . "/thumbnails/" . $thumb2 . ".png");
=======
if($thumb) {
readfile($_SERVER['DOCUMENT_ROOT']."/img/games/thumb1for".$getid.".png");
}
if(!file_exists($_SERVER['DOCUMENT_ROOT']."/thumbnails/".$thumb2.".png")){
readfile($_SERVER['DOCUMENT_ROOT'].gamethumbnail($getid));
}else{
readfile($_SERVER['DOCUMENT_ROOT']."/thumbnails/".$thumb2.".png");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}