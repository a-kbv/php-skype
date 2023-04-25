<?php

namespace Akbv\PhpSkype;

use Akbv\PhpSkype\Utils\DebugUtil;
use Akbv\PhpSkype\Interfaces\ClientInterface;
use Akbv\PhpSkype\Exceptions\ClientSecurityTokenException;
use Akbv\PhpSkype\Exceptions\ClientSkypeTokenException;
use Akbv\PhpSkype\Exceptions\SessionException;
use Akbv\PhpSkype\Models\Account;
use Akbv\PhpSkype\Models\Contact;
use Akbv\PhpSkype\Models\Conversation;
use Akbv\PhpSkype\Models\SecurityToken;
use Akbv\PhpSkype\Models\RegistrationToken;
use Akbv\PhpSkype\Models\Session;
use Akbv\PhpSkype\Models\SkypeToken;
use Akbv\PhpSkype\Models\Endpoint;
use Akbv\PhpSkype\Services\SessionManager;
use Akbv\PhpSkype\Utils\Utils;
use DateTime;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class SkypeClient implements methods to interact with Skype Server.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
final class Client implements ClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var SessionManager
     */
    private $sessionManager;

    /**
     * @var Session
     */
    private $session = null;

    public const STATUS_OFFLINE = 'Offline';
    public const STATUS_HIDDEN = 'Hidden';
    public const STATUS_BUSY = 'Busy';
    public const STATUS_AWAY = 'Away';
    public const STATUS_IDLE = 'Idle';
    public const STATUS_ONLINE = 'Online';

    public function __construct(SessionManager $sessionManager)
    {
        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36',
                'Referer' => 'https://web.skype.com/',
            ],
        ]);
        $this->sessionManager = $sessionManager;
    }


    /**
     * Get the value of session
     *
     * @return  Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set the value of session
     *
     * @param  Session  $session
     *
     * @return  self
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * *******************************************************
     * *******************************************************
     *                  *** Login ***
     * *******************************************************
     * *******************************************************
     */

    /**
     * Make server request.
     * Extends basic options by internal.
     * Catch redirects while request.
     * @param string $method
     * @param string $url
     * @param mixed[] $options [
     *    'authorization_session' => <Session> Add auth headers by Session.
     * ]
     * @param string $redirectUrl Returns url on that those 301 redirect.
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function request(string $method, string $url, array $options = [], string &$redirectUrl = null): ?ResponseInterface
    {
        if (isset($options['authorization_session'])) {
            /* @var $session Session */
            $session = $options['authorization_session'];
            if ($session->getSkypeToken()) {
                $options['headers']['X-Skypetoken'] = $session->getSkypeToken()->getSkypeToken();
                $options['headers']['Authentication'] = 'skypetoken=' . $session->getSkypeToken()->getSkypeToken();
            }
            if ($session->getRegistrationToken()) {
                $options['headers']['RegistrationToken'] = 'registrationToken=' . $session->getRegistrationToken()->getRegistrationToken();
            }
            if (!isset($options['timeout'])) {
                $options['timeout'] = 60;
            }
            unset($options['authorization_session']);
        }
        $options['on_progress'] = function (int $dlNow, int $dlSize, array $info) use (&$redirectUrl): void {
            if (isset($info['http_code']) && ($info['http_code'] == 301)) {
                foreach ($info['response_headers'] as $responseHeader) {
                    if ('location' === substr($responseHeader, 0, 8)) {
                        $redirectUrl = trim(substr($responseHeader, 9));
                        break;
                    }
                }
            }
        };
        $response = $this->httpClient->request($method, $url, $options);
        // Try to execute Request.
        try {
            $response->getContent();
        } catch (ClientException $exception) {
            // For testing purpose Skype can change Server Messenger URL and attempting to request should be repeated.
            if (!empty($redirectUrl)) {
                $response = $this->request($method, $redirectUrl, $options, $redirectUrl);
            } else {
                throw $exception;
            }
        }
        return $response;
    }

    /**
     * Login on Microsoft web page with SOAP and retrieves from Microsoft arguments BinarySecurityToken.

     * @return SecurityToken
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws ClientSecurityTokenException
     */
    private function getSecurityToken(): Models\SecurityToken
    {
        $user = \Akbv\PhpSkype\Utils\Utils::encodeValue($this->getSession()->getAccount()->getUsername());
        $pwd = \Akbv\PhpSkype\Utils\Utils::encodeValue($this->getSession()->getAccount()->getPassword());
        $template = file_get_contents(__DIR__ . '/Resources/soapTemplate.xml');

        // Replace placeholders in the template with actual values
        $template = str_replace('{username}', $user, $template);
        $template = str_replace('{password}', $pwd, $template);

        $response = $this->request('POST', 'https://login.live.com/RST.srf', [
            'headers' => [
                'Content-Type' => 'application/soap+xml; charset=utf-8',
                'Content-Length' => strlen($template),
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.111 Safari/537.36',
            ],
            'body' => $template,
        ]);

        if (!$response || $response->getStatusCode() !== 200) {
            throw new  ClientSecurityTokenException("Failed to get login response for security token");
        }

        $xmlString = $response->getContent();
        $binarySecurityTokenRegex = '/<wsse:BinarySecurityToken[^>]*>(.*?)<\/wsse:BinarySecurityToken>/';
        preg_match($binarySecurityTokenRegex, $xmlString, $matches);

        $binarySecurityToken = $matches[1] ?? '';
        $token = substr($binarySecurityToken, 2);

        $securityToken = new Models\SecurityToken();
        $securityToken->setToken($token);

        if (!$token) {
            throw new  ClientSecurityTokenException("Couldn't retrieve security token from login response");
        }

        return $securityToken;
    }

    /**
     * Login on Microsoft Redirect web page and setup Microsoft arguments
     * This method depends of @see loginMicrosoft retrieved values.
     * @return SkypeToken
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws ClientSkypeTokenException
     */
    private function exchangeSecurityToken(): SkypeToken
    {
        $data = ["partner" => "999", "access_token" => $this->getSession()->getSecurityToken()->getToken(), "scopes" => "client"];
        $data = json_encode($data);
        $response = $this->request('POST', 'https://edge.skype.com/rps/v1/rps/skypetoken/', [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
                'Content-Length' => strlen($data),
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.111 Safari/537.36',
            ],
            'body' => $data,
            'verify_peer' => false,
            'verify_host' => false,
        ]);

        if (!$response || $response->getStatusCode() !== 200) {
            throw new ClientSkypeTokenException("Failed to get login response for skype token");
        }

        $jsonString = $response->getContent();
        $responseBody = json_decode($jsonString);

        if (!$responseBody || !$responseBody->skypetoken) {
            throw new ClientSkypeTokenException("Couldn't retrieve Skype token from login response");
        }

        $skypeToken = new SkypeToken();
        $skypeToken->setSkypeToken($responseBody->skypetoken);
        $skypeToken->setExpiresIn($responseBody->expiresIn);

        DebugUtil::log("Aquired new Skype token", $responseBody->skypetoken ?? [], 200);
        return $skypeToken;
    }


    /**
     * Register in the Skype and setup registrationToken.
     * This method depends of @see loginSkype retrieved values.
     * Method detects Messenger URL by redirecting on Clients Server.
     * @return mixed[]
     * @throws SessionException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getRegistrationToken(): array
    {
        $msgsHost = "https://client-s.gateway.messenger.live.com/v1";
        $registrationToken = null;
        $expiry = null;
        $endpoint = null;
        $endpointResponse = null;

        while (!$registrationToken) {
            $headers = [
                "BehaviorOverride" => "redirectAs404"
            ];
            try {
                $endpointResponse = $this->request('POST', "$msgsHost/users/ME/endpoints", [
                    'headers' => $headers,
                    'json' => [
                        "endpointFeatures" => "Agent"
                    ],
                    'authorization_session' => $this->getSession(),
                ]);
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $headersArray = $response->getInfo()['response_headers'];
                $locHead = array_filter($headersArray, function ($header) {
                    return strpos($header, 'Location: ') !== false;
                });
                $locHead = array_shift($locHead);
                $locHead = str_replace('Location: ', '', $locHead);

                $locParts = explode('/', $locHead);
                $msgsHost = implode('/', array_slice($locParts, 0, -3));
                continue;
            }

            $locationHeader = $endpointResponse->getHeaders()['location'][0] ?? null;
            $registrationTokenHeader = $endpointResponse->getHeaders()['set-registrationtoken'][0] ?? null;
            if ($locationHeader) {
                preg_match('/(https:\/\/[^\/]+\/v1)\/users\/ME\/endpoints(\/(%7B[a-z0-9\-]+%7D))?/', $locationHeader, $locParts);
                if (isset($locParts[3])) {
                    $endpoint = str_replace("%7B", "{", str_replace("%7D", "}", $locParts[3]));
                }
                # Skype is requiring the use of a different hostname.
                if ($locParts[1] !== $msgsHost) {
                    # Don't accept the token if present, we need to re-register first.
                    $msgsHost = $locParts[1];
                    continue;
                }
            }

            if (!empty($registrationTokenHeader)) {
                preg_match('/(registrationToken=[a-z0-9\+\/=]+)/i', $registrationTokenHeader, $matches);
                $registrationToken = $matches[1] ?? null;
                $registrationToken = substr($registrationToken, 18);
                preg_match('/expires=(\d+)/', $registrationTokenHeader, $regExpiryMatch);
                if (isset($regExpiryMatch[1])) {
                    $expiry = \DateTime::createFromFormat("U", $regExpiryMatch[1]);
                }
                preg_match('/endpointId=(\{[a-z0-9\-]+\})/', $registrationTokenHeader, $regEndMatch);
                if (isset($regEndMatch[1])) {
                    $endpoint = $regEndMatch[1];
                }
            }

            if (!$endpoint && in_array($endpointResponse->getStatusCode(), [200]) && $endpointResponse->getContent()) {
                $endpoint = json_decode($endpointResponse->getContent(), true)[0]["id"];
            }
        }

        $endpointModel = new Endpoint();
        $endpointModel->setId($endpoint);

        $registrationTokenModel = new RegistrationToken();
        $registrationTokenModel->setRegistrationToken($registrationToken);
        $registrationTokenModel->setMessengerUrl($msgsHost);
        $registrationTokenModel->setExpiry($expiry);
        $registrationTokenModel->setResponse([$endpointResponse->getContent()]);


        return ["registrationToken" => $registrationTokenModel, "endpoint" => $endpointModel];
    }

    /**
     * {@inheritdoc}
     */
    public function login(Account $account, DateTime $now = null): Session
    {
        $this->session = $this->sessionManager->loadAccountSession($account);
        if ($this->session->isNew()) {
            DebugUtil::log("Creating new session", [], 200);
            $securityToken = $this->getSecurityToken();
            DebugUtil::log("Obtained binary security token", $securityToken, 200);
            $this->session->setSecurityToken($securityToken);
            $skypeToken = $this->exchangeSecurityToken();
            DebugUtil::log("Exchanged security token for skype token", $skypeToken, 200);
            $this->session->setSkypeToken($skypeToken);
            $data = $this->getRegistrationToken();
            $registrationToken = $data['registrationToken'];
            DebugUtil::log("Obtained registration token", $registrationToken, 200);
            $endpoint = $data['endpoint'];
            DebugUtil::log("Obtained endpoint data", $endpoint, 200);
            $this->session->setRegistrationToken($registrationToken);
            $profile = $this->loadMyProfile();
            DebugUtil::log("Obtained profile Info", $profile, 200);
            $conversation = new Conversation($profile['username'], $profile['firstname'] . ' ' . $profile['lastname']);
            DebugUtil::log("Create self conversation", $conversation, 200);
            $account->setConversation($conversation);
            $this->session->setEndpoint($endpoint);
            $this->configureEndpoint();
            $this->sessionManager->saveSession($this->getSession());
            DebugUtil::log("Saving session", $this->getSession(), 200);
        } elseif ($this->session->isExpired($now)) {
            DebugUtil::log("Removing Old session (expired)", $this->getSession(), 200);
            $this->sessionManager->removeSession($this->getSession());
        }
        return $this->getSession();
    }


    /**
     * *******************************************************
     * *******************************************************
     *             *** User Profile ***
     * *******************************************************
     * *******************************************************
     */


    /**
     * {@inheritdoc}
     */
    public function loadMyProperties(): array
    {
        $url = sprintf('%s/users/ME/properties', $this->getSession()->getRegistrationToken()->getMessengerUrl());
        $response = $this->request('GET', $url, [
            'authorization_session' => $this->getSession(),
        ]);
        $result = json_decode($response->getContent(), true);
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function loadMyProfile(): array
    {
        $url = 'https://api.skype.com/users/self/profile';
        $response = $this->request('GET', $url, [
            'authorization_session' => $this->getSession(),
        ]);
        $result = json_decode($response->getContent(), true);
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function loadMyInvites(): array
    {
        $url = 'https://edge.skype.com/pcs/contacts/v2/users/self/invites';
        $response = $this->request('GET', $url, [
            'authorization_session' => $this->getSession(),
        ]);
        $result = json_decode($response->getContent(), true);
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function subscribePresence(): void
    {
        $url = sprintf(
            '%s/users/ME/endpoints/%s/subscriptions/0',
            $this->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getSession()->getEndpoint()->getId()
        );

        $resources = [
            '/v1/threads/ALL',
            '/v1/users/ME/contacts/ALL',
            '/v1/users/ME/conversations/ALL/messages',
            '/v1/users/ME/conversations/ALL/properties'
        ];

        $contacts = $this->loadAllContacts();
        foreach ($contacts as $contact) {
            $resources[] = '/v1/users/ME/contacts/'. $contact->getPersonId();
        }

        try {
            $response = $this->request('PUT', $url, [
                'authorization_session' => $this->getSession(),
                'query' =>
                [
                    'name' => 'interestedResources',
                ],
                'json' =>[
                    'interestedResources' => $resources,
                ]
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response->getStatusCode();
        }
    }

    /**
     * *******************************************************
     * *******************************************************
     *             *** Conversations ***
     * *******************************************************
     * *******************************************************
     */


    /**
     * {@inheritdoc}
     */
    public function loadAllContacts(): array
    {
        $url = 'https://contacts.skype.com/contacts/v2/users/' . $this->getSession()->getAccount()->getConversation()->getName();
        $response = $this->request('GET', $url, [
            'query' => [
                'delta' => '',
                'reason' => 'default'
            ],
            'authorization_session' => $this->getSession(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($response->getContent(), true);

        $contacts = [];
        foreach ($result['contacts'] as $contact) {
            $contacts[] = new Contact($contact);
        }
        return $contacts;
    }

    /**
     * {@inheritdoc}
     */
    public function getContactDetails(string $contactId): Contact
    {
        $url = 'https://api.skype.com/users/batch/profiles';
        $response = $this->request('POST', $url, [
            'authorization_session' => $this->getSession(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode([
                'usernames' => [$contactId]
            ])
        ]);
        $result = json_decode($response->getContent(), true);
        $contact = new Contact($result[0]);
        return $contact;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentChats(): array
    {
        $url = sprintf(
            '%s/users/ME/conversations',
            $this->getSession()->getRegistrationToken()->getMessengerUrl()
        );

        $response = $this->request('GET', $url, [
            'query' => [
                'startTime' => 0,
                'pageSize' => 100,
                'view' => 'supportsExtendedHistory|msnp24Equivalent',
                'targetType' => 'Passport|Skype|Lync|Thread|Agent|ShortCircuit|PSTN|Flxt|NotificationStream|ModernBots|secureThreads|InviteFree',
            ],
            'authorization_session' => $this->getSession(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getContent(), true);
        file_put_contents('recent_chats.json', json_encode($result, JSON_PRETTY_PRINT));
        return $result;
    }

    public function groupChat(array $contacts, array $admins, bool $moderated=false): Chat
    {
        $url = sprintf(
            '%s/threads',
            $this->getSession()->getRegistrationToken()->getMessengerUrl()
        );

        //make members array with 8: prefix and if user is in admin add role property  = Admin else User
        $members = [];
        foreach ($contacts as $contact) {
            $members[] = [
                'id' => '8:'.$contact,
                'role' => in_array($contact, $admins) ? 'Admin' : 'User'
            ];
        }

        $properties = [
            'moderatedthread' => $moderated,
        ];

        $response = $this->request('POST', $url, [
            'authorization_session' => $this->getSession(),
            'json' => [
                'members' => $members,
                'properties' => $properties,
            ],
        ]);

        $data = ['id' => Utils::getChatIdFromUrl($response->getHeaders()['location'][0]),];

        return new Chat($this, $data);
    }

    /**
     * Start chat
     */
    public function chat(string $id): Chat
    {
        $data = ['id' => $id];
        return new Chat($this, $data);
    }


    /**
     * *******************************************************
     * *******************************************************
     *                  *** Endpoint ***
     * *******************************************************
     * *******************************************************
     */

    /**
     * {@inheritdoc}
     */
    public function configureEndpoint(): void
    {
        $this->allowPresence();
        $this->subscribeEndpoint();
    }

    /**
     * {@inheritdoc}
     */
    public function allowPresence(): void
    {
        $url = sprintf(
            '%s/users/ME/endpoints/%s/presenceDocs/messagingService',
            $this->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getSession()->getEndpoint()->getId()
        );

        $response = null;
        try {
            $response = $this->request('PUT', $url, [
                'authorization_session' => $this->getSession(),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'body' => json_encode([
                    'id' => 'messagingService',
                    'type' => 'EndpointPresenceDoc',
                    'selfLink' => 'uri',
                    'privateInfo' => [
                        'epname' => "phpSkype",
                    ],
                    'publicInfo' => [
                        'capabilities' => '',
                        'type' => 1,
                        'skypeNameVersion' => 'skype.com',
                        'nodeInfo' => 'xx',
                        'version' => '908/1.30.0.128',
                    ],
                ]),
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response->getStatusCode();
            DebugUtil::log("Failed to allow presence for endpoint", $response->getHeaders(), 200);
        }

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getContent(), true);
            $this->getSession()->getEndpoint()->setPresence(true);
            DebugUtil::log("Allowed presence on endpoint", $result, 200);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setUserPresence($status=self::STATUS_ONLINE): void
    {
        $url = sprintf(
            '%s/users/ME/presenceDocs/messagingService',
            $this->getSession()->getRegistrationToken()->getMessengerUrl()
        );

        try {
            $response = $this->request('PUT', $url, [
                'authorization_session' => $this->getSession(),
                'json' => [
                    'status' => $status,
                ],
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response->getStatusCode();
            DebugUtil::log("Error setting user presence", $response->getHeaders(), 400);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function subscribeEndpoint(): void
    {
        $url = sprintf(
            '%s/users/ME/endpoints/%s/subscriptions',
            $this->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getSession()->getEndpoint()->getId()
        );

        $resources = [
            '/v1/threads/ALL',
            '/v1/users/ME/contacts/ALL',
            '/v1/users/ME/conversations/ALL/messages',
            '/v1/users/ME/conversations/ALL/properties'
        ];

        $requestData = [
            'interestedResources' => $resources,
            'template' => 'raw',
            'channelType' => 'httpLongPoll',
            'conversationType' => 2047,
        ];

        $response = $this->request('POST', $url, [
            'authorization_session' => $this->getSession(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($requestData),
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            $this->getSession()->getEndpoint()->setSubscribed(true);
            $this->getSession()->getEndpoint()->setSubscribedUrl($response->getHeaders()['location'][0]);
            DebugUtil::log("Subscribed endpoint", $response->getHeaders(), 200);
        }
    }

    /**
    * {@inheritdoc}
    */
    public function pingEndpoint(int $timeout = 120): void
    {
        $url = sprintf(
            '%s/users/ME/endpoints/%s/active',
            $this->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getSession()->getEndpoint()->getId()
        );
        try {
            $response = $this->request('POST', $url, [
                'authorization_session' => $this->getSession(),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'timeout' => $timeout,
                ],
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response->getStatusCode();
        }

        if (in_array($response->getStatusCode(), [200, 201])) {
            DebugUtil::log("Ping OK", $response->getContent(), 200);
            $this->getSession()->setExpiry(new \DateTime('+'. $timeout .' seconds'));
        } else {
            DebugUtil::log("Ping to endpoint failed", $response->getHeaders(), 400);
        }
    }

    /**
     * *******************************************************
     * *******************************************************
     *                  *** Event Loop ***
     * *******************************************************
     * *******************************************************
     */

    /**
     * {@inheritdoc}
     */
    public function getEvents(Session $session): array
    {
        DebugUtil::log("LP start", [], 200);
        if ($session->getEndpoint()->getSubscribed() == false) {
            $this->subscribeEndpoint($session);
        }

        $url = sprintf(
            '%s/users/ME/endpoints/%s/subscriptions/0/poll',
            $session->getRegistrationToken()->getMessengerUrl(),
            $session->getEndpoint()->getId()
        );

        try {
            $response = $this->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'authorization_session' => $session,
                'timeout' => 120,
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response->getStatusCode();
            DebugUtil::log("LP failed", [], 400);
        }
        $responseData = [];
        $eventMessages = [];
        if (200 === $response->getStatusCode()) {
            $responseData = $response->toArray();
            if (isset($responseData['eventMessages'])) {
                $eventMessages = $responseData['eventMessages'];
            }
        }
        DebugUtil::log("LP finish", $responseData, 200);
        return $eventMessages;
    }
}
