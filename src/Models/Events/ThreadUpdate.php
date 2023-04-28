<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * An event triggered when someone is added to or removed from a conversation.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class ThreadUpdate
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

    /**
     * construct thread update event.
     * @param mixed[] $raw
     */
    public function __construct(array $raw)
    {
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
