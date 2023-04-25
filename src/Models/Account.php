<?php

namespace Akbv\PhpSkype\Models;

/**
 * Common account class that holds basic information.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class Account extends Base
{
    /**
     * Username.
     *
     * @var string
     */
    private $username;

    /**
     * Password.
     *
     * @var string
     */
    private $password;

    /**
     * Conversation interface for account.
     *
     * @var Conversation
     */
    private $conversation;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param Conversation $conversation
     */
    public function setConversation(Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * @return Conversation|null
     */
    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }
}
