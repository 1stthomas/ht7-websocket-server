<?php

namespace Ht7\WebsocketServer\Apps;

use \Ht7\Base\Lists\ItemList;
use \Ht7\WebsocketServer\EventTypes;
use \Ratchet\ConnectionInterface;

/**
 * Description of AbstractApp
 *
 * @author Thomas Pluess
 */
abstract class AbstractApp
{

    protected $appId;
    protected $clients;

    public function __construct(string $appId)
    {
        $this->appId = $appId;
        $this->clients = new ItemList();
    }

    abstract protected function handleMessage(ConnectionInterface $conn, $msg = null);

    abstract public function validateMessage(ConnectionInterface $conn, $msg = null);

    public function handleEvent(int $eventType, ConnectionInterface $conn, $msg = null)
    {
        switch ($eventType) {
            case EventTypes::ON_OPEN:

                break;
            case EventTypes::ON_CLOSE:

                break;
            case EventTypes::ON_ERROR:

                break;
            case EventTypes::ON_MESSAGE:

                break;
            default:
                break;
        }
    }

    protected function handleClose(ConnectionInterface $conn)
    {
        $this->clients->remove($conn);
    }

    protected function handleError(ConnectionInterface $conn, \Exception $e)
    {
        $this->clients->remove($conn);
    }

    protected function handleOpen(ConnectionInterface $conn)
    {
        $this->clients->add($conn);
    }

}
