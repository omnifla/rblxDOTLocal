<?php
$input = urldecode($_POST['ctl00$cphRoblox$Textbox1']);
$actualpassword = "LimboBypassPass";
if($input === $actualpassword){
setcookie("BypassMaintenance", $actualpassword, time() + (86400), "/", '.voidrev.us');
<<<<<<< HEAD
header("Location: https://localhost");
}else{
header("Location: https://localhost/maintenance");
=======
header("Location: https://www.voidrev.us");
}else{
header("Location: https://www.voidrev.us/maintenance");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}