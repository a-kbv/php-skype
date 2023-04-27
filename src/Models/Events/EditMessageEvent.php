<?php

namespace Akbv\PhpSkype\Models\Events;

/**
 * The base message event, when a message is received in a conversation.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class EditMessageEvent extends Event
{
    /**
     * Skype Name of User or Group.
     *
     * @var string
     */
    private $message;

    /**
     * construct message event.
     */
    public function __construct(array $raw)
    {
        parent::__construct($raw);
        $this->message = $raw['resource']['content'];
    }

    /**
     * @return  string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
