<?php
namespace App\bin;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\services\ratchet\ChatConnection;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new chatConnection()
        )
    ),
    8080
);

$server->run();
