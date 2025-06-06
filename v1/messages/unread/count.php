<?php
<<<<<<< HEAD
include($_SERVER['DOCUMENT_ROOT'] . "/config/includes.php");
=======
include($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
header('Content-Type: application/json; charset=UTF-8; X-Robots-Tag: noindex');
$id = getUserData($con)['id'];
?>
{
<<<<<<< HEAD
"count": <?php echo chatUnreadCount($id); ?>
=======
"count": <?php echo chatUnreadCount($id);?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}