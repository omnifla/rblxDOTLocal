<?php include ($_SERVER['DOCUMENT_ROOT'].'/config/includes.php');
$logged = false;
if($_COOKIE['username'] && $_COOKIE['password']){
$username = filter_var($_COOKIE['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$password = filter_var($_COOKIE['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$roblosec = filter_var($_COOKIE['_ROBLOSECURITY'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$usrquery = $con->prepare("SELECT * FROM `users` WHERE `username` = :username AND `password` = :password OR `ROBLOSECURITY` = :ROBLOSECURITY");
$usrquery->execute(['username' => $username, 'password' => $password, 'ROBLOSECURITY' => $roblosec]);
$usr = $usrquery->fetch();
if($usr != 0){
$logged = true;
}else{
echo "Not authenticated";
http_response_code(403);
exit();
}
}else{
echo "Not authenticated";
http_response_code(403);
exit();
}
if($usr['banned'] > 0){
echo "Not authenticated";
http_response_code(403);
exit();
}
$uID = $usr['id'];
$placeId = (int)$_POST['placeId'];
if(isset($_GET['placeId'])){
$placeId = (int)$_GET['placeId'];
}
function getFreeId(){
global $con;
// Get the maximum value from the library table
$libraryQuery = $con->prepare("SELECT MAX(id) AS max_id FROM library");
$libraryQuery->execute();
$libraryMaxId = $libraryQuery->fetch(PDO::FETCH_ASSOC)['max_id'];
// Get the maximum value from the games table
$gamesQuery = $con->prepare("SELECT MAX(id) AS max_id FROM games");
$gamesQuery->execute();
$gamesMaxId = $gamesQuery->fetch(PDO::FETCH_ASSOC)['max_id'];
// Find the maximum of the two maximum values
$maxId = max($libraryMaxId, $gamesMaxId);
// Increment the maximum value until no rows exist in library or games with that id
$nextId = $maxId + 1;
while (true) {
$libraryCheckQuery = $con->prepare("SELECT COUNT(*) AS count FROM library WHERE id = :id OR fileid = :fileid OR realfileid = :realfileid");
$libraryCheckQuery->execute(array(':id' => $nextId, ':fileid' => $nextId, ':realfileid' => $nextId));
$libraryCount = $libraryCheckQuery->fetch(PDO::FETCH_ASSOC)['count'];
$gamesCheckQuery = $con->prepare("SELECT COUNT(*) AS count FROM games WHERE id = :id");
$gamesCheckQuery->execute(array(':id' => $nextId));
$gamesCount = $gamesCheckQuery->fetch(PDO::FETCH_ASSOC)['count'];
if ($libraryCount == 0 && $gamesCount == 0) {
// No rows found in both library and games, use $nextId as the new ID
break;
}
$nextId++;
}
return $nextId;
}
$gamequery = $con->prepare("SELECT id,name,creatorid,description FROM `games` WHERE `id` = :id AND `creatorid`= :creatorid");
$gamequery->execute(['id' => $placeId, 'creatorid' => $uID]);
$games = $gamequery->fetch();
$name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
if(isset($_POST['placeId'])){
if(!is_array($games)){
$gamequery = $con->prepare("SELECT count(id) FROM `games` WHERE `creatorid`= :creatorid");
$gamequery->execute(['creatorid' => $uID]);
$gamecount = $gamequery->fetchColumn();
$gamequery = $con->prepare("SELECT id, created FROM `games` WHERE `creatorid` = :creatorid ORDER BY created LIMIT 1");
$gamequery->execute(['creatorid' => $uID]);
$gamecreated = $gamequery->fetch();
if (($gamecount < 100 || $admin == 1) && $gamecreated['created'] < (time() - 86400)) {
$date = time();
$uID = $usr['id'];
// Insert into `games`
$sql2 = "INSERT INTO `games` (`name`, `icon`, `description`, `creatorid`, `visits`, `created`, `updated`) VALUES (:name, '-99', :description, :uID, '0', :date, :date2)";
$stmt = $con->prepare($sql2);
$stmt->execute([
':name' => $name,
':description' => $description,
':uID' => $uID,
':date' => $date,
':date2' => $date
]);
$key = getFreeId();
$startquery = $con->prepare("SELECT id FROM `games` WHERE `creatorid` = :creatorid AND `icon` = '-99'");
$startquery->execute(['creatorid' => $uID]);
$start = $startquery->fetch();
$startPlaceId = $start['id'];
$placeId = $startPlaceId;
$key = getFreeId();
$iconidupdate = "UPDATE `games` SET `icon` = '$key' WHERE `id`='$startPlaceId'";
$con->exec($iconidupdate);
$idupdate = "UPDATE `games` SET `id` = '$key' WHERE `id`='$startPlaceId'";
$con->exec($idupdate);
$placeId = $key;
$gamequery = $con->prepare("SELECT id,name,creatorid,description FROM `games` WHERE `id` = :id AND `creatorid`= :creatorid");
$gamequery->execute(['id' => $placeId, 'creatorid' => $uID]);
$games = $gamequery->fetch();
}
}
}
$placeName = $games['name'];
$ExperimentalTheme = $usr['ExperimentalTheme'];
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head data-machine-id="WEB1262">
<?php if($ExperimentalTheme == "Dark"){
?>
<<<<<<< HEAD
<link rel="stylesheet" href="https://localhost/css/main.css"/>
<?php
}elseif($ExperimentalTheme == "Light"){
?>
<link rel="stylesheet" href="https://localhost/css/main2.css"/>
=======
<link rel="stylesheet" href="https://www.voidrev.us/css/main.css"/>
<?php
}elseif($ExperimentalTheme == "Light"){
?>
<link rel="stylesheet" href="https://www.voidrev.us/css/main2.css"/>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css">
<?php
}elseif($ExperimentalTheme == "2016E"){
?>
<<<<<<< HEAD
<link rel="stylesheet" href="https://localhost/css/2016e.css"/>
<?
}elseif($ExperimentalTheme == "AprilFools"){
?>
<link rel="stylesheet" href="https://localhost/css/aprilfools.css"/>
<?
}elseif($ExperimentalTheme == "newtheme"){
?>
<link rel="stylesheet" href="https://localhost/css/newtheme.css"/>
<?
}else{
?>
<link rel="stylesheet" href="https://localhost/css/main2.css"/>
=======
<link rel="stylesheet" href="https://www.voidrev.us/css/2016e.css"/>
<?
}elseif($ExperimentalTheme == "AprilFools"){
?>
<link rel="stylesheet" href="https://www.voidrev.us/css/aprilfools.css"/>
<?
}elseif($ExperimentalTheme == "newtheme"){
?>
<link rel="stylesheet" href="https://www.voidrev.us/css/newtheme.css"/>
<?
}else{
?>
<link rel="stylesheet" href="https://www.voidrev.us/css/main2.css"/>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css">
<?
}
?>
<title>Uploading</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Roblox Corporation" />
<meta name="description" content="Roblox is a global platform that brings people together through play." />
<meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
<meta name="apple-itunes-app" content="app-id=431946152" />
<meta ng-csp="no-unsafe-eval">
<<<<<<< HEAD
<link onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' rel='stylesheet' href='http://localhost/css/uploadedit.css' />
<link onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' rel='stylesheet' href='http://localhost/css/upload.css' />
=======
<link onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' rel='stylesheet' href='http://www.voidrev.us/css/uploadedit.css' />
<link onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' rel='stylesheet' href='http://www.voidrev.us/css/upload.css' />
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
<script>
//Set if it browser's do not track flag is enabled
var Roblox = Roblox || {};
(function () {
var dnt = navigator.doNotTrack || window.doNotTrack || navigator.msDoNotTrack;
if (typeof window.external !== "undefined" &&
typeof window.external.msTrackingProtectionEnabled !== "undefined") {
dnt = dnt || window.external.msTrackingProtectionEnabled();
}
Roblox.browserDoNotTrack = dnt == "1" || dnt == "yes" || dnt === true;
})();
</script>
<<<<<<< HEAD
<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='studio' type='text/javascript' src='http://localhost/js/3719f3fb35135d05cf6b72d5b0f46333.js'>
</script>
<script type='text/javascript'>
Roblox.config.externalResources = [];
Roblox.config.paths['Pages.Catalog'] = 'http://localhost/js/109d883fe3988fca757e26e341ed0fe8.js';
Roblox.config.paths['Pages.CatalogShared'] = 'http://localhost/js/33126cd3e259a404a2563594f55a3f06.js';
Roblox.config.paths['Widgets.AvatarImage'] = 'http://localhost/js/7d49ac94271bd506077acc9d0130eebb.js';
Roblox.config.paths['Widgets.DropdownMenu'] = 'http://localhost/js/da553e6b77b3d79bec37441b5fb317e7.js';
Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://localhost/js/4a0af9989732810851e9e12809aeb8ad.js';
Roblox.config.paths['Widgets.ItemImage'] = 'http://localhost/js/61a0490ba23afa17f9ecca2a079a6a57.js';
Roblox.config.paths['Widgets.PlaceImage'] = 'http://localhost/js/a6df74a754523e097cab747621643c98.js';
</script>
<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='page' type='text/javascript' src='http://localhost/js/8954c11526342f34c1d4684694cd84de.js'>
=======
<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='studio' type='text/javascript' src='http://www.voidrev.us/js/3719f3fb35135d05cf6b72d5b0f46333.js'>
</script>
<script type='text/javascript'>
Roblox.config.externalResources = [];
Roblox.config.paths['Pages.Catalog'] = 'http://www.voidrev.us/js/109d883fe3988fca757e26e341ed0fe8.js';
Roblox.config.paths['Pages.CatalogShared'] = 'http://www.voidrev.us/js/33126cd3e259a404a2563594f55a3f06.js';
Roblox.config.paths['Widgets.AvatarImage'] = 'http://www.voidrev.us/js/7d49ac94271bd506077acc9d0130eebb.js';
Roblox.config.paths['Widgets.DropdownMenu'] = 'http://www.voidrev.us/js/da553e6b77b3d79bec37441b5fb317e7.js';
Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://www.voidrev.us/js/4a0af9989732810851e9e12809aeb8ad.js';
Roblox.config.paths['Widgets.ItemImage'] = 'http://www.voidrev.us/js/61a0490ba23afa17f9ecca2a079a6a57.js';
Roblox.config.paths['Widgets.PlaceImage'] = 'http://www.voidrev.us/js/a6df74a754523e097cab747621643c98.js';
</script>
<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='page' type='text/javascript' src='http://www.voidrev.us/js/8954c11526342f34c1d4684694cd84de.js'>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
</script>
<script type="text/javascript">
if (typeof (Roblox) === "undefined") {
Roblox = {};
}
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
<<<<<<< HEAD
Roblox.Endpoints.Urls['/api/item.ashx'] = 'http://localhost/api/item.ashx';
Roblox.Endpoints.Urls['/asset/'] = 'http://localhost/asset/';
Roblox.Endpoints.Urls['/client-status/set'] = 'http://localhost/client-status/set';
Roblox.Endpoints.Urls['/client-status'] = 'http://localhost/client-status';
Roblox.Endpoints.Urls['/game/'] = 'http://localhost/game/';
Roblox.Endpoints.Urls['/game-auth/getauthticket'] = 'http://localhost/game-auth/getauthticket';
Roblox.Endpoints.Urls['/game/edit.ashx'] = 'http://localhost/game/edit.ashx';
Roblox.Endpoints.Urls['/game/getauthticket'] = 'http://localhost/game/getauthticket';
Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = 'http://localhost/game/placelauncher.ashx';
Roblox.Endpoints.Urls['/game/preloader'] = 'http://localhost/game/preloader';
Roblox.Endpoints.Urls['/game/report-stats'] = 'http://localhost/game/report-stats';
Roblox.Endpoints.Urls['/game/report-event'] = 'http://localhost/game/report-event';
Roblox.Endpoints.Urls['/game/updateprerollcount'] = 'http://localhost/game/updateprerollcount';
Roblox.Endpoints.Urls['/login/default.aspx'] = 'http://localhost/login/default.aspx';
Roblox.Endpoints.Urls['/my/character.aspx'] = 'http://localhost/my/character.aspx';
Roblox.Endpoints.Urls['/my/money.aspx'] = 'http://localhost/my/money.aspx';
Roblox.Endpoints.Urls['/chat/chat'] = 'http://localhost/chat/chat';
Roblox.Endpoints.Urls['/presence/users'] = 'http://localhost/presence/users';
Roblox.Endpoints.Urls['/presence/user'] = 'http://localhost/presence/user';
Roblox.Endpoints.Urls['/friends/list'] = 'http://localhost/friends/list';
Roblox.Endpoints.Urls['/navigation/getCount'] = 'http://localhost/navigation/getCount';
Roblox.Endpoints.Urls['/catalog/browse.aspx'] = 'http://localhost/catalog/browse.aspx';
Roblox.Endpoints.Urls['/catalog/html'] = 'http://localhost/catalog/html';
Roblox.Endpoints.Urls['/catalog/json'] = 'http://localhost/catalog/json';
Roblox.Endpoints.Urls['/catalog/contents'] = 'http://localhost/catalog/contents';
Roblox.Endpoints.Urls['/catalog/lists.aspx'] = 'http://localhost/catalog/lists.aspx';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = 'http://localhost/asset-hash-thumbnail/image';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = 'http://localhost/asset-hash-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = 'http://localhost/asset-thumbnail-3d/json';
Roblox.Endpoints.Urls['/asset-thumbnail/image'] = 'http://localhost/asset-thumbnail/image';
Roblox.Endpoints.Urls['/asset-thumbnail/json'] = 'http://localhost/asset-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail/url'] = 'http://localhost/asset-thumbnail/url';
Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = 'http://localhost/asset/request-thumbnail-fix';
Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = 'http://localhost/avatar-thumbnail-3d/json';
Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = 'http://localhost/avatar-thumbnail/image';
Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = 'http://localhost/avatar-thumbnail/json';
Roblox.Endpoints.Urls['/avatar-thumbnails'] = 'http://localhost/avatar-thumbnails';
Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = 'http://localhost/avatar/request-thumbnail-fix';
Roblox.Endpoints.Urls['/bust-thumbnail/json'] = 'http://localhost/bust-thumbnail/json';
Roblox.Endpoints.Urls['/group-thumbnails'] = 'http://localhost/group-thumbnails';
Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = 'http://localhost/groups/getprimarygroupinfo.ashx';
Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = 'http://localhost/headshot-thumbnail/json';
Roblox.Endpoints.Urls['/item-thumbnails'] = 'http://localhost/item-thumbnails';
Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = 'http://localhost/outfit-thumbnail/json';
Roblox.Endpoints.Urls['/place-thumbnails'] = 'http://localhost/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/asset/'] = 'http://localhost/thumbnail/asset/';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshot'] = 'http://localhost/thumbnail/avatar-headshot';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshots'] = 'http://localhost/thumbnail/avatar-headshots';
Roblox.Endpoints.Urls['/thumbnail/user-avatar'] = 'http://localhost/thumbnail/user-avatar';
Roblox.Endpoints.Urls['/thumbnail/resolve-hash'] = 'http://localhost/thumbnail/resolve-hash';
Roblox.Endpoints.Urls['/thumbnail/place'] = 'http://localhost/thumbnail/place';
Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = 'http://localhost/thumbnail/get-asset-media';
Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = 'http://localhost/thumbnail/remove-asset-media';
Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = 'http://localhost/thumbnail/set-asset-media-sort-order';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = 'http://localhost/thumbnail/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = 'http://localhost/thumbnail/place-thumbnails-partial';
Roblox.Endpoints.Urls['/thumbnail_holder/g'] = 'http://localhost/thumbnail_holder/g';
Roblox.Endpoints.Urls['/users/{id}/profile'] = 'http://localhost/users/{id}/profile';
Roblox.Endpoints.Urls['/service-workers/push-notifications'] = 'http://localhost/service-workers/push-notifications';
Roblox.Endpoints.Urls['/notification-stream/notification-stream-data'] = 'http://localhost/notification-stream/notification-stream-data';
Roblox.Endpoints.Urls['/api/friends/acceptfriendrequest'] = 'http://localhost/api/friends/acceptfriendrequest';
Roblox.Endpoints.Urls['/api/friends/declinefriendrequest'] = 'http://localhost/api/friends/declinefriendrequest';
=======
Roblox.Endpoints.Urls['/api/item.ashx'] = 'http://www.voidrev.us/api/item.ashx';
Roblox.Endpoints.Urls['/asset/'] = 'http://www.voidrev.us/asset/';
Roblox.Endpoints.Urls['/client-status/set'] = 'http://www.voidrev.us/client-status/set';
Roblox.Endpoints.Urls['/client-status'] = 'http://www.voidrev.us/client-status';
Roblox.Endpoints.Urls['/game/'] = 'http://www.voidrev.us/game/';
Roblox.Endpoints.Urls['/game-auth/getauthticket'] = 'http://www.voidrev.us/game-auth/getauthticket';
Roblox.Endpoints.Urls['/game/edit.ashx'] = 'http://www.voidrev.us/game/edit.ashx';
Roblox.Endpoints.Urls['/game/getauthticket'] = 'http://www.voidrev.us/game/getauthticket';
Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = 'http://www.voidrev.us/game/placelauncher.ashx';
Roblox.Endpoints.Urls['/game/preloader'] = 'http://www.voidrev.us/game/preloader';
Roblox.Endpoints.Urls['/game/report-stats'] = 'http://www.voidrev.us/game/report-stats';
Roblox.Endpoints.Urls['/game/report-event'] = 'http://www.voidrev.us/game/report-event';
Roblox.Endpoints.Urls['/game/updateprerollcount'] = 'http://www.voidrev.us/game/updateprerollcount';
Roblox.Endpoints.Urls['/login/default.aspx'] = 'http://www.voidrev.us/login/default.aspx';
Roblox.Endpoints.Urls['/my/character.aspx'] = 'http://www.voidrev.us/my/character.aspx';
Roblox.Endpoints.Urls['/my/money.aspx'] = 'http://www.voidrev.us/my/money.aspx';
Roblox.Endpoints.Urls['/chat/chat'] = 'http://www.voidrev.us/chat/chat';
Roblox.Endpoints.Urls['/presence/users'] = 'http://www.voidrev.us/presence/users';
Roblox.Endpoints.Urls['/presence/user'] = 'http://www.voidrev.us/presence/user';
Roblox.Endpoints.Urls['/friends/list'] = 'http://www.voidrev.us/friends/list';
Roblox.Endpoints.Urls['/navigation/getCount'] = 'http://www.voidrev.us/navigation/getCount';
Roblox.Endpoints.Urls['/catalog/browse.aspx'] = 'http://www.voidrev.us/catalog/browse.aspx';
Roblox.Endpoints.Urls['/catalog/html'] = 'http://www.voidrev.us/catalog/html';
Roblox.Endpoints.Urls['/catalog/json'] = 'http://www.voidrev.us/catalog/json';
Roblox.Endpoints.Urls['/catalog/contents'] = 'http://www.voidrev.us/catalog/contents';
Roblox.Endpoints.Urls['/catalog/lists.aspx'] = 'http://www.voidrev.us/catalog/lists.aspx';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = 'http://www.voidrev.us/asset-hash-thumbnail/image';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = 'http://www.voidrev.us/asset-hash-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = 'http://www.voidrev.us/asset-thumbnail-3d/json';
Roblox.Endpoints.Urls['/asset-thumbnail/image'] = 'http://www.voidrev.us/asset-thumbnail/image';
Roblox.Endpoints.Urls['/asset-thumbnail/json'] = 'http://www.voidrev.us/asset-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail/url'] = 'http://www.voidrev.us/asset-thumbnail/url';
Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = 'http://www.voidrev.us/asset/request-thumbnail-fix';
Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = 'http://www.voidrev.us/avatar-thumbnail-3d/json';
Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = 'http://www.voidrev.us/avatar-thumbnail/image';
Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = 'http://www.voidrev.us/avatar-thumbnail/json';
Roblox.Endpoints.Urls['/avatar-thumbnails'] = 'http://www.voidrev.us/avatar-thumbnails';
Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = 'http://www.voidrev.us/avatar/request-thumbnail-fix';
Roblox.Endpoints.Urls['/bust-thumbnail/json'] = 'http://www.voidrev.us/bust-thumbnail/json';
Roblox.Endpoints.Urls['/group-thumbnails'] = 'http://www.voidrev.us/group-thumbnails';
Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = 'http://www.voidrev.us/groups/getprimarygroupinfo.ashx';
Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = 'http://www.voidrev.us/headshot-thumbnail/json';
Roblox.Endpoints.Urls['/item-thumbnails'] = 'http://www.voidrev.us/item-thumbnails';
Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = 'http://www.voidrev.us/outfit-thumbnail/json';
Roblox.Endpoints.Urls['/place-thumbnails'] = 'http://www.voidrev.us/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/asset/'] = 'http://www.voidrev.us/thumbnail/asset/';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshot'] = 'http://www.voidrev.us/thumbnail/avatar-headshot';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshots'] = 'http://www.voidrev.us/thumbnail/avatar-headshots';
Roblox.Endpoints.Urls['/thumbnail/user-avatar'] = 'http://www.voidrev.us/thumbnail/user-avatar';
Roblox.Endpoints.Urls['/thumbnail/resolve-hash'] = 'http://www.voidrev.us/thumbnail/resolve-hash';
Roblox.Endpoints.Urls['/thumbnail/place'] = 'http://www.voidrev.us/thumbnail/place';
Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = 'http://www.voidrev.us/thumbnail/get-asset-media';
Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = 'http://www.voidrev.us/thumbnail/remove-asset-media';
Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = 'http://www.voidrev.us/thumbnail/set-asset-media-sort-order';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = 'http://www.voidrev.us/thumbnail/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = 'http://www.voidrev.us/thumbnail/place-thumbnails-partial';
Roblox.Endpoints.Urls['/thumbnail_holder/g'] = 'http://www.voidrev.us/thumbnail_holder/g';
Roblox.Endpoints.Urls['/users/{id}/profile'] = 'http://www.voidrev.us/users/{id}/profile';
Roblox.Endpoints.Urls['/service-workers/push-notifications'] = 'http://www.voidrev.us/service-workers/push-notifications';
Roblox.Endpoints.Urls['/notification-stream/notification-stream-data'] = 'http://www.voidrev.us/notification-stream/notification-stream-data';
Roblox.Endpoints.Urls['/api/friends/acceptfriendrequest'] = 'http://www.voidrev.us/api/friends/acceptfriendrequest';
Roblox.Endpoints.Urls['/api/friends/declinefriendrequest'] = 'http://www.voidrev.us/api/friends/declinefriendrequest';
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
Roblox.Endpoints.addCrossDomainOptionsToAllRequests = true;
</script>
<script type="text/javascript">
if (typeof (Roblox) === "undefined") {
Roblox = {};
}
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
</script>
</head>
<body>
<script type="text/javascript">
if (typeof Roblox === "undefined") {
Roblox = {};
}
if (typeof Roblox.Studio === "undefined") {
Roblox.Studio = {};
}
Roblox.Studio.Resources = {
errorMSG: 'Error: Upload Failed. Please try publishing again.',
inappropriateTextError: 'Error: Inappropriate name or description.'
};
</script>
<div class="boxed-body">
<h3>Uploading to "<?echo NoXSSPlz($placeName);?>"</h3>
<div id="progressBarWrapper">
<<<<<<< HEAD
<div id="uploadProgressBar" data-upload-url="http://localhost/Data/Upload.ashx?assetid=<?=$placeId;?>&type=Place&ispublic=False" data-previous-url="http://localhost/ide/publish/newplace" data-newupload="False" data-assetid="<?=$placeId;?>" data-isplace="True" data-ispackage="False">
=======
<div id="uploadProgressBar" data-upload-url="http://www.voidrev.us/Data/Upload.ashx?assetid=<?=$placeId;?>&type=Place&ispublic=False" data-previous-url="http://www.voidrev.us/ide/publish/newplace" data-newupload="False" data-assetid="<?=$placeId;?>" data-isplace="True" data-ispackage="False">
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
<div id="progressAmount" class="progress-blue-bar" style="width:0%;">
</div>
</div>
<a class="btn-medium btn-negative uploadCancel" id="cancelButton">Cancel</a>
<a style="display: none;" class="btn-medium btn-neutral uploadOK" id="okButton">OK</a>
<a style="display: none;" class="btn-medium blue-arrow uploadNext" id="nextButton">Next</a>
</div>
<p id="errorMessageContainer"><span id="uploadProgressCounter">0%</span> Completed</p>
<div id="shareWithFriends" class="divider-top">
<h3>Share your Place with friends</h3>
<<<<<<< HEAD
<input class="form-text-box" id="gameLink" name="gameLink" type="text" value="http://localhost/games/?id=<?=$placeId;?>/" />
=======
<input class="form-text-box" id="gameLink" name="gameLink" type="text" value="http://www.voidrev.us/games/?id=<?=$placeId;?>/" />
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
</div>
</div>
<script type="text/javascript">
function urchinTracker() {}
</script>
<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
<a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
<div class="Title"></div>
<div class="GenericModalBody">
<div class="TopBody">
<div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays data-no-click>
<img class="GenericModalImage" alt="generic image" />
</div>
<div class="Message"></div>
</div>
<div class="ConfirmationModalButtonContainer GenericModalButtonContainer">
<a href id="roblox-confirm-btn"><span></span></a>
<a href id="roblox-decline-btn"><span></span></a>
</div>
<div class="ConfirmationModalFooter">
</div>
</div>
<script type="text/javascript">
Roblox = Roblox || {};
Roblox.Resources = Roblox.Resources || {};
Roblox.Resources.GenericConfirmation = {
yes: "Yes",
No: "No",
Confirm: "Confirm",
Cancel: "Cancel"
};
</script>
</div>
</body>
</html>