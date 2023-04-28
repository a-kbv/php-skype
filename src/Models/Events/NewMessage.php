<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Models\Message;

/**
 * The base message event, when a message is received in a conversation.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class NewMessage extends Event
{
    /**
     * Skype Name of User or Group.
     *
     * @var Message
     */
    private $message;

    /**
     * construct message event.
     */
    public function __construct(array $raw)
    {
        $this->message = new Message($raw['resource']);
    }

    /**
     * @return  Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
