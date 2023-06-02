<?php
namespace Akbv\PhpSkype\Models;

/**
 * Class for mapping the chat properties.
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class ChatProperties extends Base
{

    /**
     * Last leave at
     * @var string
     */
    private $lastleaveat;

    /**
     * Banned user list
     * @var string
     */
    private $banneduserlist;

    /**
     * Creator cid
     * @var string
     */
    private $creatorcid;

    /**
     * Topic
     * @var string
     */
    private $topic;

    /**
     * Created at
     * @var string
     */
    private $createdat;

    /**
     * Creator
     * @var string
     */
    private $creator;

    /**
     * History disclosed
     * @var string
     */
    private $historydisclosed;

    /**
     * Capabilities
     * @var string[]
     */
    private $capabilities;

    /**
     * Conversation status properties
     * @var string
     */
    private $conversationstatusproperties;

    /**
     * One to one thread id
     * @var string
     */
    private $onetoonethreadid;

    /**
     * Last im received time
     * @var string
     */
    private $lastimreceivedtime;

    /**
     * Consumption horizon
     * @var string
     */
    private $consumptionhorizon;

    /**
     * Conversation blocked
     * @var string
     */
    private $conversationblocked;

    /**
     * Conversation status
     * @var string
     */
    private $conversationstatus;

    /**
     * Is empty conversation
     * @var string
     */
    private $isemptyconversation;

    /**
     * Cleared at
     * @var string
     */
    private $clearedat;

    /**
     * Picture
     * @var string
     */
    private $picture;

    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }

    /**
     * Get last leave at
     *
     * @return  string
     */
    public function getLastleaveat()
    {
        return $this->lastleaveat;
    }

    /**
     * Set last leave at
     *
     * @param  string  $lastleaveat  Last leave at
     *
     * @return  self
     */
    public function setLastleaveat(string $lastleaveat)
    {
        $this->lastleaveat = $lastleaveat;

        return $this;
    }

    /**
     * Get banned user list
     *
     * @return  string
     */
    public function getBanneduserlist()
    {
        return $this->banneduserlist;
    }

    /**
     * Set banned user list
     *
     * @param  string  $banneduserlist  Banned user list
     *
     * @return  self
     */
    public function setBanneduserlist(string $banneduserlist)
    {
        $this->banneduserlist = $banneduserlist;

        return $this;
    }

    /**
     * Get creator cid
     *
     * @return  string
     */
    public function getCreatorcid()
    {
        return $this->creatorcid;
    }

    /**
     * Set creator cid
     *
     * @param  string  $creatorcid  Creator cid
     *
     * @return  self
     */
    public function setCreatorcid(string $creatorcid)
    {
        $this->creatorcid = $creatorcid;

        return $this;
    }

    /**
     * Get topic
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set topic
     *
     * @param  string  $topic  Topic
     *
     * @return  self
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get created at
     *
     * @return  string
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set created at
     *
     * @param  string  $createdat  Created at
     *
     * @return  self
     */
    public function setCreatedat(string $createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get creator
     *
     * @return  string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creator
     *
     * @param  string  $creator  Creator
     *
     * @return  self
     */
    public function setCreator(string $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get history disclosed
     *
     * @return  string
     */
    public function getHistorydisclosed()
    {
        return $this->historydisclosed;
    }

    /**
     * Set history disclosed
     *
     * @param  string  $historydisclosed  History disclosed
     *
     * @return  self
     */
    public function setHistorydisclosed(string $historydisclosed)
    {
        $this->historydisclosed = $historydisclosed;

        return $this;
    }

    /**
     * Get capabilities
     *
     * @return  string[]
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * Set capabilities
     *
     * @param  string[]  $capabilities  Capabilities
     *
     * @return  self
     */
    public function setCapabilities(array $capabilities)
    {
        $this->capabilities = $capabilities;

        return $this;
    }

    /**
     * Get conversation status properties
     *
     * @return  string
     */
    public function getConversationstatusproperties()
    {
        return $this->conversationstatusproperties;
    }

    /**
     * Set conversation status properties
     *
     * @param  string  $conversationstatusproperties  Conversation status properties
     *
     * @return  self
     */
    public function setConversationstatusproperties(string $conversationstatusproperties)
    {
        $this->conversationstatusproperties = $conversationstatusproperties;

        return $this;
    }

    /**
     * Get one to one thread id
     *
     * @return  string
     */
    public function getOnetoonethreadid()
    {
        return $this->onetoonethreadid;
    }

    /**
     * Set one to one thread id
     *
     * @param  string  $onetoonethreadid  One to one thread id
     *
     * @return  self
     */
    public function setOnetoonethreadid(string $onetoonethreadid)
    {
        $this->onetoonethreadid = $onetoonethreadid;

        return $this;
    }

    /**
     * Get last im received time
     *
     * @return  string
     */
    public function getLastimreceivedtime()
    {
        return $this->lastimreceivedtime;
    }

    /**
     * Set last im received time
     *
     * @param  string  $lastimreceivedtime  Last im received time
     *
     * @return  self
     */
    public function setLastimreceivedtime(string $lastimreceivedtime)
    {
        $this->lastimreceivedtime = $lastimreceivedtime;

        return $this;
    }

    /**
     * Get consumption horizon
     *
     * @return  string
     */
    public function getConsumptionhorizon()
    {
        return $this->consumptionhorizon;
    }

    /**
     * Set consumption horizon
     *
     * @param  string  $consumptionhorizon  Consumption horizon
     *
     * @return  self
     */
    public function setConsumptionhorizon(string $consumptionhorizon)
    {
        $this->consumptionhorizon = $consumptionhorizon;

        return $this;
    }

    /**
     * Get conversation blocked
     *
     * @return  string
     */
    public function getConversationblocked()
    {
        return $this->conversationblocked;
    }

    /**
     * Set conversation blocked
     *
     * @param  string  $conversationblocked  Conversation blocked
     *
     * @return  self
     */
    public function setConversationblocked(string $conversationblocked)
    {
        $this->conversationblocked = $conversationblocked;

        return $this;
    }

    /**
     * Get conversation status
     *
     * @return  string
     */
    public function getConversationstatus()
    {
        return $this->conversationstatus;
    }

    /**
     * Set conversation status
     *
     * @param  string  $conversationstatus  Conversation status
     *
     * @return  self
     */
    public function setConversationstatus(string $conversationstatus)
    {
        $this->conversationstatus = $conversationstatus;

        return $this;
    }

    /**
     * Get is empty conversation
     *
     * @return  string
     */
    public function getIsemptyconversation()
    {
        return $this->isemptyconversation;
    }

    /**
     * Set is empty conversation
     *
     * @param  string  $isemptyconversation  Is empty conversation
     *
     * @return  self
     */
    public function setIsemptyconversation(string $isemptyconversation)
    {
        $this->isemptyconversation = $isemptyconversation;

        return $this;
    }

    /**
     * Get cleared at
     *
     * @return  string
     */
    public function getClearedat()
    {
        return $this->clearedat;
    }

    /**
     * Set cleared at
     *
     * @param  string  $clearedat  Cleared at
     *
     * @return  self
     */
    public function setClearedat(string $clearedat)
    {
        $this->clearedat = $clearedat;

        return $this;
    }

    /**
     * Get picture
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture
     *
     * @param  string  $picture  Picture
     *
     * @return  self
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }
}
