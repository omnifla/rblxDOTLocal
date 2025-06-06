<?php
<<<<<<< HEAD
include($_SERVER['DOCUMENT_ROOT'] . '/config/includes.php');
=======
include ($_SERVER['DOCUMENT_ROOT'].'/config/includes.php');
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
header("Content-Type: application/json");
$url = $_SERVER['REQUEST_URI'];
preg_match_all('/userIds=(\d+)/', $url, $matches);
$userIds = isset($matches[1]) ? $matches[1] : array();
$newData = array();
foreach ($userIds as $userId) {
<<<<<<< HEAD
    $userId = (int) $userId;
    $hash = getUserHeadshotThumbnail($con, $userId);
    $newData[] = array(
        "targetId" => $userId,
        "state" => "Completed",
        "imageUrl" => "https://localhost" . $hash
    );
}
$response = array(
    "data" => $newData
);
echo json_encode($response, JSON_PRETTY_PRINT);
?>
=======
$userId = (int)$userId;
$hash = getUserHeadshotThumbnail($con,$userId);
$newData[] = array(
"targetId" => $userId,
"state" => "Completed",
"imageUrl" => "https://www.voidrev.us".$hash
);
}
$response = array(
"data" => $newData
);
echo json_encode($response, JSON_PRETTY_PRINT);
?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
