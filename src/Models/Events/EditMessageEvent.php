<?php

namespace Akbv\PhpSkype\Models\Events;
use Akbv\PhpSkype\Models\Message;
/**
 * The base message event, when a message is received in a conversation.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class EditMessageEvent
{
    /**
     * Id of edited message.
     *
     * @var id
     */
    private $editedMessageId;

    /**
     * Skype Name of User or Group.
     *
     * @var Message
     */
    private $message;

    /**
     * construct message event.
     * @param mixed[] $raw
     */
    public function __construct(array $raw)
    {
        $this->message = new Message($raw['resource']);
        $this->editedMessageId = isset($raw['resource']['id']) ? $raw['resource']['id'] : null;
    }

    /**
     * @return  string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get id of edited message.
     *
     * @return  id
     */
    public function getEditedMessageId()
    {
        return $this->editedMessageId;
    }
}
