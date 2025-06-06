<?php
<<<<<<< HEAD
require($_SERVER['DOCUMENT_ROOT'] . "/config/includes.php");
header("Content-Type: application/json");
$data = [
    "userPresences" => []
=======
require($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
header("Content-Type: application/json");
$data = [
"userPresences" => []
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
];
$jsonInput = file_get_contents("php://input");
$inputData = json_decode($jsonInput, true);
if (isset($inputData["userIds"]) && is_array($inputData["userIds"])) {
<<<<<<< HEAD
    foreach ($inputData["userIds"] as $userId) {
        $userquery = $con->prepare("SELECT * FROM `users` WHERE id = :id");
        $userquery->execute(['id' => $userId]);
        $user = $userquery->fetch();
        $lastonline = date("Y-m-d\TH:i:s\Z", $user['onlinetime']);
        $dif = time() - $user['onlinetime'];
        if ($dif < 120) {
            $type = 1;
        } else {
            $type = 0;
        }
        if ($dif < 120 && $user['clientstatus'] == 'AppStarted') {
            $gamequery = $con->prepare("SELECT id,name FROM `games` WHERE id = :id");
            $gamequery->execute(['id' => $user['InGameId']]);
            $game = $gamequery->fetch();
            $userPresence = [
                "userPresenceType" => 3,
                "lastLocation" => "Studio - " . $game['name'],
                "placeId" => $user['InGameId'],
                "rootPlaceId" => $user['InGameId'],
                "gameId" => $user['InJobId'],
                "universeId" => $user['InGameId'],
                "userId" => $userId,
                "lastOnline" => $lastonline
            ];
        } elseif ($dif < 120 && $user['clientstatus'] == 'InGame') {
            $gamequery = $con->prepare("SELECT id,name FROM `games` WHERE id = :id");
            $gamequery->execute(['id' => $user['InGameId']]);
            $game = $gamequery->fetch();
            $userPresence = [
                "userPresenceType" => 2,
                "lastLocation" => $game['name'],
                "placeId" => $user['InGameId'],
                "rootPlaceId" => $user['InGameId'],
                "gameId" => $user['InJobId'],
                "universeId" => $user['InGameId'],
                "userId" => $userId,
                "lastOnline" => $lastonline
            ];
        } else {
            $userPresence = [
                "userPresenceType" => $type,
                "lastLocation" => "Website",
                "placeId" => null,
                "rootPlaceId" => null,
                "gameId" => null,
                "universeId" => null,
                "userId" => $userId,
                "lastOnline" => $lastonline
            ];
        }
        $data["userPresences"][] = $userPresence;
    }
} else {
    echo json_encode(['success' => false], JSON_PRETTY_PRINT);
=======
foreach ($inputData["userIds"] as $userId) {
$userquery = $con->prepare("SELECT * FROM `users` WHERE id = :id");
$userquery->execute(['id' => $userId]);
$user = $userquery->fetch();
$lastonline = date("Y-m-d\TH:i:s\Z", $user['onlinetime']);
$dif = time() - $user['onlinetime'];
if($dif < 120){
$type = 1;
}else{
$type = 0;
}
if($dif < 120 && $user['clientstatus'] == 'AppStarted'){
$gamequery = $con->prepare("SELECT id,name FROM `games` WHERE id = :id");
$gamequery->execute(['id' => $user['InGameId']]);
$game = $gamequery->fetch();
$userPresence = [
"userPresenceType" => 3,
"lastLocation" => "Studio - ".$game['name'],
"placeId" => $user['InGameId'],
"rootPlaceId" => $user['InGameId'],
"gameId" => $user['InJobId'],
"universeId" => $user['InGameId'],
"userId" => $userId,
"lastOnline" => $lastonline
];
}
elseif($dif < 120 && $user['clientstatus'] == 'InGame'){
$gamequery = $con->prepare("SELECT id,name FROM `games` WHERE id = :id");
$gamequery->execute(['id' => $user['InGameId']]);
$game = $gamequery->fetch();
$userPresence = [
"userPresenceType" => 2,
"lastLocation" => $game['name'],
"placeId" => $user['InGameId'],
"rootPlaceId" => $user['InGameId'],
"gameId" => $user['InJobId'],
"universeId" => $user['InGameId'],
"userId" => $userId,
"lastOnline" => $lastonline
];
}else{
$userPresence = [
"userPresenceType" => $type,
"lastLocation" => "Website",
"placeId" => null,
"rootPlaceId" => null,
"gameId" => null,
"universeId" => null,
"userId" => $userId,
"lastOnline" => $lastonline
];
}
$data["userPresences"][] = $userPresence;
}
} else {
echo json_encode(['success' => false], JSON_PRETTY_PRINT);
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
echo json_encode($data, JSON_PRETTY_PRINT);
?>