<?php

namespace Akbv\PhpSkype\Dto\SkypeChat;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChatDto {

    /**
     * @var \Akbv\PhpSkype\Model\SkypeChat\SkypeChat[] $chats
     */
    private $chats;

    /**
     * @var string $syncState
     */
    private $syncState;


    private function toArray() {
        return [
            'chats' => array_map(function($chat) {
                return $chat->toArray();
            }, $this->chats),
            'syncState' => $this->syncState
        ];
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

    /**
     * Get $chats
     *
     * @return  \Akbv\PhpSkype\Model\SkypeChat\SkypeChat[]
     */
    public function getChats()
    {
        return $this->chats;
    }

    /**
     * Set $chats
     *
     * @param  \Akbv\PhpSkype\Model\SkypeChat\SkypeChat[]  $chats  $chats
     *
     * @return  self
     */
    public function setChats(array $chats)
    {
        $this->chats = $chats;

        return $this;
    }
}
