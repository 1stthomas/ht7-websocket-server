<?php

namespace Ht7\WebsocketServer;

use \Ht7\Base\Enum;
use \Ht7\WebsocketServer\Server as Ht7AppServer;

/**
 * The default parameters for the <code>Shepherd</code> class.
 *
 * @author Thomas Pluess
 */
class Defaults extends Enum
{

    const ROUTE = 'http://localhost/ws';
    const PORT = 8080;
    const CONFIG = [];
    const APP_SERVER = Ht7AppServer::class;

}
