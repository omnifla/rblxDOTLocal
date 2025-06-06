<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
<<<<<<< HEAD
class Socket implements MessageComponentInterface
{
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection in $this->clients
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
        $conn->send("{}");
    }
    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($from->resourceId == $client->resourceId) {
                continue;
            }
            $client->send("{}");
        }
    }
    public function onClose(ConnectionInterface $conn)
    {
        echo "Closed connection! ({$conn->resourceId})\n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error connection! $e";
    }
=======
class Socket implements MessageComponentInterface {
public function __construct()
{
$this->clients = new \SplObjectStorage;
}
public function onOpen(ConnectionInterface $conn) {
// Store the new connection in $this->clients
$this->clients->attach($conn);
echo "New connection! ({$conn->resourceId})\n";
$conn->send("{}");
}
public function onMessage(ConnectionInterface $from, $msg) {
foreach ( $this->clients as $client ) {
if ( $from->resourceId == $client->resourceId ) {
continue;
}
$client->send("{}");
}
}
public function onClose(ConnectionInterface $conn) {
echo "Closed connection! ({$conn->resourceId})\n";
}
public function onError(ConnectionInterface $conn, \Exception $e) {
echo "Error connection! $e";
}
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
}
