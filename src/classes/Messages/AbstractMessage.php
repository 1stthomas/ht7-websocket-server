<?php

namespace Ht7\WebsocketServer\Messages;

use \Ht7\WebsocketServer\Messages\MessageBaseInterface;

/**
 * Description of AbstractMessage
 *
 * @author Thomas Pluess
 */
class AbstractMessage implements MessageBaseInterface
{

    protected $action;
    protected $appId;
    protected $datetime;
    protected $releaser;
    protected $token;

    public function __construct(array $msg)
    {
        $this->action = $msg['action'];
        $this->appId = $msg['appId'];
        $this->datetime = $msg['datetime'];
        $this->releaser = $msg['releaser'];
        $this->token = empty($msg['token']) ? '' : $msg['token'];
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function getReleaser()
    {
        return $this->releaser;
    }

    public function getToken()
    {
        return $this->token;
    }

}
