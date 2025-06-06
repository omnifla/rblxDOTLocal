<?php
<<<<<<< HEAD

$url = "/catalog?" . $_SERVER['QUERY_STRING'];
header("HTTP/1.1 301 Moved Permanently");
header("Location: $url");

=======
 $url = "/catalog?".$_SERVER['QUERY_STRING'];
 header("HTTP/1.1 301 Moved Permanently"); 
 header("Location: $url");
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
?>