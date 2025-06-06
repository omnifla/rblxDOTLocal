<?php
header('Content-Type: application/json');

$data = [
<<<<<<< HEAD
    ['title' => 'Account Info', 'url' => 'https://localhost/my/account#!/info', 'suffix' => 'info'],
    ['title' => 'Security', 'url' => 'https://localhost/my/account#!/security', 'suffix' => 'security'],
    ['title' => 'Privacy', 'url' => 'https://localhost/my/account#!/privacy', 'suffix' => 'privacy'],
    ['title' => 'Billing', 'url' => 'https://localhost/my/account#!/billing', 'suffix' => 'billing'],
    ['title' => 'Notifications', 'url' => 'https://localhost/my/account#!/notifications', 'suffix' => 'notifications']
];

echo json_encode($data);
?>
=======
    [ 'title' => 'Account Info', 'url' => 'https://www.voidrev.us/my/account#!/info', 'suffix' => 'info' ],
    [ 'title' => 'Security', 'url' => 'https://www.voidrev.us/my/account#!/security', 'suffix' => 'security' ],
    [ 'title' => 'Privacy', 'url' => 'https://www.voidrev.us/my/account#!/privacy', 'suffix' => 'privacy' ],
    [ 'title' => 'Billing', 'url' => 'https://www.voidrev.us/my/account#!/billing', 'suffix' => 'billing' ],
    [ 'title' => 'Notifications', 'url' => 'https://www.voidrev.us/my/account#!/notifications', 'suffix' => 'notifications' ]
];

echo json_encode($data);
?>
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
