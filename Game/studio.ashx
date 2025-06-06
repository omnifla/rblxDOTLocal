<?php
header("Content-Type: application/json");
include ($_SERVER['DOCUMENT_ROOT'].'/config/includes.php');
$roblosec = filter_var($_COOKIE['_ROBLOSECURITY'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$usrquery = $con->prepare("SELECT * FROM `users` WHERE `ROBLOSECURITY` = :ROBLOSECURITY");
$usrquery->execute(['ROBLOSECURITY' => $roblosec]);
$usr = $usrquery->fetch();
ob_start();
?>
<<<<<<< HEAD
{"PingReceiver":"","PingIntervalInSeconds":120,"UserId":"<?=$usr['id'];?>","MainGuiScriptID":37801172,"AssetUrl":"https://assetgame.voidrev.us/Asset/","BaseUrl":"http://localhost/","ApiProxyEndPoint":"https://localhost"}
=======
{"PingReceiver":"","PingIntervalInSeconds":120,"UserId":"<?=$usr['id'];?>","MainGuiScriptID":37801172,"AssetUrl":"https://assetgame.voidrev.us/Asset/","BaseUrl":"http://www.voidrev.us/","ApiProxyEndPoint":"https://www.voidrev.us"}
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
<?php
$data = "\r\n" . ob_get_clean();
$key = file_get_contents("./privatekey.pem");
openssl_sign($data, $sig, $key, OPENSSL_ALGO_SHA1);
echo "--rbxsig%" . base64_encode($sig) . "%" . $data;
?>