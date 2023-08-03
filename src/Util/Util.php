<?php

namespace Akbv\PhpSkype\Util;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Util
{

    /**
     * Extract all params from arrays and merge them into one array recursively.
     * @param mixed[] $arrays
     * @return mixed[]
     */
    public static function deepMerge($arrays): array
    {
        $result = [];
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (!isset($result[$key])) {
                    $result[$key] = $value;
                } else {
                    if (is_array($result[$key]) && is_array($value)) {
                        $result[$key] = self::deepMerge([$result[$key], $value]);
                    } else {
                        $result[$key] = $value;
                    }
                }
            }
        }
        return $result;
    }

    /**
     * Remove the type prefix from a chat identifier (e.g. "8:" for a one-to-one, "19:" for a group).
     * @param string $string string to transform
     * @return null|string|string[]
     */
    public static function removePrefix(string $string)
    {
        return (!empty($string)) ? preg_replace("/^[0-9]+:/", "", $string) : null;
    }

    /**
     * Extract the username from a contact Uri.
     * Matches addresses containing "users/<user>" or "users/ME/contacts/<user>".
     * @param string $url string Skype API URL
     * @return null|string
     */
    public static function userUrlToId(string $url)
    {
        if (empty($url)) {
            return null;
        }
        $pattern = "/users(\/ME\/contacts)?\/[0-9]+:([^\/]+)/";
        preg_match($pattern, $url, $matches);

        return isset($matches[2]) ? $matches[2] : null;
    }

    /**
     * Extract the conversation ID from a conversation URL.
     * Matches addresses containing ``conversations/<chat>``.
     * @param string $url Skype API URL
     * @return string|null extracted identifier
     */
    public static function chatUrlToId($url)
    {
        $pattern = "/conversations\/([0-9]+:[^\/]+)/";
        $match = preg_match($pattern, $url, $matches);
        if (!$match){
            $pattern = "/threads\/([0-9]+:[^\/]+)/";
            $match = preg_match($pattern, $url, $matches);
        }
        return ($match) ? $matches[1] : null;
    }

    /**
     * Encodes special characters in a given value for use in the SOAP template.

     * @param string $value the value to be encoded
     *
     * @return string the encoded value
     */
    public static function encodeValue(string $value): string
    {
        return str_replace(["&", "<", ">"], ["&amp;", "&lt;", "&gt;"], $value);
        // return htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');
    }

    /**
     * Format a Skype URL for display.
     * @param string $url the URL to format
     * @param string $display the display text
     * @return string the formatted URL
     */
    public static function formatUrl(string $url, string $display=null): string
    {
        return sprintf('<a href="%s">%s</a>', $url, $display ?: $url);
    }

    /**
     * Extract the chat ID from a chat URL.
     * @param string $url the URL to format
     * @return string the formatted URL
     */
    public static function getChatIdFromUrl(string $url): string
    {
        $messageId = $url ? substr(strrchr($url, "/"), 1) : null;
        return $messageId;
    }

    /**
    * Formats the string to be bold
    *
    * @param string $string
    * @return string
    */
    public static function bold($string)
    {
        return '<b raw_pre="*" raw_post="*">' . $string . '</b>';
    }

    /**
     * Formats the string
     *
     * @param string $string
     * @return string
     */
    public static function italic($string)
    {
        return '<i raw_pre="_" raw_post="_">' . $string . '</i>';
    }

    /**
     * Formats the string
     *
     * @param string $string
     * @return string
     */
    public static function strike($string)
    {
        return '<s raw_pre="~" raw_post="~">' . $string . '</s>';
    }

    /**
     * Create a hyperlink. If $display is not specified, display the URL.
     * Official clients don't provide the ability to set display text.
     *
     * @param string $url
     * @param string $display
     * @return void
     */
    public static function link($url, $display = null)
    {
        return '<a href="' . $url . '">' . ($display ? $display : $url) . '</a>';
    }

    /**
     * Create a mention for a user.
     * This may trigger a notification for them even if the conversation is muted.
     * @param \Akbv\PhpSkype\Model\SkypeUser\SkypeUser $user user who is to be quoted saying the message
     * @param string $name
     * @return string
     */
    public static function mention($user, $name)
    {
        return '<at id="8:' . $user->getUsername() . '">' . $name . '</at>';
    }

    /**
     * Mention everyone in the conversation.
     *
     * @return string
     */
    public static function mentionAll()
    {
        return '<at id="*">all</at>';
    }

    /**
     * Display a message as a quote from another user.
     * Skype for Web doesn't support native quotes, and instead displays the legacy quote text.
     * Supported desktop clients show a blockquote with the author's name and timestamp underneath.
     *
     * NOTE: it is possible to fake the message content of a quote.
     *
     * @param \Akbv\PhpSkype\Model\SkypeUser\SkypeUser $user user who is to be quoted saying the message
     * @param \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $conversation conversation the quote was originally seen in
     * @param string $timestamp original arrival time of the quoted message
     * @param string $content of the original message to be quoted
     */
    public static function quote($user, $conversation, $timestamp, $content)
    {
        $chatId = $conversation->getId();
        $unixTime = strtotime($timestamp);
        $legacyTime = date("d/m/Y H:i:s", $unixTime);
        return '<quote author="' . $user->getUsername() . '" authorname="' . $user->getFirstName() ." ". $user->getLastName() . '" conversation="' . $chatId . '" timestamp="' . $unixTime . '"><legacyquote>[' . $legacyTime . '] ' . $user->getFirstName() ." ". $user->getLastName() . ': </legacyquote>' . $content . '<legacyquote>\n\n&lt;&lt;&lt; </legacyquote></quote>';
    }

    /**
     * Message content converted to plain text.
     *
     * Hyperlinks are replaced with their target, quotes are converted to the legacy format,
     * and all other HTML tags are stripped from the text.
     */
    public static function trimContentToPlain($content)
    {

        $text = preg_replace('/<\/?(e|b|i|ss?|pre|quote|legacyquote)\b.*?>/', '', $content);
        $text = preg_replace('/<a\b.*?href="(.*?)">.*?<\/a>/', '\1', $text);
        $text = preg_replace('/<at\b.*?id="8:(.*?)">.*?<\/at>/', '@\1', $text);
        $text = preg_replace('/<e_m\b.*?>.*?<\/e_m>/', '', $text);
        $text = str_replace("&lt;", "<", $text);
        $text = str_replace("&gt;", ">", $text);
        $text = str_replace("&amp;", "&", $text);
        $text = str_replace("&quot;", "\"", $text);
        $text = str_replace("&apos;", "'", $text);
        return $text;
    }

    public static function emoji($emoji)
    {
        return '<ss type="' . $emoji . '">(emoji)</ss>';
    }

    /**
     * Generate the markup needed for a URI component in a rich message.
     *
     * @param string $content
     * @param string $type
     * @param string $url
     * @param string $thumb
     * @param string $title
     * @param string $desc
     * @param mixed[] $values
     * @return string
     */
    public static function uriObject($content, $type, $url, $thumb=null, $title=null, $desc=null, $values =[]): string
    {
        $titleTag = ($title ? '<Title>Title: ' . $title . '</Title>' : '<Title/>');
        $descTag = ($desc ? '<Description>Description: ' . $desc . '</Description>' : '<Description/>');
        $thumbAttr = ($thumb ? ' url_thumbnail="' . $thumb . '"' : '');
        $valTags = '';
        foreach ($values as $key => $value) {
            $valTags .= '<' . $key . ' v="' . $value . '"/>';
        }
        return sprintf('<URIObject type="%s" uri="%s"%s>%s%s%s%s</URIObject>', $type, $url, $thumbAttr, $titleTag, $descTag, $valTags, $content);
    }

    /**
     * @param string $uriObject
     * @return mixed[]
     */
    public static function parseImageUriObject($uriObject): array
    {
        $imageArray = [];

        // match url_thumbnail
        preg_match('/url_thumbnail="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['url_thumbnail'] = $matches[1];
        }

        // match uri
        preg_match('/uri="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['uri'] = $matches[1];
        }

        // match type
        preg_match('/type="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['type'] = $matches[1];
        }

        // match doc_id
        preg_match('/doc_id="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['doc_id'] = $matches[1];
        }

        // match width
        preg_match('/width="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['width'] = $matches[1];
        }

        // match height
        preg_match('/height="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['height'] = $matches[1];
        }

        // match OriginalName
        preg_match('/OriginalName v="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['originalName'] = $matches[1];
        }

        // match OriginalName
        preg_match('/originalName="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['originalName'] = $matches[1];
        }

        // match FileSize
        preg_match('/FileSize v="([^"]+)"/', $uriObject, $matches);
        if (isset($matches[1])) {
            $imageArray['fileSize'] = $matches[1];
        }

        return $imageArray;
    }

    /**
     * @param string $uriObject
     * @return mixed[]
     */
    public static function parseFileUriObject($uriObject): array
    {
        //match url_thumbnail , uri, type, doc_id, width, height , OriginalName and FileSize
        $pattern = '/<URIObject uri="(?<uri>[^"]+)" url_thumbnail="(?<url_thumbnail>[^"]+)" type="(?<type>[^"]+)" doc_id="(?<doc_id>[^"]+)">.*<OriginalName v="(?<originalName>[^"]+)"><\/OriginalName><FileSize v="(?<fileSize>[^"]+)"><\/FileSize>/';
        preg_match($pattern, $uriObject, $matches);
        $fileArray = array_filter($matches, function ($key) {
            return is_string($key);
        }, ARRAY_FILTER_USE_KEY);
        return $fileArray;
    }

    public static function normalizeMessage(string $message): string
    {
        $addMemberPattern = '/<addmember><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><target>(.+)<\/target><\/addmember>/';
        $deleteMemberPattern = '/<deletemember><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><target>(.+)<\/target><\/deletemember>/';
        $topicUpdatePattern = '/<topicupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><value>(.+)<\/value><\/topicupdate>/';
        $historyDisclosurePattern = '/<historydisclosedupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><value>(true|false)<\/value><\/historydisclosedupdate>/';
        $joiningEnabledPattern = '/<joiningenabledupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator><value>(true|false)<\/value><\/joiningenabledupdate>/';
        $pictureUpdatePattern = '/<pictureupdate><eventtime>(\d+)<\/eventtime><initiator>(.+)<\/initiator>.*<\/pictureupdate>/';
        $uriObjectPattern = '/<URIObject .*url_thumbnail="([^"]+)".*>/';
        $uriObjectPattern2 = '/<URIObject .*url_thumbnail="([^"]+)"[^>]*type="([^"]+)"[^>]*>/'; // Updated pattern
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
        if(preg_match($uriObjectPattern2, $message, $matches)) {
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
