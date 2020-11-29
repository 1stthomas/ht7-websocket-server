<?php

namespace Ht7\WebsocketServer;

use \Ht7\Base\Lists\ItemList;
use \Ratchet\ConnectionInterface;

/**
 * Description of ClientList
 *
 * @author Thomas Pluess
 */
class ClientList extends ItemList
{

    public function remove($client)
    {
        if (is_object($client) && $client instanceof ConnectionInterface) {
            $index = array_search($client, $this->items);

            if ($index !== false) {
                unset($this->items[$index]);
            }
        } else {
            parent::remove($client);
        }
    }

}
