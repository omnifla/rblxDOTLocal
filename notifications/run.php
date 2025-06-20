<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\SecureServer;
use React\Socket\Server as ReactServer;
use MyApp\Socket;

<<<<<<< HEAD
require('../vendor/autoload.php');
require('data.php');
=======
require ('../vendor/autoload.php');
require ('data.php');
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3

$loop = Factory::create();

$sslContext = array(
<<<<<<< HEAD
    'local_cert' => 'C:\xampp\apache\conf\ssl.crt\server.crt',      // Path to your SSL certificate
    'local_pk' => 'C:\xampp\apache\bin\conf\ssl.key\server.key', // Path to your private key
=======
    'local_cert' => 'C:/wamp64/bin/apache/apache2.4.54.2/conf/key/server.pem',      // Path to your SSL certificate
    'local_pk'   => 'C:/wamp64/bin/apache/apache2.4.54.2/conf/key/server.key', // Path to your private key
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
    'allow_self_signed' => true,                        // Set to false if using a valid SSL certificate
    'verify_peer' => false,
    'verify_peer_name' => false,
);

$socket = new ReactServer('0.0.0.0:8443', $loop);
$secureSocket = new SecureServer($socket, $loop, $sslContext);

$server = new IoServer(
    new HttpServer(
        new WsServer(
            new Socket()
        )
    ),
    $secureSocket,
    $loop // Provide the loop here
);

$server->run();
