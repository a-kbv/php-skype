<?php

namespace Akbv\PhpSkype\Dto\SkypeMessage;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeMessageDto {

    /**
     * @var \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage[] $messages
     */
    private $messages;

    /**
     * @var string $syncState
     */
    private $syncState;


    private function toArray() {
        return [
            'messages' => array_map(function($message) {
                return $message->toArray();
            }, $this->messages),
            'syncState' => $this->syncState
        ];
    }


    /**
     * Get $messages
     *
     * @return  \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set $messages
     *
     * @param  \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage[]  $messages
     *
     * @return  self
     */
    public function setMessages(array $messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Get $syncState
     *
     * @return  string
     */
    public function getSyncState()
    {
        return $this->syncState;
    }

    /**
     * Set $syncState
     *
     * @param  string  $syncState  $syncState
     *
     * @return  self
     */
    public function setSyncState(string $syncState)
    {
        $this->syncState = $syncState;

        return $this;
    }
}
