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
        $uriObjectPattern = '/<URIObject .*url_thumbnail="([^"]+)".*>/';
        $boldPattern = '/<b raw_pre="\*" raw_post="\*">(.*)<\/b>/';
        $italicPattern = '/<i raw_pre="_" raw_post="_">(.*)<\/i>/';
        $strikePattern = '/<s raw_pre="~" raw_post="~">(.*)<\/s>/';
        $prePattern = '/<pre raw_pre="```" raw_post="```">(.*)<\/pre>/';
        $linkPattern = '/<a href="([^"]+)">(.*)<\/a>/';
        $emojiPattern = '/<ss type="([^"]+)">\((.*)\)<\/ss>/';
        $mentionPattern = '/<at id="([^"]+)">(.*)<\/at>/';


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
            if($matches[3] === "true") {
                return $matches[2].' has made the chat history visible to everyone.';
            } else {
                return $matches[2].' has made the chat history invisible to everyone.';
            }
        }

        if(preg_match($joiningEnabledPattern, $message, $matches)) {
            if($matches[3] === "true") {
                return $matches[2].' has enabled joining this conversation using a link.';
            } else {
                return $matches[2].' has disabled joining this conversation using a link.';
            }
        }

        if(preg_match($pictureUpdatePattern, $message, $matches)) {
            return $matches[2].' has changed the conversation picture.';
        }

        if(preg_match($uriObjectPattern, $message, $matches)) {
            return $matches[1];
        }

        if(preg_match($boldPattern, $message, $matches)) {
            return '<b>' . $matches[1] . '</b>';
        }

        if(preg_match($italicPattern, $message, $matches)) {
            return '<i>' . $matches[1] . '</i>';
        }

        if(preg_match($strikePattern, $message, $matches)) {
            return '<s>' . $matches[1] . '</s>';
        }

        if(preg_match($prePattern, $message, $matches)) {
            return '<pre>' . $matches[1] . '</pre>';
        }

        if(preg_match($linkPattern, $message, $matches)) {
            return '<a href="' . $matches[1] . '">' . $matches[2] . '</a>';
        }

        if(preg_match($emojiPattern, $message, $matches)) {
            return $matches[2] . ' ' . '(' . $matches[1] . ')';
        }

        if(preg_match($mentionPattern, $message, $matches)) {
            return '@' . $matches[2];
        }

        // Default case for normal messages
        return $message;

    }
}
