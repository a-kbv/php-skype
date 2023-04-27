<?php

namespace Akbv\PhpSkype\Models\Events;

use PhpCsFixer\Fixer\Operator\TernaryToElvisOperatorFixer;

/**
 * An event triggered by various conversation changes or messages.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class ConversationUpdate extends Event
{
    /**
     * Conversation that emitted an update.
     *
     * @var Object
     */
    private $conversation;

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
        $id = isset($raw['resource']['id']) ? $raw['resource']['id'] : null;
        if (substr($id, 0, 3) == "19:") {
            $this->conversation = new \Akbv\PhpSkype\Models\GroupChat($raw['resource']);
        } else {
            $this->conversation = new \Akbv\PhpSkype\Models\SingleChat($raw['resource']);
        }
        $this->horizon = isset($raw['resource']['properties']['consumptionhorizon']) ? $raw['resource']['properties']['consumptionhorizon'] : null;
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
     * Get updated horizon string, in the form {id},{timestamp},{id}.
     *
     * @return  string
     */
    public function getHorizon()
    {
        return $this->horizon;
    }

    /**
     * Get conversation that emitted an update.
     *
     * @return  Object
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set conversation that emitted an update.
     *
     * @param  Object  $conversation  Conversation that emitted an update.
     *
     * @return  self
     */
    public function setConversation(Object $conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }
}
