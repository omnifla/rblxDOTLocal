<?php
header("Content-Type: application/json");
$jsonArray = array(
<<<<<<< HEAD
    "Url" => ":8443",
    "ConnectionToken" => "token",
    "ConnectionId" => "1",
    "KeepAliveTimeout" => 20.0,
    "DisconnectTimeout" => 30.0,
    "ConnectionTimeout" => 110.0,
    "TryWebSockets" => false,
    "ProtocolVersion" => "1.5",
    "TransportConnectTimeout" => 5.0,
    "LongPollDelay" => 0.0
);
$jsonString = json_encode($jsonArray, JSON_PRETTY_PRINT);
echo $jsonString;
?>
=======
"Url" => ":8443",
"ConnectionToken" => "token",
"ConnectionId" => "1",
"KeepAliveTimeout" => 20.0,
"DisconnectTimeout" => 30.0,
"ConnectionTimeout" => 110.0,
"TryWebSockets" => false,
"ProtocolVersion" => "1.5",
"TransportConnectTimeout" => 5.0,
"LongPollDelay" => 0.0
);
$jsonString = json_encode($jsonArray, JSON_PRETTY_PRINT);
echo $jsonString;
?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
