<?php

namespace Akbv\PhpSkype\Interfaces;

use Akbv\PhpSkype\Exceptions\AccountCacheFileSaveException;
use Akbv\PhpSkype\Exceptions\SessionDirCreateException;
use Akbv\PhpSkype\Exceptions\SessionException;
use Akbv\PhpSkype\Exceptions\SessionFileLoadException;
use Akbv\PhpSkype\Exceptions\SessionFileRemoveException;
use Akbv\PhpSkype\Exceptions\ClientSecurityTokenException;
use Akbv\PhpSkype\Exceptions\ClientSkypeTokenException;
use Akbv\PhpSkype\Models\Account;
use Akbv\PhpSkype\Models\Contact;
use Akbv\PhpSkype\Chat;
use Akbv\PhpSkype\Models\Session;
use DateTime;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class SkypeClient implements methods to interact with Skype Server.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
interface ClientInterface
{
    /**
     * Login process consists from 2 parts: login to Microsoft & login to Skype.
     * This method create/restore session and setup expire date for session and save to session storage.
     * @param Account $account
     * @param DateTime|null $now
     * @return Session
     * @throws ClientSecurityTokenException
     * @throws ClientSkypeTokenException
     * @throws SessionException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws AccountCacheFileSaveException
     * @throws SessionDirCreateException
     * @throws SessionFileLoadException
     * @throws SessionFileRemoveException
     */
    public function login(Account $account, DateTime $now = null): Session;

    /**
     * Get current user properties.
     * @return mixed[]
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMyProperties(): array;

    /**
     * Get current user profile.
     * @return mixed[]
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMyProfile(): array;

    /**
     * Get current user invites list.
     * @return mixed[]
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMyInvites(): array;

    /**
     * Get Contacts list.
     * @return \Akbv\PhpSkype\Models\Contact[]
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getAllContacts(): array;

    /**
     * Create a new group chat.
     * @param mixed[] $contacts
     * @param mixed[] $admins
     * @param bool $moderated
     * @return Chat
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function groupChat(array $contacts, array $admins, bool $moderated=false): Chat;

    /**
     * Get Contacts Details.
     * @param string $contactId
     * @return \Akbv\PhpSkype\Models\Contact
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getContactDetails(string $contactId): Contact;

    /**
     * Retrieve a selection of conversations with the most recent activity.
     * @return mixed[]
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getRecentChats(): array;

    /**
     * Configure endpoint.
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function configureEndpoint(): void;

    /**
     * Subscribe to contact and conversation events. These are accessible through @method getEvents().
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function subscribeEndpoint(): void;
    /**
     * Enable presence subscriptions for the authenticated user's contacts
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function subscribePresence(): void;

    /**
     * Retrieve array of events since last call to this method.
     * To retrieve all events will be needed multiple calls.
     * If no event occurs since last call, the API will block for up to ~83 seconds. after that, it will return an empty array.
     * If any event occurs, the API will return immediately.
     * @return mixed[]
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getEvents(): array;

    /**
     * Configure this endpoint to allow setting presence.
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function allowPresence(): void;
    /**
     * Send a keep-alive request for the endpoint.
     * Skype Web is requests every 30 seconds with json param "timeout" of 120 seconds.
     * @param int $timeout
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function pingEndpoint(int $timeout): void;
    /**
     * Send a keep-alive request for the endpoint.
     * @param string $status
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function setUserPresence(string $status): void;
}
