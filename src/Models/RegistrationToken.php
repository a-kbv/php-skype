<?php

namespace Akbv\PhpSkype\Models;

use DateTime;

/**
 * Property for class @see Session that holds data retrieved from Registration Token.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class RegistrationToken extends Base
{
    /**
     * 886 chars string obtained from logging in skype account
     * @var string
     */
    private $registrationToken;

    /**
     * @var mixed[]
     */
    private $response;

    /**
     * Uses for Client communication with Skype Server.
     * @var string
     */
    private $messengerUrl;

    /**
     * DateTime until the token is valid.
     *
     * @var DateTime
     */
    private $expiry;

    /**
     * @return string
     */
    public function getRegistrationToken(): string
    {
        return $this->registrationToken;
    }

    /**
     * @param string $value
     */
    public function setRegistrationToken(string $value): self
    {
        $this->registrationToken = $value;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * @param mixed[] $value
     */
    public function setResponse(array $value): self
    {
        $this->response = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessengerUrl(): string
    {
        return $this->messengerUrl;
    }

    /**
     * @param string $value
     */
    public function setMessengerUrl(string $value): self
    {
        $this->messengerUrl = $value;

        return $this;
    }


    /**
     * Get dateTime until the token is valid.
     *
     * @return  DateTime
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * Set dateTime until the token is valid.
     *
     * @param  DateTime  $expiry  DateTime until the token is valid.
     *
     * @return  self
     */
    public function setExpiry(DateTime $expiry): self
    {
        $this->expiry = $expiry;

        return $this;
    }
}
