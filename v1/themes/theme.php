<?php
<<<<<<< HEAD
require($_SERVER['DOCUMENT_ROOT'] . "/config/includes.php");
$usr = getUserData($con);
header("Content-Type: application/json; charset=utf-8");
?>
{"themeType":"<?php echo $usr['ExperimentalTheme']; ?>"}
=======
require($_SERVER['DOCUMENT_ROOT']."/config/includes.php");
$usr = getUserData($con);
header("Content-Type: application/json; charset=utf-8");
?>
{"themeType":"<?php echo $usr['ExperimentalTheme'];?>"}
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
