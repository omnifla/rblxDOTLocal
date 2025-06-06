<?php
header("Content-Type: text/plain");
$data = array(
"jobId" => "Test",
"status" => 2,
<<<<<<< HEAD
"joinScriptUrl" => "http://localhost/game/join2015.ashx?serverPort=53640&gameid=1&jobid=Test",
"authenticationUrl" => "http://localhost/Login/Negotiate.ashx",
=======
"joinScriptUrl" => "http://www.voidrev.us/game/join2015.ashx?serverPort=53640&gameid=1&jobid=Test",
"authenticationUrl" => "http://www.voidrev.us/Login/Negotiate.ashx",
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
"authenticationTicket" => $_COOKIE['_ROBLOSECURITY'],
"message" => null
);
$jsonData = json_encode($data);
echo $jsonData;
?>