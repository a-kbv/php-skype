<?php

namespace Akbv\PhpSkype\Utils;

/**
 * Manage Skype Message content.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class MessageProcessor
{
    public static function normalizeMessage(string $message): string
    {
        $addMemberPattern = '/<addmember><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><target>(.+)<\/target><\/addmember>/';
        $deleteMemberPattern = '/<deletemember><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><target>(.+)<\/target><\/deletemember>/';
        $topicUpdatePattern = '/<topicupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><value>(.+)<\/value><\/topicupdate>/';
        $historyDisclosurePattern = '/<historydisclosedupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><value>(true|false)<\/value><\/historydisclosedupdate>/';
        $joiningEnabledPattern = '/<joiningenabledupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><value>(true|false)<\/value><\/joiningenabledupdate>/';
        $pictureUpdatePattern = '/<pictureupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator>.*<\/pictureupdate>/';

        if(preg_match($addMemberPattern, $message, $matches)) {
          return $matches[2].' added '.$matches[3].' to the conversation.';
        }

        if(preg_match($deleteMemberPattern, $message, $matches)) {
          return $matches[2].' removed '.$matches[3].' from this conversation.';
        }

        if(preg_match($topicUpdatePattern, $message, $matches)) {
          return $matches[2].' has renamed the conversation to "'.$matches[3].'".';
        }

        if(preg_match($historyDisclosurePattern, $message, $matches)) {
          if($matches[3] === "true")
            return $matches[2].' has made the chat history visible to everyone.';
          else
            return $matches[2].' has made the chat history invisible to everyone.';
        }

        if(preg_match($joiningEnabledPattern, $message, $matches)) {
          if($matches[3] === "true")
            return $matches[2].' has enabled joining this conversation using a link.';
          else
            return $matches[2].' has disabled joining this conversation using a link.';
        }

        if(preg_match($pictureUpdatePattern, $message, $matches)) {
           return $matches[2].' has changed the conversation picture.';
        }

        // Default case for normal messages
        return $message;

    }
}
