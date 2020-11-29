<?php

use \Ht7\WebsocketServer\IoServer;
use \Ht7\WebsocketServer\Shepherd;
//use \Ratchet\Server\IoServer;
use \Ratchet\Http\HttpServer;
use \Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '../../vendor/autoload.php';

$shepherd = new Shepherd($argv);

print_r($shepherd);

//exit();

$apps = $shepherd->getApps();

$ioServer = IoServer::factory(
                new HttpServer(
                        new WsServer($shepherd->getAppServer())
                ),
                $shepherd->getPort()
);

//$ratchetServer = IoServer::factory(
//                new HttpServer(
//                        new WsServer($ht7Server)
//                ),
//                $shepherd->getPort()
//);

print_r($shepherd->getAppServer());

//exit();

$ioServer->run();

echo "mache pause..\n";

sleep(2);

echo "fertig pause, beende server..\n";

$ioServer->stop();

//exit();
