<?php

namespace Ht7\WebsocketServer;

use \Ht7\Base\Enum;

/**
 * Description of MessageTypes
 *
 * @author Thomas Pluess
 */
class AppDefinitionTypes extends Enum
{

    const IS_CLASS = 1;
    const IS_INSTANCE = 2;
    const IS_FACTORY = 3;

}
