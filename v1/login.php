<?php
<<<<<<< HEAD
function NOSpacesPlz($inputString)
{
    $inputString = strip_tags($inputString);
    return str_replace(' ', '_', $inputString);
}
include($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
$headers = getallheaders();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if ($user_agent == 'RobloxStudio/WinInet') {
    $options = [
        'cost' => 10,
    ];
    $analyticsdata = password_hash("BJ@ynVL+ZP2xT-h8rXTPv@9yCbfS8Z%rb_TkCE^T=SUycJVjh6gaf8=92W7nvFtU", PASSWORD_BCRYPT, $options);
    setcookie("browserTrackerIds", $analyticsdata, time() + (460800 * 30), "/", '.voidrev.us');
}
header('Content-Type: application/json; charset=UTF-8; X-Robots-Tag: noindex');
if ($_POST["username"] && $_POST["password"]) {
    $username = urldecode($_POST['username']);
    $con->quote($username);
    $password = urldecode($_POST['password']);
    $con->quote($password);
    if ($username && $password) {
        $checkquery = $con->prepare("SELECT * FROM `users` WHERE `username`= :username");
        $checkquery->execute(['username' => $username]);
        $check = $checkquery->fetch();
        $hash = $check['password'];
        $oldhash = $check['password'];
        if (password_verify($password, $hash)) {
            $options = [
                'cost' => 11,
            ];
            $hash = password_hash($password, PASSWORD_BCRYPT, $options);
            $sql = $con->prepare("UPDATE `users` SET `password`=:hash WHERE `password`=:oldhash");
            $sql->execute(['hash' => $hash, 'oldhash' => $oldhash]);
            $checkquery2 = $con->prepare("SELECT * FROM `users` WHERE `password`= :hash");
            $checkquery2->execute(['hash' => $hash]);
            $check2 = $checkquery2->fetch();
            $password = $hash;
        }
        if (!$check) {
            $errorMsg = [
                "message" => "Incorrect username."
            ];
            http_response_code(403);
            echo json_encode($errorMsg);
            exit();
        } elseif (!$check2) {
            $errorMsg = [
                "message" => "Incorrect password. Please try again."
            ];
            http_response_code(403);
            echo json_encode($errorMsg);
            exit();
        } else {
            $roblosec = $check['ROBLOSECURITY'];
            $uID = $check['id'];
            $banvalue = $check['banned'];
            if ($banvalue > 0) {
                $isbanned = true;
            } else {
                $isbanned = false;
            }
            setcookie("username", $username, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie("password", $password, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie(".ROBLOSECURITY", $roblosec, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie(".RBXID", $roblosec, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
            if (strpos($headers['User-Agent'], "Android") !== false || strpos($headers['User-Agent'], "iPhone") !== false) {
                ?>
                {"user":{"id":<?= $uID; ?>,"name":"<? echo NOSpacesPlz($username); ?>","displayName":"<? echo NOSpacesPlz($username); ?>"},"isBanned":<? if ($check2['banned'] > 0) {
                      echo "true";
                  } else {
                      echo "false";
                  } ?>}
                <?
                exit();
            }
            ?>
            {"user":{"id":<?= $uID; ?>,"name":"<? echo NOSpacesPlz($username); ?>","displayName":"<? echo NOSpacesPlz($username); ?>"},"isBanned":<? if ($check2['banned'] > 0) {
                  echo "true";
              } else {
                  echo "false";
              } ?>}
        <?php }
    }
    exit();
}
$data = json_decode(file_get_contents('php://input'), true);
if ($data["cvalue"] && $data["password"]) {
    $username = urldecode($data['cvalue']);
    $con->quote($username);
    $password = urldecode($data['password']);
    $con->quote($password);
    if ($username && $password) {
        $checkquery = $con->prepare("SELECT * FROM `users` WHERE `username`= :username");
        $checkquery->execute(['username' => $username]);
        $check = $checkquery->fetch();
        $hash = $check['password'];
        if (password_verify($password, $hash)) {
            $checkquery2 = $con->prepare("SELECT * FROM `users` WHERE `password`= :hash");
            $checkquery2->execute(['hash' => $hash]);
            $check2 = $checkquery2->fetch();
            $password = $hash;
        }
        if (!$check) {
            $errorMsg = [
                "message" => "Incorrect username."
            ];
            http_response_code(403);
            echo json_encode($errorMsg);
            exit();
        } elseif (!$check2) {
            $errorMsg = [
                "message" => "Incorrect password. Please try again."
            ];
            http_response_code(403);
            echo json_encode($errorMsg);
            exit();
        } else {
            $roblosec = $check['ROBLOSECURITY'];
            $uID = $check['id'];
            $banvalue = $check['banned'];
            if ($banvalue > 0) {
                $isbanned = true;
            } else {
                $isbanned = false;
            }
            setcookie("username", $username, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie("password", $password, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie(".ROBLOSECURITY", $roblosec, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie(".RBXID", $roblosec, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
            if (strpos($headers['User-Agent'], "Android") !== false || strpos($headers['User-Agent'], "iPhone") !== false) {
                ?>
                {"user":{"id":<?= $uID; ?>,"name":"<? echo NOSpacesPlz($username); ?>","displayName":"<? echo NOSpacesPlz($username); ?>"},"isBanned":<? if ($check2['banned'] > 0) {
                      echo "true";
                  } else {
                      echo "false";
                  } ?>}
                <?
                exit();
            }
            ?>
            {"user":{"id":<?= $uID; ?>,"name":"<? echo NOSpacesPlz($username); ?>","displayName":"<? echo NOSpacesPlz($username); ?>"},"isBanned":<? if ($check2['banned'] > 0) {
                  echo "true";
              } else {
                  echo "false";
              } ?>}
        <?php }
    }
    exit();
} else {
}
$data = json_decode(file_get_contents('php://input'), true);
if ($data["username"] && $data["password"]) {
    $username = urldecode($data['username']);
    $con->quote($username);
    $password = urldecode($data['password']);
    $con->quote($password);
    if ($username && $password) {
        $checkquery = $con->prepare("SELECT * FROM `users` WHERE `username`= :username");
        $checkquery->execute(['username' => $username]);
        $check = $checkquery->fetch();
        $hash = $check['password'];
        if (password_verify($password, $hash)) {
            $checkquery2 = $con->prepare("SELECT * FROM `users` WHERE `password`= :hash");
            $checkquery2->execute(['hash' => $hash]);
            $check2 = $checkquery2->fetch();
            $password = $hash;
        }
        if (!$check) {
            $errorMsg = [
                "message" => "Incorrect username."
            ];
            http_response_code(403);
            echo json_encode($errorMsg);
            exit();
        } elseif (!$check2) {
            $errorMsg = [
                "message" => "Incorrect password. Please try again."
            ];
            http_response_code(403);
            echo json_encode($errorMsg);
            exit();
        } else {
            $roblosec = $check['ROBLOSECURITY'];
            $uID = $check['id'];
            $banvalue = $check['banned'];
            if ($banvalue > 0) {
                $isbanned = true;
            } else {
                $isbanned = false;
            }
            setcookie("username", $username, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie("password", $password, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie(".ROBLOSECURITY", $roblosec, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie(".RBXID", $roblosec, time() + (460800 * 30), "/", '.voidrev.us');
            setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
            if (strpos($headers['User-Agent'], "Android") !== false || strpos($headers['User-Agent'], "iPhone") !== false) {
                ?>
                {"user":{"id":<?= $uID; ?>,"name":"<? echo NOSpacesPlz($username); ?>","displayName":"<? echo NOSpacesPlz($username); ?>"},"isBanned":<? if ($check2['banned'] > 0) {
                      echo "true";
                  } else {
                      echo "false";
                  } ?>}
                <?
                exit();
            }
            ?>
            {"user":{"id":<?= $uID; ?>,"name":"<? echo NOSpacesPlz($username); ?>","displayName":"<? echo NOSpacesPlz($username); ?>"},"isBanned":<? if ($check2['banned'] > 0) {
                  echo "true";
              } else {
                  echo "false";
              } ?>}
        <? }
    }
    exit();
} else {
} ?>
=======
function NOSpacesPlz($inputString){
$inputString = strip_tags($inputString);
return str_replace(' ', '_', $inputString);
}
include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
$headers = getallheaders();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if($user_agent == 'RobloxStudio/WinInet') {
$options = [
'cost' => 10,
];
$analyticsdata = password_hash("BJ@ynVL+ZP2xT-h8rXTPv@9yCbfS8Z%rb_TkCE^T=SUycJVjh6gaf8=92W7nvFtU", PASSWORD_BCRYPT, $options);
setcookie("browserTrackerIds", $analyticsdata, time() + (460800* 30), "/", '.voidrev.us');
}
header('Content-Type: application/json; charset=UTF-8; X-Robots-Tag: noindex');
if($_POST["username"] && $_POST["password"]){
$username = urldecode($_POST['username']);
$con->quote($username);
$password = urldecode($_POST['password']);
$con->quote($password);
if($username && $password){
$checkquery = $con->prepare("SELECT * FROM `users` WHERE `username`= :username");
$checkquery->execute(['username' => $username]);
$check = $checkquery->fetch();
$hash = $check['password'];
$oldhash = $check['password'];
if (password_verify($password, $hash)) {
$options = [
'cost' => 11,
];
$hash = password_hash($password, PASSWORD_BCRYPT, $options);
$sql = $con->prepare("UPDATE `users` SET `password`=:hash WHERE `password`=:oldhash");
$sql->execute(['hash' => $hash, 'oldhash' => $oldhash]);
$checkquery2 = $con->prepare("SELECT * FROM `users` WHERE `password`= :hash");
$checkquery2->execute(['hash' => $hash]);
$check2 = $checkquery2->fetch();
$password = $hash;
}
if(!$check){
$errorMsg = [
"message" => "Incorrect username."
];
http_response_code(403);
echo json_encode($errorMsg);
exit();
}elseif(!$check2){
$errorMsg = [
"message" => "Incorrect password. Please try again."
];
http_response_code(403);
echo json_encode($errorMsg);
exit();
}else{
$roblosec = $check['ROBLOSECURITY'];
$uID = $check['id'];
$banvalue = $check['banned'];
if($banvalue > 0)
{$isbanned = true;
}else{$isbanned = false;}
setcookie("username", $username, time() + (460800* 30), "/", '.voidrev.us');
setcookie("password", $password, time() + (460800* 30), "/", '.voidrev.us');
setcookie(".ROBLOSECURITY", $roblosec, time() + (460800* 30), "/", '.voidrev.us');
setcookie(".RBXID", $roblosec, time() + (460800* 30), "/", '.voidrev.us');
setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
if (strpos($headers['User-Agent'], "Android") !== false || strpos($headers['User-Agent'], "iPhone") !== false) {
?>
{"user":{"id":<?=$uID;?>,"name":"<?echo NOSpacesPlz($username);?>","displayName":"<?echo NOSpacesPlz($username);?>"},"isBanned":<?if($check2['banned'] > 0){echo"true";}else{echo"false";}?>}
<?
exit();
}
?>
{"user":{"id":<?=$uID;?>,"name":"<?echo NOSpacesPlz($username);?>","displayName":"<?echo NOSpacesPlz($username);?>"},"isBanned":<?if($check2['banned'] > 0){echo"true";}else{echo"false";}?>}
<?php }}exit();}
$data = json_decode(file_get_contents('php://input'), true);
if($data["cvalue"] && $data["password"]){
$username = urldecode($data['cvalue']);
$con->quote($username);
$password = urldecode($data['password']);
$con->quote($password);
if($username && $password){
$checkquery = $con->prepare("SELECT * FROM `users` WHERE `username`= :username");
$checkquery->execute(['username' => $username]);
$check = $checkquery->fetch();
$hash = $check['password'];
if (password_verify($password, $hash)) {
$checkquery2 = $con->prepare("SELECT * FROM `users` WHERE `password`= :hash");
$checkquery2->execute(['hash' => $hash]);
$check2 = $checkquery2->fetch();
$password = $hash;
}
if(!$check){
$errorMsg = [
"message" => "Incorrect username."
];
http_response_code(403);
echo json_encode($errorMsg);
exit();
}elseif(!$check2){
$errorMsg = [
"message" => "Incorrect password. Please try again."
];
http_response_code(403);
echo json_encode($errorMsg);
exit();
}else{
$roblosec = $check['ROBLOSECURITY'];
$uID = $check['id'];
$banvalue = $check['banned'];
if($banvalue > 0)
{$isbanned = true;
}else{$isbanned = false;}
setcookie("username", $username, time() + (460800* 30), "/", '.voidrev.us');
setcookie("password", $password, time() + (460800* 30), "/", '.voidrev.us');
setcookie(".ROBLOSECURITY", $roblosec, time() + (460800* 30), "/", '.voidrev.us');
setcookie(".RBXID", $roblosec, time() + (460800* 30), "/", '.voidrev.us');
setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
if (strpos($headers['User-Agent'], "Android") !== false || strpos($headers['User-Agent'], "iPhone") !== false) {
?>
{"user":{"id":<?=$uID;?>,"name":"<?echo NOSpacesPlz($username);?>","displayName":"<?echo NOSpacesPlz($username);?>"},"isBanned":<?if($check2['banned'] > 0){echo"true";}else{echo"false";}?>}
<?
exit();
}
?>
{"user":{"id":<?=$uID;?>,"name":"<?echo NOSpacesPlz($username);?>","displayName":"<?echo NOSpacesPlz($username);?>"},"isBanned":<?if($check2['banned'] > 0){echo"true";}else{echo"false";}?>}
<?php }}exit();}else{}
$data = json_decode(file_get_contents('php://input'), true);
if($data["username"] && $data["password"]){
$username = urldecode($data['username']);
$con->quote($username);
$password = urldecode($data['password']);
$con->quote($password);
if($username && $password){
$checkquery = $con->prepare("SELECT * FROM `users` WHERE `username`= :username");
$checkquery->execute(['username' => $username]);
$check = $checkquery->fetch();
$hash = $check['password'];
if (password_verify($password, $hash)) {
$checkquery2 = $con->prepare("SELECT * FROM `users` WHERE `password`= :hash");
$checkquery2->execute(['hash' => $hash]);
$check2 = $checkquery2->fetch();
$password = $hash;
}
if(!$check){
$errorMsg = [
"message" => "Incorrect username."
];
http_response_code(403);
echo json_encode($errorMsg);
exit();
}elseif(!$check2){
$errorMsg = [
"message" => "Incorrect password. Please try again."
];
http_response_code(403);
echo json_encode($errorMsg);
exit();
}else{
$roblosec = $check['ROBLOSECURITY'];
$uID = $check['id'];
$banvalue = $check['banned'];
if($banvalue > 0)
{$isbanned = true;
}else{$isbanned = false;}
setcookie("username", $username, time() + (460800* 30), "/", '.voidrev.us');
setcookie("password", $password, time() + (460800* 30), "/", '.voidrev.us');
setcookie(".ROBLOSECURITY", $roblosec, time() + (460800* 30), "/", '.voidrev.us');
setcookie(".RBXID", $roblosec, time() + (460800* 30), "/", '.voidrev.us');
setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
if (strpos($headers['User-Agent'], "Android") !== false || strpos($headers['User-Agent'], "iPhone") !== false) {
?>
{"user":{"id":<?=$uID;?>,"name":"<?echo NOSpacesPlz($username);?>","displayName":"<?echo NOSpacesPlz($username);?>"},"isBanned":<?if($check2['banned'] > 0){echo"true";}else{echo"false";}?>}
<?
exit();
}
?>
{"user":{"id":<?=$uID;?>,"name":"<?echo NOSpacesPlz($username);?>","displayName":"<?echo NOSpacesPlz($username);?>"},"isBanned":<?if($check2['banned'] > 0){echo"true";}else{echo"false";}?>}
<? }}exit();}else{} ?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
