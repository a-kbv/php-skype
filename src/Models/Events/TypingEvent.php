<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * The base message event, when a message is received in a conversation.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class TypingEvent extends Event
{
    /**
     * User whose typing status changed.
     * @var string
     */
    private $userId;

    /**
     * Whether the user has just started typing.
     * @var bool
     */
    private $active;

    /**
     * Conversation where the user was seen typing.
     * @var string
     */
    private $conversationId;

    public function __construct(array $raw)
    {
        $this->userId = Utils::userUrlToID($raw['resource']['from']);
        $this->conversationId = Utils::chatUrlToId($raw['resource']['conversationLink']);
        $this->active = $raw['resource']['messagetype'] == 'Control/Typing';
    }

    /**
     * Get user whose typing status changed.
     *
     * @return  string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get conversation where the user was seen typing.
     *
     * @return  string
     */
    public function getConversationId()
    {
        return $this->conversationId;
    }

    /**
     * Get whether the user has just started typing.
     *
     * @return  bool
     */
    public function getActive()
    {
        return $this->active;
    }
}
