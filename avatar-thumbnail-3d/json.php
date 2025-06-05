<?php header("Content-Type: application/json");
$userId = (int)$_GET['userId'];
?>
{"Url":"https://localhost/avatar-thumbnail-3d/?userId=<?=$userId;?>","Final":true}