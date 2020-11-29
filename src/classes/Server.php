<?php

namespace Ht7\WebsocketServer;

use \Ht7\WebsocketServer\AppRegistration;
use \Ht7\WebsocketServer\EventTypes;
use \Ht7\WebsocketServer\Apps\Admin as AdminApp;
use \Ratchet\MessageComponentInterface;
use \Ratchet\ConnectionInterface;
use \Ratchet\Server\IoServer as RatchetIoServer;

/**
 * Description of Chat
 *
 * @author Thomas Pluess
 */
class Server implements MessageComponentInterface
{

    protected $apps;
    protected $ioServer;

    public function __construct(array $apps)
    {
        $this->apps = new AppRegistration($apps);
    }

    public function getAppRegistration()
    {
        return $this->apps;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->getAppRegistration()
                ->handleEvent(EventTypes::ON_OPEN, $conn);
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->getAppRegistration()
                ->handleEvent(EventTypes::ON_CLOSE, $conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $this->getAppRegistration()
                ->handleEvent(EventTypes::ON_ERROR, $conn, $e);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->getAppRegistration()
                ->handleEvent(EventTypes::ON_MESSAGE, $from, $msg);
    }

    public function setIoServer(RatchetIoServer $ioServer)
    {
        $this->ioServer = $ioServer;

        foreach ($this->getAppRegistration() as $app) {
            if ($app instanceof AdminApp) {
                $app->setIoServer($this->ioServer);
            }
        }
    }

}
