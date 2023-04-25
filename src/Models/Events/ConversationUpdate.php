<?php

namespace Akbv\PhpSkype\Models\Events;

/**
 * An event triggered by various conversation changes or messages.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class ConversationUpdate extends Event
{
    /**
     * Conversation that emitted an update.
     *
     * @var string
     */
    private $conversationId;

    /**
     *  Updated horizon string, in the form {id},{timestamp},{id}.
     * @var string
     */
    private $horizon;

    /**
     * construct message event.
     */
    public function __construct(array $raw)
    {
        parent::__construct($raw);
        $this->conversationId = $raw['resource']['id'];
        $this->horizon = $raw['resource']['properties']['consumptionhorizon'];
    }

    /**
     * Use the consumption horizon to mark the conversation as up-to-date.
     */
    public function consume(): void
    {
        //request PUT to {msgHost}/users/ME/conversations/{conversationId}/properties
        //with params {"name": "consumptionhorizon"}
        //and json {"consumptionhorizon": $this->horizon}
    }

    /**
     * Get conversation that emitted an update.
     *
     * @return  string
     */
    public function getConversationId()
    {
        return $this->conversationId;
    }

    /**
     * Get updated horizon string, in the form {id},{timestamp},{id}.
     *
     * @return  string
     */
    public function getHorizon()
    {
        return $this->horizon;
    }
}
