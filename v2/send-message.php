<?php
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
use Snipe\BanBuilder\CensorWords;
$censor = new CensorWords;
$usr = getUserData($con);
if($usr['banned'] != 0){
<<<<<<< HEAD
	echo json_encode(array('success' => false));
	die(http_response_code(403));
=======
echo json_encode(array('success' => false));
die(http_response_code(403));
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
$userId = $usr['id'];
// Rate limiting settings
$rateLimitInterval = 60; // 60 seconds
$lastMessageTime = getLastMessageTime($userId); // Implement this function to get the last message time for the user
if (time() - $lastMessageTime < $rateLimitInterval) {
<<<<<<< HEAD
	echo json_encode(array('success' => false, 'message' => 'Rate limit exceeded'));
	die(http_response_code(429)); // 429 Too Many Requests status code
=======
echo json_encode(array('success' => false, 'message' => 'Rate limit exceeded'));
die(http_response_code(429)); // 429 Too Many Requests status code
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
header('Content-Type: application/json; charset=UTF-8; X-Robots-Tag: noindex');
$json = json_decode(file_get_contents("php://input"), true);
$conversationId = (int)$json['conversationId'];
if ($conversationId == 0) {
<<<<<<< HEAD
	http_response_code(403);
	exit();
=======
http_response_code(403);
exit();
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
$content = $censor->censorString($json['message'])['clean'];
$startquery = $con->prepare('INSERT INTO `chatdata`(`conversationid`, `fromid`, `time`, `text`) VALUES (:conversationId, :fromid, :time, :text)');
$startquery->execute([
<<<<<<< HEAD
	':conversationId' => $conversationId,
	':fromid' => $usr['id'],
	':time' => time(),
	':text' => $content
=======
':conversationId' => $conversationId,
':fromid' => $usr['id'],
':time' => time(),
':text' => $content
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
]);
$newchat = $con->lastInsertId();
$timequery = $con->prepare('UPDATE `chats` SET `time`=:time WHERE id = :conversationId');
$timequery->execute([
<<<<<<< HEAD
	':conversationId' => $conversationId,
	':time' => time()
]);
if (containsLink($content)) {
	$messageType = "Link";
} else {
	$messageType = "PlainText";
}
// Update the last message time for the user
updateLastMessageTime($con, $userId, time()); // Update the user's last message time

/**
 * Updates the last message time for a user.
 *
 * @param PDO $con
 * @param int $userId
 * @param int $timestamp
 * @return void
 */
function updateLastMessageTime($con, $userId, $timestamp) {
	$stmt = $con->prepare('UPDATE users SET last_message_time = :timestamp WHERE id = :userId');
	$stmt->execute([
		':timestamp' => $timestamp,
		':userId' => $userId
	]);
}
echo json_encode([
	"content" => $content,
	"filteredForReceivers" => false,
	"messageId" => $newchat,
	"sent" => date("Y-m-d\TH:i:s\Z", time()),
	"messageType" => $messageType,
	"resultType" => "Success",
	"statusMessage" => "Success"
]);
=======
':conversationId' => $conversationId,
':time' => time()
]);
if (containsLink($content)) {
$messageType = "Link";
} else {
$messageType = "PlainText";
}
// Update the last message time for the user
updateLastMessageTime($userId, time()); // Implement this function to update the last message time
echo json_encode([
"content" => $content,
"filteredForReceivers" => false,
"messageId" => $newchat,
"sent" => date("Y-m-d\TH:i:s\Z", time()),
"messageType" => $messageType,
"resultType" => "Success",
"statusMessage" => "Success"
]);
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
use Snipe\BanBuilder\CensorWords;
$censor = new CensorWords;
$usr = getUserData($con);
if($usr['banned'] != 0){
echo json_encode(array('success' => false));
die(http_response_code(403));
}
$userId = $usr['id'];
header('Content-Type: application/json; charset=UTF-8; X-Robots-Tag: noindex');
$json = json_decode(file_get_contents("php://input"),true);
$conversationId = (int)$json['conversationId'];
if($conversationId == 0){
http_response_code(403);
exit();
}
$content = $censor->censorString($json['message'])['clean'];
$startquery = $con->prepare('INSERT INTO `chatdata`(`conversationid`, `fromid`, `time`, `text`) VALUES (:conversationId, :fromid, :time, :text)');
$startquery->execute([
':conversationId' => $conversationId,
':fromid' => $usr['id'],
':time' => time(),
':text' => $content
]);
$newchat = $con->lastInsertId();
$timequery = $con->prepare('UPDATE `chats` SET `time`=:time WHERE id = :conversationId');
$timequery->execute([
':conversationId' => $conversationId,
':time' => time()
]);
if(containsLink($content)){
$messageType = "Link";
}else{
$messageType = "PlainText";
}
?>
{
"content": "<?php echo $content;?>",
"filteredForReceivers": false,
"messageId": <?=$newchat;?>,
"sent": "<?=date("Y-m-d\TH:i:s\Z", time());?>",
"messageType": "<?=$messageType;?>",
"resultType": "Success",
"statusMessage": "Success"
}
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
