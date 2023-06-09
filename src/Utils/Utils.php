<?php

namespace Akbv\PhpSkype\Utils;

class Utils
{
    public const STATUS_ONLINE = 'Online';
    public const STATUS_IDLE = 'Idle';
    public const STATUS_AWAY = 'Away';
    public const STATUS_BUSY = 'Busy';
    public const STATUS_HIDDEN = 'Hidden';
    public const STATUS_OFFLINE = 'Offline';

    /**
     * Extract all params from arrays and merge them into one array recursively.
     * @param mixed[] $arrays
     * @return mixed[]
     */
    public function deepMergeArrays($arrays)
    {
        $result = [];
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (!isset($result[$key])) {
                    $result[$key] = $value;
                } else {
                    if (is_array($result[$key]) && is_array($value)) {
                        $result[$key] = $this->deepMergeArrays([$result[$key], $value]);
                    } else {
                        if ($value !== null) {
                            $result[$key] = $value;
                        }
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
}
