<?php

namespace Ht7\WebsocketServer\Messages;

/**
 *
 * @author Thomas Pluess
 */
interface MessageBaseInterface
{

    public function getAction();

    public function getAppId();

    public function getDatetime();

    public function getReleaser();
}
