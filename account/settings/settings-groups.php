<?php
header('Content-Type: application/json');

$data = [
    ['title' => 'Account Info', 'url' => 'https://localhost/my/account#!/info', 'suffix' => 'info'],
    ['title' => 'Security', 'url' => 'https://localhost/my/account#!/security', 'suffix' => 'security'],
    ['title' => 'Privacy', 'url' => 'https://localhost/my/account#!/privacy', 'suffix' => 'privacy'],
    ['title' => 'Billing', 'url' => 'https://localhost/my/account#!/billing', 'suffix' => 'billing'],
    ['title' => 'Notifications', 'url' => 'https://localhost/my/account#!/notifications', 'suffix' => 'notifications']
];

echo json_encode($data);
?>