<?php

namespace Ht7\WebsocketServer;

use \Ratchet\Server\IoServer as RatchetIoServer;

/**
 * The <code>IoServer</code> class of the ratchet library does not have a method
 * to stop the server. This class adds this possibility.
 */
class IoServer extends RatchetIoServer
{

    /**
     * Stop the server event-loop which will exit the script.
     */
    public function stop()
    {
        $this->loop->stop();
    }

}
