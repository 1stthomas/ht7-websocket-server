<?php

namespace Ht7\WebsocketServer\Messages;

use \Ht7\WebsocketServer\Messages\AbstractMessage;

/**
 * Description of ShutDown
 *
 * @author Thomas Pluess
 */
class ShutDown extends AbstractMessage
{

    protected $userId;

    public function __construct(array $msg)
    {
        parent::__construct($msg);

        $this->userId = $this->getReleaser() === 'server' ? 0 : (int) $msg['userId'];
    }

}
