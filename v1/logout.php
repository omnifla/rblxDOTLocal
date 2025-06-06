<?php
header("Content-Type: application/json");
// unset cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
<<<<<<< HEAD
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', -24 * 60 * 60);
        setcookie($name, '', -24 * 60 * 60, '/');
        setcookie($name, '', -24 * 60 * 60, '/', '.voidrev.us');
    }
}
setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
echo "{}";
exit();
?>
=======
$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
foreach($cookies as $cookie) {
$parts = explode('=', $cookie);
$name = trim($parts[0]);
setcookie($name, '', - 24 * 60 * 60);
setcookie($name, '', - 24 * 60 * 60, '/');
setcookie($name, '', - 24 * 60 * 60, '/', '.voidrev.us');
}
}
setcookie("access", "yes", time() + 24 * 60 * 60, "/", '.voidrev.us');
echo"{}";
exit();
?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
