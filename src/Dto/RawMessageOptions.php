<?php

namespace Akbv\PhpSkype\Dto;

/**
 * Data transfer Object for building raw message options
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class RawMessageOptions extends Dto
{
    /**
     * identifier of an existing message to replace
     * @var string $editId
     */
    private $editId;

    /**
     * plain or HTML body for the message
     * @var string $content
     */
    private $content;

    /**
     * format of the message, normally ``text``
     * @var string $contentType
     */
    private $contentType = 'text';

    /**
     * base message type
     * @var string $messageType
     */
    private $messageType = 'Text';

    /**
     * used with action messages to control where the user's name ends
     * @var int $skypeEmoteOffset
     */
    private $skypeEmoteOffset;

    /**
     * whether the message mentions any other users
     * @var string $hasMentions
     */
    private $hasMentions;



    /**
     * Get $editId
     *
     * @return  string
     */
    public function getEditId()
    {
        return $this->editId;
    }

    /**
     * Set $editId
     *
     * @param  string  $editId  $editId
     *
     * @return  self
     */
    public function setEditId(string $editId)
    {
        $this->editId = $editId;

        return $this;
    }

    /**
     * Get $content
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set $content
     *
     * @param  string  $content  $content
     *
     * @return  self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get $contentType
     *
     * @return  string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set $contentType
     *
     * @param  string  $contentType  $contentType
     *
     * @return  self
     */
    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get $messageType
     *
     * @return  string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Set $messageType
     *
     * @param  string  $messageType  $messageType
     *
     * @return  self
     */
    public function setMessageType(string $messageType)
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Get $skypeEmoteOffset
     *
     * @return  int
     */
    public function getSkypeEmoteOffset()
    {
        return $this->skypeEmoteOffset;
    }

    /**
     * Set $skypeEmoteOffset
     *
     * @param  int  $skypeEmoteOffset  $skypeEmoteOffset
     *
     * @return  self
     */
    public function setSkypeEmoteOffset(int $skypeEmoteOffset)
    {
        $this->skypeEmoteOffset = $skypeEmoteOffset;

        return $this;
    }

    /**
     * Get $hasMentions
     *
     * @return  string
     */
    public function getHasMentions()
    {
        return $this->hasMentions;
    }

    /**
     * Set $hasMentions
     *
     * @param  string  $hasMentions  $hasMentions
     *
     * @return  self
     */
    public function setHasMentions(string $hasMentions)
    {
        $this->hasMentions = $hasMentions;

        return $this;
    }
}
