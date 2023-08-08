<?php

namespace Akbv\PhpSkype;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Connection
{
    private const API_USER = 'https://api.skype.com';
    private const API_CONTACTS = 'https://contacts.skype.com/contacts/v2';
    /**
     * @var \Akbv\PhpSkype\Model\Session
     */
    private $session;
    /**
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface;
     */
    private $httpClient;

    /**
     * @var \Akbv\PhpSkype\Model\SkypeUser\SkypeUser
     */
    private $user;

    public function __construct($username, $password, $sessionDir = null)
    {
        $this->session = new \Akbv\PhpSkype\Model\Session($username, $password, $sessionDir);
        $this->httpClient = new \Akbv\PhpSkype\Service\HttpClient();

        if($this->session->getIsDirty()) {
            if(!$this->isValidSkypeToken()) {
                $this->session->destroySession();
            }
        } else {
            $this->login($username, $password);
        }

        $this->user = new \Akbv\PhpSkype\Model\SkypeUser\SkypeUser($this->getAuthenticatedUser());
        // $this->conversations = new \Akbv\PhpSkype\Conversation($this);
        // $this->contacts = $this->fetchContacts();
        // $this->chats = $this->fetchChats()['conversations'];
        // $messages = $this->getConversationMessages("19:f91a8342d12548ba832765fd5a041ad8@thread.skype", null, 30)['messages'];

    }

    private function login($username, $password)
    {
        $loginDetails = new \Akbv\PhpSkype\Service\SoapLogin($username, $password);
        $this->session->setSkypeToken($loginDetails->getSkypeToken());
        $this->session->setSkypeTokenExpires($loginDetails->getSkypeTokenExpires());
        $this->session->setRegistrationToken($loginDetails->getRegistrationToken());
        $this->session->setRegistrationTokenExpires($loginDetails->getRegistrationTokenExpires());
        $this->session->setEndpointId($loginDetails->getEndpointId());
        $this->session->setMessengerHost($loginDetails->getMessengerHost());
        $this->session->setIsDirty(true);
        $this->session->setCreatedAt(new \DateTime('+6 hours'));
        $this->session->saveSession();
    }

    private function isValidSkypeToken()
    {
        if (!empty($this->session->getSkypeToken())) {

            $body = [
                'registrationId' => '07baca20-cccf-45dd-aa45-fda5cc870035',
                'nodeId' => '',
                'clientDescription' => [
                    'appId' => 'com.microsoft.skype.s4l-df.web',
                    'platform' => 'web',
                    'languageId' => 'en-US',
                    'templateKey' => 'com.microsoft.skype.s4l-df.web:2.9',
                    'platformUIVersion' => '1418/8.98.0.208/'
                ],
                'transports' => [
                    'TROUTER' => [
                        [
                            'context' => '',
                            'creationTime' => '',
                            'path' => 'https://trouter-azsc-uswe-0-a.trouter.skype.com:3443/v4/f/nPlBszDljUOure16-KLeMw/',
                            'ttl' => 586304
                        ]
                    ]
                ]
            ];

            $response = '';

            try {
                $response = $this->httpClient->request('GET', 'https://prod.registrar.skype.com/v2/registrations', [
                    'session' => $this->session,
                    'headers' => [
                        "Content-Type" => "application/json",
                    ],
                    'body' => json_encode($body)
                ]);
            } catch(\Symfony\Component\HttpClient\Exception\ClientException $e) {
                $response = $e->getResponse();
                if ($response->getStatusCode() >= 400) {
                    return false;
                }
            }

            $response->getStatusCode();
            $response->getContent();

            if ($response->getStatusCode() >= 400) {
                return false;
            }
            return true;
        }

    }

    public function getAuthenticatedUser()
    {

        $response = $this->httpClient->request('GET', self::API_USER.'/users/self/profile', [
            'session' => $this->session,
            'headers' => [
                "Content-Type" => "application/json",
            ],
        ]);
        $result = json_decode($response->getContent());

        return new \Akbv\PhpSkype\Model\SkypeUser\SkypeUser($result);
    }

    public function fetchContacts()
    {
        $response = $this->httpClient->request('GET', self::API_CONTACTS.'/users/'.$this->user->getUsername().'/contacts', [
            'session' => $this->session,
            'headers' => [
                "Content-Type" => "application/json",
            ],
        ]);

        $result = [];
        foreach (json_decode($response->getContent())->contacts as $contact) {
            $result[] = new \Akbv\PhpSkype\Model\SkypeContact\SkypeContact($contact);
        }
        return $result;
    }

    public function fetchConversations($syncStateUrl=null, $pageSize=30): \Akbv\PhpSkype\Dto\SkypeChat\SkypeChatDto
    {
        if (empty($syncStateUrl)) {
            $url = sprintf(
                '%s/users/ME/conversations',
                $this->session->getMessengerHost()
            );
        } else {
            $url = $syncStateUrl;
        }

        $params = [
            'startTime' => 1,
            'pageSize' => $pageSize,
            'view' => 'supportsExtendedHistory|msnp24Equivalent',
            'targetType' => 'Passport|Skype|Lync|Thread|Agent|ShortCircuit|PSTN|Flxt|NotificationStream|'
                            . 'ModernBots|secureThreads|InviteFree',
        ];

        $response = $this->httpClient->request('GET', $url, [
            'query' =>  empty($syncStateUrl) ? $params : [],
            'session' => $this->session,
        ]);
        $json = json_decode($response->getContent());

        $conversations = $json->conversations;
        $metaData = $json->_metadata;

        $skypeChatDto = new \Akbv\PhpSkype\Dto\SkypeChat\SkypeChatDto();
        $skypeChatDto->setChats(array_map(function ($chat) {
            return new \Akbv\PhpSkype\Model\SkypeChat\SkypeChat($chat);
        }, $conversations));
        $skypeChatDto->setSyncState($metaData->syncState ?? null);
        return $skypeChatDto;
    }

