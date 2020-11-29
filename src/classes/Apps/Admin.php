<?php

namespace Ht7\WebsocketServer\Apps;

use \Ht7\WebsocketServer\Apps\AbstractApp;
use \Ht7\WebsocketServer\Messages\MessageBaseInterface;
use \Ht7\WebsocketServer\Messages\ShutDown;
use \Ratchet\ConnectionInterface;
use \Ratchet\Server\IoServer;

/**
 * Description of newPHPClass
 *
 * @author Thomas Pluess
 */
class Admin extends AbstractApp
{

    protected $ioServer;

    /**
     * @var     array               An assoc array of user ids as keys and the
     *                              user token as corresponding value.
     */
    protected $validUsers;

    public function __construct($validUsers, IoServer $ioServer = null)
    {
        parent::__construct();

        $this->ioServer = $ioServer;
        $this->validUsers = $validUsers;
    }

    /**
     * Create a message instance according to the definitions found in the message
     * string.
     *
     * @param   string      $msg
     * @return  MessageBaseInterface
     */
    public function createMessageInstance(string $msg)
    {
        $msgJson = json_decode($msg, true);

        if ($msgJson['releaser'] === 'user' || $msgJson['releaser'] === 'server') {
            if ($msgJson['action'] === 'shutdown') {
                return new ShutDown($msg);
            }
        }
    }

    public function setIoServer(IoServer $ioServer)
    {
        $this->ioServer = $ioServer;
    }

    public function validateMessage(MessageBaseInterface $msg)
    {
        if ($msg->getAppId() === $this->appId) {
            if (in_array($msg->getUserId(), $this->validUsers)) {
                if ($this->validUsers[$msg->getUserId()] === $msg->getToken()) {
                    return true;
                } else {
                    return 'Wrong token provided for userId ' . $msg->getUser() . ' and token ' . $msg->getToken() . '.';
                }
            } else {
                'The userId ' . $msg->getUserId() . ' has no access to appId ' . $this->appId . '.';
            }
        } else {
            return 'Wrong app id.';
        }

//        if ($msg->getAction() === 'shutdown') {
//
//        }
    }

    protected function handleMessage(ConnectionInterface $conn, $msg = null)
    {
        if (empty($msg)) {
            return;
        }

        $msgInstance = $this->createMessageInstance($msg);
        $validationResult = $this->validateMessage($msgInstance);

        if ($validationResult === true) {
            if ($msg instanceof ShutDown) {

            }
        } else {
            // log this event and close the connection.

            $conn->close();
        }
    }

}
