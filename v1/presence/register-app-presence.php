<<<<<<< HEAD
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/config/includes.php');
header("Content-Type: application/json");
$usr = getUserData($con);
$uID = $usr['id'];
$json = json_decode(file_get_contents("php://input"), true);
if ($json['location'] == "Home") {
    $statupdate = "UPDATE `users` SET `clientstatus` = 'Unknown' WHERE `id`=:uID";
    $stmt = $con->prepare($statupdate);
    $stmt->execute(array(':uID' => $uID));
    $statupdate = "UPDATE `users` SET `onlinetime` = :time WHERE `id`=:uID";
    $stmt = $con->prepare($statupdate);
    $stmt->execute(array(':time' => time(), ':uID' => $uID));
=======
<?php 
include ($_SERVER['DOCUMENT_ROOT'].'/config/includes.php');
header("Content-Type: application/json");
$usr = getUserData($con);
$uID = $usr['id'];
$json = json_decode(file_get_contents("php://input"),true);
if($json['location'] == "Home"){
$statupdate = "UPDATE `users` SET `clientstatus` = 'Unknown' WHERE `id`=:uID";
$stmt = $con->prepare($statupdate);
$stmt->execute(array(':uID' => $uID));
$statupdate = "UPDATE `users` SET `onlinetime` = :time WHERE `id`=:uID";
$stmt = $con->prepare($statupdate);
$stmt->execute(array(':time' => time(), ':uID' => $uID));
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
$statupdate = "UPDATE `users` SET `gametime` = :time WHERE `id`=:uID";
$stmt = $con->prepare($statupdate);
$stmt->execute(array(':time' => time(), ':uID' => $uID));
echo "{}";
?>