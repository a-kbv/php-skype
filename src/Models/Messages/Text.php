<?php

namespace Akbv\PhpSkype\Models\Messages;

use Akbv\PhpSkype\Models\Message;

/**
 * A message containing rich or plain text.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Text extends Message
{
    /**
     * The text content of the message.
     * Message content converted to plain text.
     * Hyperlinks are replaced with their target, quotes are converted to the legacy format,
     *  and all other HTML tags are stripped from the text.
     * @var string
     */
    private $plain;

    /**
     * The text content of the message.
     * Message converted to plain text, retaining formatting markup.
     * Hyperlinks become their target, message edit tags are stripped, and legacy quote text is used.
     * @var string
     */
    private $markup;

    /**
     * Constructor.
     * @param mixed[] $raw raw data
     */
    public function __construct(array $raw)
    {
        parent::__construct($raw);
        $this->plain = $this->translateToPlain($this->getContent());
        $this->markup = $this->translateToMarkup($this->getContent());
    }

    /**
     * Get the text content of the message.
     * Message content converted to plain text.
     * Hyperlinks are replaced with their target, quotes are converted to the legacy format,
     * and all other HTML tags are stripped from the text.
     * @param string $content
     * @return string
     */
    public function translateToPlain(string $content): string
    {
        if (empty($content)) {
            return '';
        }
        $text = preg_replace('/<\/?(e|b|i|ss?|pre|quote|legacyquote)\b.*?>/', '', $content);
        $text = preg_replace('/<a\b.*?href="(.*?)">.*?<\/a>/', '\\1', $text);
        $text = preg_replace('/<at\b.*?id="8:(.*?)">.*?<\/at>/', '@\\1', $text);
        $text = preg_replace('/<e_m\b.*?>.*?<\/e_m>/', '', $text);
        $text = str_replace('&lt;', '<', $text);
        $text = str_replace('&gt;', '>', $text);
        $text = str_replace('&amp;', '&', $text);
        $text = str_replace('&quot;', '\"', $text);
        $text = str_replace('&apos;', '\'', $text);
        return $text;
    }

    /**
     * Get the text content of the message.
     * Message converted to plain text, retaining formatting markup.
     * Hyperlinks become their target, message edit tags are stripped, and legacy quote text is used.
     * @param string $content
     * @return string
     */
    public function translateToMarkup(string $content): string
    {
        if (empty($content)) {
            return '';
        }
        $text = preg_replace('/<\/?(e|ss|quote|legacyquote)\b.*?>/', '', $content);
        $text = preg_replace('/<\/?b\b.*?>/', '*', $text);
        $text = preg_replace('/<\/?i\b.*?>/', '_', $text);
        $text = preg_replace('/<\/?s\b.*?>/', '~', $text);
        $text = preg_replace('/<\/?pre\b.*?>/', '{code}', $text);
        $text = preg_replace('/<a\b.*?href="(.*?)">.*?<\/a>/', '\\1', $text);
        $text = preg_replace('/<at\b.*?id="8:(.*?)">.*?<\/at>/', '@\\1', $text);
        $text = preg_replace('/<e_m\b.*?>.*?<\/e_m>/', '', $text);
        $text = str_replace(['&lt;', '&gt;', '&amp;', '&quot;', '&apos;'], ['<', '>', '&', '"', "'"], $text);
        return $text;
    }



    /**
     * Get and all other HTML tags are stripped from the text.
     *
     * @return  string
     */
    public function getPlain()
    {
        return $this->plain;
    }

    /**
     * Get hyperlinks become their target, message edit tags are stripped, and legacy quote text is used.
     *
     * @return  string
     */
    public function getMarkup()
    {
        return $this->markup;
    }
}
