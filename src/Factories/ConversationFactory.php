<?php

namespace Akbv\PhpSkype\Factories;

use Akbv\PhpSkype\Models\Conversation;

/**
 * Class ConversationFactory manages conversion Conversation to data and reverse.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class ConversationFactory
{
    public const FIELD_NAME = 'name';
    public const FIELD_LABEL = 'label';

    /**
     * @param mixed[] $data
     * @return Conversation
     */
    public static function buildConversationFromData(array $data): Conversation
    {
        $result = new Conversation($data[self::FIELD_NAME], $data[self::FIELD_LABEL]);
        return $result;
    }

    /**
     * @param Conversation $conversation
     * @return mixed[]
     */
    public static function buildDataFromConversation(Conversation $conversation): array
    {
        $result = [
            self::FIELD_NAME => $conversation->getName(),
            self::FIELD_LABEL => $conversation->getLabel(),
        ];
        return $result;
    }
}
