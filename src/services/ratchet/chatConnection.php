<?php
namespace App\services\ratchet;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;


class ChatConnection implements MessageComponentInterface {
    protected $clients = [];
    private $state = 0;
    private $date;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->date = date("G");//Saves the date the day the socket was started
    }
    private function __clone()
    {
        // Make sure that nobody can clone instance
    }
    public function onOpen(ConnectionInterface $conn) {
        // foreach ($this->clients as $client) {
        //     $client->send('new');
        // }
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }
    
    public function dateListener(){
        $d = date("G");
        if($d < $this->date){//check if day has changed
            $this->state = 0;
            $this->date = $d;
            foreach($this->clients as $client){//resetting the state to default(0)
                $client->send($this->state);
            }
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                // $client->send($msg);
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}