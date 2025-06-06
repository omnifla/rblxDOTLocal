<?php
$input = urldecode($_POST['ctl00$cphRoblox$Textbox1']);
$actualpassword = "LimboBypassPass";
if($input === $actualpassword){
setcookie("BypassMaintenance", $actualpassword, time() + (86400), "/", '.voidrev.us');
header("Location: https://localhost");
}else{
header("Location: https://localhost/maintenance");
}