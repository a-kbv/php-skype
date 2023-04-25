<?php

namespace Akbv\PhpSkype\Models\Events;

/**
 * The base message event, when a message is received in a conversation.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class MessageEvent extends Event
{
    /**
     * Skype Name of User or Group.
     *
     * @var string
     */
    private $messageId;

    /**
     * construct message event.
     */
    public function __construct(array $raw)
    {
        parent::__construct($raw);
        $this->messageId = isset($raw['resource']['id']) ? $raw['resource']['id'] : null;
    }

    /**
     * Get skype Name of User or Group.
     *
     * @return  string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }
}