    public function subscribeEndpoint(): void
    {
        $url = sprintf(
            '%s/users/ME/endpoints/%s/subscriptions',
            $this->session->getMessengerHost(),
            $this->session->getEndpointId()
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

        $response = $this->httpClient->request('POST', $url, [
            'session' => $this->session,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($requestData),
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            $this->session->setSubscribed(true);
            $this->session->saveSession();
        }
    }

    public function getEvents(): array
    {
        if ($this->session->getSubscribed() == false) {
            $this->subscribeEndpoint();
        }

        $url = sprintf(
            '%s/users/ME/endpoints/%s/subscriptions/0/poll',
            $this->session->getMessengerHost(),
            $this->session->getEndpointId()
        );

        try {
            $response = $this->httpClient->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'session' => $this->session,
                'timeout' => 120,
            ]);
        } catch (\Symfony\Component\HttpClient\Exception\ClientException $e) {
            $response = $e->getResponse();
            $response->getStatusCode();
            $this->session->destroySession(true);
            $this->login($this->session->getUsername(), $this->session->getPassword());
        }
        $responseData = [];
        $eventMessages = [];
        if (200 === $response->getStatusCode()) {
            $responseData = json_decode($response->getContent());

            if (!empty($responseData->eventMessages)) {
                $eventMessages = $responseData->eventMessages;
            }
        }

        $eventMessages = array_map(function ($eventMessage) {
            return new \Akbv\PhpSkype\Model\SkypeEvent\SkypeEvent($eventMessage);
        }, $eventMessages);

        return $eventMessages;
    }

    public function searchSkypeUsers(string $searchString)
    {

        $url = 'https://skypegraph.skype.com/v2.0/search';
        $response = $this->httpClient->request('GET', $url, [
            'session' => $this->getSession(),
            'headers' => [
                'X-Ecs-Etag' => md5(time()),
                'X-Skype-Client' => md5(time()),
                'X-Skypegraphservicesettings' => '{"experiment":"MinimumFriendsForAnnotationsEnabled","geoProximity":"disabled","promoteActiveUsersInLastDays":"28","promoteActiveUsers":"true","minimumFriendsForAnnotationsEnabled":"true","minimumFriendsForAnnotations":2,"demotionScoreEnabled":"true"}',
            ],
            'query' => [
                'searchString' => $searchString,
                'requestId' => md5(time()),
                'locale' => 'en-US',
                'sessionId' => md5(time()),
            ]
        ]);

        $result = json_decode($response->getContent(), true);
        $people = array_map(function ($person) {
            return $person['nodeProfileData'];
        }, $result['results'] ?? []);

        $contacts = array_map(function ($person) {

            $contactModel = new \Akbv\PhpSkype\Model\SkypeContact\SkypeContact([]);

            $contactModel->setMri(isset($person['skypeId']) ? $person['skypeId'] : $person['skypeHandle']);
            $contactModel->setPersonId(isset($person['skypeHandle']) ? $person['skypeHandle'] : $person['skypeId']);
            $contactModel->setDisplayName(isset($person['name']) ? $person['name'] : $person['skypeHandle']);
            //split name if is set and set first and last name
            if(isset($person['name'])) {
                $name = explode(' ', $person['name']);
                $contactModel->getProfile()->setName(new \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName((object)[
                    'first' => isset($name[0]) ? $name[0] : null,
                    'surname' => isset($name[1]) ? $name[1] : null
                ]));
            }
            $contactModel->getProfile()->setAvatarUrl(isset($person['avatarUrl']) ? $person['avatarUrl'] : null);
            return $contactModel;
        }, $people);

        return $contacts;
    }

    public function chat($id)
    {
        return new \Akbv\PhpSkype\Chat($this, $id);
    }

    /**
         * {@inheritdoc}
         */
    public function groupChat(array $contacts, array $admins, bool $moderated=false): Chat
    {
        $url = sprintf(
            '%s/threads',
            $this->getSession()->getMessengerHost()
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

        $response = $this->httpClient->request('POST', $url, [
            'session' => $this->getSession(),
            'json' => [
                'members' => $members,
                'properties' => $properties,
            ],
        ]);

        $id = \Akbv\PhpSkype\Util\Util::getChatIdFromUrl($response->getHeaders()['location'][0]);

        return new \Akbv\PhpSkype\Chat($this, $id);
    }

    /**
     * Get the value of session
     *
     * @return  Akbv\PhpSkype\Model\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Get the value of httpClient
     *
     * @return  \Symfony\Contracts\HttpClient\HttpClientInterface;
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Get the value of user
     *
     * @return  \Akbv\PhpSkype\Model\SkypeUser\SkypeUser
     */
    public function getUser()
    {
        return $this->user;
    }
}
