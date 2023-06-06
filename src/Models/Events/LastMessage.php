<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class LastMessage extends \Akbv\PhpSkype\Models\Base
{

    /**
     * The editauthorized for this lastMessage.
     * @var string
     */
    private $editauthorized;

    /**
     * The originalarrivaltime for this lastMessage.
     * @var string
     */
    private $originalarrivaltime;

    /**
     * The messagetype for this lastMessage.
     * @var string
     */
    private $messagetype;

    /**
     * The version for this lastMessage.
     * @var string
     */
    private $version;

    /**
     * The composetime for this lastMessage.
     * @var string
     */
    private $composetime;

    /**
     * The skypeeditedid for this lastMessage.
     * @var string
     */
    private $skypeeditedid;

    /**
     * The conversationLink for this lastMessage.
     * @var string
     */
    private $conversationLink;

    /**
     * The content for this lastMessage.
     * @var string
     */
    private $content;

    /**
     * The id for this lastMessage.
     * @var string
     */
    private $id;

    /**
     * The conversationid for this lastMessage.
     * @var string
     */
    private $conversationid;

    /**
     * The type for this lastMessage.
     * @var string
     */
    private $type;

    /**
     * The from for this lastMessage.
     * @var string
     */
    private $from;

    /**
     * The clientmessageid for this lastMessage.
     * @var string
     */
    private $clientmessageid;

    /**
     * The amsreferences for this lastMessage.
     * @var string[]
     */
    private $amsreferences;

    /**
     * The origincontextid for this lastMessage.
     * @var string
     */
    private $origincontextid;

    /**
     * Constructor.
     * @param mixed[] $raw
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }


    /**
     * Get the editauthorized for this lastMessage.
     *
     * @return  string
     */
    public function getEditauthorized()
    {
        return $this->editauthorized;
    }

    /**
     * Set the editauthorized for this lastMessage.
     *
     * @param  string  $editauthorized  The editauthorized for this lastMessage.
     *
     * @return  self
     */
    public function setEditauthorized(string $editauthorized)
    {
        $this->editauthorized = $editauthorized;

        return $this;
    }

    /**
     * Get the originalarrivaltime for this lastMessage.
     *
     * @return  string
     */
    public function getOriginalarrivaltime()
    {
        return $this->originalarrivaltime;
    }

    /**
     * Set the originalarrivaltime for this lastMessage.
     *
     * @param  string  $originalarrivaltime  The originalarrivaltime for this lastMessage.
     *
     * @return  self
     */
    public function setOriginalarrivaltime(string $originalarrivaltime)
    {
        $this->originalarrivaltime = $originalarrivaltime;

        return $this;
    }

    /**
     * Get the messagetype for this lastMessage.
     *
     * @return  string
     */
    public function getMessagetype()
    {
        return $this->messagetype;
    }

    /**
     * Set the messagetype for this lastMessage.
     *
     * @param  string  $messagetype  The messagetype for this lastMessage.
     *
     * @return  self
     */
    public function setMessagetype(string $messagetype)
    {
        $this->messagetype = $messagetype;

        return $this;
    }

    /**
     * Get the version for this lastMessage.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version for this lastMessage.
     *
     * @param  string  $version  The version for this lastMessage.
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the composetime for this lastMessage.
     *
     * @return  string
     */
    public function getComposetime()
    {
        return $this->composetime;
    }

    /**
     * Set the composetime for this lastMessage.
     *
     * @param  string  $composetime  The composetime for this lastMessage.
     *
     * @return  self
     */
    public function setComposetime(string $composetime)
    {
        $this->composetime = $composetime;

        return $this;
    }

    /**
     * Get the skypeeditedid for this lastMessage.
     *
     * @return  string
     */
    public function getSkypeeditedid()
    {
        return $this->skypeeditedid;
    }

    /**
     * Set the skypeeditedid for this lastMessage.
     *
     * @param  string  $skypeeditedid  The skypeeditedid for this lastMessage.
     *
     * @return  self
     */
    public function setSkypeeditedid(string $skypeeditedid)
    {
        $this->skypeeditedid = $skypeeditedid;

        return $this;
    }

    /**
     * Get the conversationLink for this lastMessage.
     *
     * @return  string
     */
    public function getConversationLink()
    {
        return $this->conversationLink;
    }

    /**
     * Set the conversationLink for this lastMessage.
     *
     * @param  string  $conversationLink  The conversationLink for this lastMessage.
     *
     * @return  self
     */
    public function setConversationLink(string $conversationLink)
    {
        $this->conversationLink = $conversationLink;

        return $this;
    }

    /**
     * Get the content for this lastMessage.
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content for this lastMessage.
     *
     * @param  string  $content  The content for this lastMessage.
     *
     * @return  self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the id for this lastMessage.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id for this lastMessage.
     *
     * @param  string  $id  The id for this lastMessage.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the conversationid for this lastMessage.
     *
     * @return  string
     */
    public function getConversationid()
    {
        return $this->conversationid;
    }

    /**
     * Set the conversationid for this lastMessage.
     *
     * @param  string  $conversationid  The conversationid for this lastMessage.
     *
     * @return  self
     */
    public function setConversationid(string $conversationid)
    {
        $this->conversationid = $conversationid;

        return $this;
    }

    /**
     * Get the type for this lastMessage.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type for this lastMessage.
     *
     * @param  string  $type  The type for this lastMessage.
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the from for this lastMessage.
     *
     * @return  string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the from for this lastMessage.
     *
     * @param  string  $from  The from for this lastMessage.
     *
     * @return  self
     */
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the clientmessageid for this lastMessage.
     *
     * @return  string
     */
    public function getClientmessageid()
    {
        return $this->clientmessageid;
    }

    /**
     * Set the clientmessageid for this lastMessage.
     *
     * @param  string  $clientmessageid  The clientmessageid for this lastMessage.
     *
     * @return  self
     */
    public function setClientmessageid(string $clientmessageid)
    {
        $this->clientmessageid = $clientmessageid;

        return $this;
    }

    /**
     * Get the amsreferences for this lastMessage.
     *
     * @return  string[]
     */
    public function getAmsreferences()
    {
        return $this->amsreferences;
    }

    /**
     * Set the amsreferences for this lastMessage.
     *
     * @param  string[]  $amsreferences  The amsreferences for this lastMessage.
     *
     * @return  self
     */
    public function setAmsreferences(array $amsreferences)
    {
        $this->amsreferences = $amsreferences;

        return $this;
    }

    /**
     * Get the origincontextid for this lastMessage.
     *
     * @return  string
     */
    public function getOrigincontextid()
    {
        return $this->origincontextid;
    }

    /**
     * Set the origincontextid for this lastMessage.
     *
     * @param  string  $origincontextid  The origincontextid for this lastMessage.
     *
     * @return  self
     */
    public function setOrigincontextid(string $origincontextid)
    {
        $this->origincontextid = $origincontextid;

        return $this;
    }
}
