<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * An event triggered when someone is added to or removed from a conversation.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class ThreadUpdate extends Event
{
    /**
     * Array of users affected by the update.
     * @var mixed[]
     */
    private $userIds = [];

    /**
     * Conversation where the change occurred.
     * @var string
     */
    private $conversationId;

    public function __construct(array $raw)
    {
        parent::__construct($raw);
        foreach ($raw['resource']['members'] as $member) {
            $this->userIds[] = Utils::removePrefix($member['id']);
        }
        $this->conversationId = $raw['resource']['id'];
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
     * Get array of users affected by the update.
     *
     * @return  mixed[]
     */
    public function getUserIds()
    {
        return $this->userIds;
    }
}
