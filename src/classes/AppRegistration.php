<?php

namespace Ht7\WebsocketServer;

use \Ht7\Base\Lists\ItemList;
use \Ratchet\ConnectionInterface;

/**
 * Description of Registration
 *
 * @author Thomas Pluess
 */
class AppRegistration extends ItemList
{

    public function handleEvent(int $eventType, ConnectionInterface $conn, $msg = null)
    {
        foreach ($this as $item) {
            $item->handleEvent($eventType, $conn, $msg);
        }
    }

}
