<?php

namespace Ht7\WebsocketServer;

use \Ht7\Base\Enum;

/**
 * Description of MessageTypes
 *
 * @author Thomas Pluess
 */
class EventTypes extends Enum
{

    const ON_OPEN = 1;
    const ON_CLOSE = 2;
    const ON_ERROR = 3;
    const ON_MESSAGE = 4;

}
