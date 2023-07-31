<?php 

namespace Akbv\PhpSkype;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Chat
{
    /**
     * @var \Akbv\PhpSkype\Connection
     */
    private $connection;

    /**
     * @param \Akbv\PhpSkype\Models\SkypeChat\SkypeChat
     */
    private $chat;


    public function __construct(\Akbv\PhpSkype\Connection $connection, string $id)
    {
        $this->connection = $connection;

        $url = sprintf(
            '%s/users/ME/conversations/%s',
            $this->connection->getSession()->getMessengerHost(),
            $id
        );

        $response = $this->connection->getHttpClient()->request('GET', $url, [
            'session' => $this->connection->getSession(),
            'query' => [
                'view' => 'msnp24Equivalent',
            ],
        ]);

        $json = json_decode($response->getContent());

        $this->chat =  new \Akbv\PhpSkype\Model\SkypeChat\SkypeChat($json);
    }

    public function getMessages($syncStateUrl=null, $pageSize=30): \Akbv\PhpSkype\Dto\SkypeMessage\SkypeMessageDto
    {
        if (empty($this->chat->getId())) {
            return [];
        }

        if (empty($syncStateUrl)) {
            $url = sprintf(
                '%s/users/ME/conversations/%s/messages',
                $this->connection->getSession()->getMessengerHost(),
                $this->chat->getId()
            );
        } else {
            $url = $syncStateUrl;
        }

        $params = [
            'startTime' => 0,
            'view' => 'supportsExtendedHistory|msnp24Equivalent|supportsMessageProperties',
            'pageSize' => $pageSize,
        ];

        $headers = [
            'BehaviorOverride' => 'redirectAs404',
            'Sec-Fetch-Dest' => 'empty',
            'Sec-Fetch-Mode' => 'cors',
            'Sec-Fetch-Site' => 'cross-site',
        ];

        $response = $this->connection->getHttpClient()->request('GET', $url, [
            'query' => empty($syncStateUrl) ? $params : [],
            'headers' => $headers,
            'session' => $this->connection->getSession(),
        ]);

        $response = $response->getContent();
        $json = json_decode($response) ?? [];

        $messages = $json->messages;
        $metaData = $json->_metadata;

        $skypeMessageDto = new \Akbv\PhpSkype\Dto\SkypeMessage\SkypeMessageDto();
        $skypeMessageDto->setMessages(array_map(function ($message) {
            return new \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage($message);
        }, $messages));
        $skypeMessageDto->setSyncState($metaData->syncState ?? null);

        return $skypeMessageDto;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage($content, $edit = null, $me = false, $rich = false): \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
    {
        $msgType = 'Text';
        $properties = ['Has-Mentions' => 'false'];

        if ($edit instanceof \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage) {
            $edit = $edit->getId();
        }

        if ($me) {
            $content = $this->connection->getUser()->getUsername() . ' ' . $content;
            $properties['skypeemoteoffset'] = strlen($this->connection->getUser()->getUsername()) + 1;
        } elseif ($rich) {
            $msgType = 'RichText';
            if (preg_match('/<at id=".+?">.+<\/at>/', $content)) {
                $properties['Has-Mentions'] = 'true';
            }
        }

        return $this->processMessage($content, $msgType, 'text', $edit, $properties);
    }

    /**
     * {@inheritdoc}
     */
    public function processMessage($content, $messageType, $contentType, $editId = null, array $customProperties = []): \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
    {
        // Build the message object with default properties and custom ones
        $message = [
            'contenttype' => $contentType,
            'messagetype' => $messageType,
            'content' => $content,
        ];
        $message = array_merge($message, $customProperties);

        $clientTime = null;

        if ($editId !== null) {
            $messageId = $editId;
            if (!empty($message['content'])) {
                //EDIT
                $arriveTime = null;
                $url = sprintf(
                    '%s/users/ME/conversations/%s/messages/%s',
                    $this->connection->getSession()->getMessengerHost(),
                    $this->chat->getId(),
                    $editId
                );

                $response = $this->connection->getHttpClient()->request('PUT', $url, [
                    'session' => $this->connection->getSession(),
                    'json' => $message,
                ]);

                $data = json_decode($response->getContent(), true);
                $arriveTime = $data['edittime'];
            } else {
                //DELETE
                $arriveTime = null;
                $url = sprintf(
                    '%s/users/ME/conversations/%s/messages/%s',
                    $this->connection->getSession()->getMessengerHost(),
                    $this->chat->getId(),
                    $editId
                );

                $response = $this->connection->getHttpClient()->request('DELETE', $url, [
                    'session' => $this->connection->getSession()
                ]);

                $data = json_decode($response->getContent(), true);
                $arriveTime = $data['deletetime'];
            }
        } else {
            $clientTime = intval(microtime(true) * 1000);
            $message['clientmessageid'] = strval($clientTime);
            $messageId = null;
            $arriveTime = null;

            $client = "os=Windows; osVer=10; proc=x86; lcid=en-US; deviceType=1; country=US; clientName=skype4life; clientVer=1418/9.99.0.999//skype4life";

            $url = sprintf(
                '%s/users/ME/conversations/%s/messages',
                $this->connection->getSession()->getMessengerHost(),
                $this->chat->getId()
            );

            $response = $this->connection->getHttpClient()->request('POST', $url, [
                'session' => $this->connection->getSession(),
                'headers' => [
                    'ClientInfo' => $client,
                ],
                'json' => $message,
            ]);

            $response->getHeaders();

            $location = $response->getHeaders()['location'][0];
            $messageId = $location ? substr(strrchr($location, "/"), 1) : null;
            $arriveTime = json_decode($response->getContent(), true)['OriginalArrivalTime'];
        }

        $message['id'] = $messageId;
        $message['conversationLink'] = sprintf('%s/users/ME/conversations/%s', $this->connection->getSession()->getMessengerHost(), $this->chat->getId());
        $message['from'] = sprintf('%s/users/ME/contacts/8:%s', $this->connection->getSession()->getMessengerHost(), $this->connection->getUser()->getUsername());
        $message['imdisplayname'] = $this->connection->getUser()->getUsername();
        $message['isactive'] = true;
        $message['properties'] = $customProperties;
        $message['type'] = $contentType;
        $message['conversationId'] = $this->chat->getId();



        if ($clientTime) {
            $clientDate = \DateTime::createFromFormat('U', (string)(intval($clientTime / 1000)));
            $message['composetime'] = $clientDate->format('Y-m-d\TH:i:s.u\Z');
        }

        if ($arriveTime) {
            $arriveDate = \DateTime::createFromFormat('U', (string)(intval($arriveTime / 1000)));
            $message['originalarrivaltime'] = $arriveDate->format('Y-m-d\TH:i:s.u\Z');
        }

        $sentMessage = new \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage((object) $message);

        return $sentMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function setTyping($typing = true): void
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/properties',
            $this->connection->getSession()->getMessengerHost(),
            $this->chat->getId()
        );
        $messageType = $typing ? 'Control/Typing' : 'Control/ClearTyping';

        $this->processMessage(null, $messageType, "text", null);
    }

    /**
     * {@inheritdoc}
     */
    public function sendFile(string $filePath, string $fileName, bool $isImage = false): \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
    {
        $content = fopen($filePath, 'rb');
        if (!$content) {
            throw new \Exception('Unable to open file');
        }
        $stat = fstat($content);
        $length = $stat['size'];


        $meta = [
            'type' => $isImage ? 'pish/image' : 'sharing/file',
            'permissions' => []
        ];
        //add permission (here we allow everyone to read the file)
        //will see how to modify for group chat
        $meta['permissions'][$this->chat->getId()] = ['read'];

        if (!$isImage) {
            $meta['filename'] = $fileName;
        }

        $response = $this->connection->getHttpClient()->request('POST', 'https://api.asm.skype.com/v1/objects', [
            'session' => $this->connection->getSession(),
            'headers' => [
                'X-Client-Version' => '0/0.0.0.0'
            ],
            'json' => $meta
        ]);

        $data = json_decode($response->getContent(), true);
        $objId = $data['id'];
        $objType = $isImage ? 'imgpsh' : 'original';
        $urlFull = "https://api.asm.skype.com/v1/objects/{$objId}";

        $response = $this->connection->getHttpClient()->request('PUT', "{$urlFull}/content/{$objType}", [
            'session' => $this->connection->getSession(),
            'body' => $content,
            'headers' => [
                'Content-Length' => $length,
            ]
        ]);

        if ($isImage) {
            $viewLink = \Akbv\PhpSkype\Util\Util::formatUrl("https://api.asm.skype.com/s/i?{$objId}");
            $body = \Akbv\PhpSkype\Util\Util::uriObject(
                "{$viewLink}<meta type=\"photo\" originalName=\"{$fileName}\"/>",
                "Picture.1",
                $urlFull,
                "{$urlFull}/views/imgt1"
            );
        } else {
            $viewLink = \Akbv\PhpSkype\Util\Util::formatUrl("https://login.skype.com/login/sso?go=webclient.xmm&docid={$objId}");
            $body = \Akbv\PhpSkype\Util\Util::uriObject(
                $viewLink,
                "File.1",
                $urlFull,
                "{$urlFull}/views/thumbnail",
                $fileName,
                $fileName,
                [
                    "OriginalName" => $fileName,
                    "FileSize" => $length
                ]
            );
        }
        $msgType = "RichText/".($isImage ? "UriObject" : "Media_GenericFile");
        return $this->processMessage($body, $msgType, null, null);
    }

     /**
     * {@inheritdoc}
     */
    public function sendContacts(array $contacts): \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
    {
        $contactTags = array_map(function ($contact) {
            /** @var \Akbv\PhpSkype\Model\SkypeUser\SkypeUser $contact */
            return '<c t="s" s="' . (string)$contact->getUsername() . '" f="' . (string)$contact->getFirstName(). " " .(string)$contact->getLastName() . '"/>';
        }, $contacts);
        $content = '<contacts>' . implode('', $contactTags) . '</contacts>';
        return $this->processMessage($content, 'RichText/Contacts', null, null);
    }

    /**
     * {@inheritdoc}
     */
    public function setConsumption(string $horizon): void
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/properties',
            $this->connection->getSession()->getMessengerHost(),
            $this->chat->getId()
        );

        $this->connection->getHttpClient()->request('POST', $url, [
            'session' => $this->connection->getSession(),
            'query' => [
                'name' => 'consumptionhorizon',
            ],
            'json' => [
                'consumptionhorizon' => $horizon,
            ],
        ]);
    }

    public function setTopic(string $topic): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->$this->connection->getSession()->getMessengerHost(),
            $this->chat->getId()
        );

        $this->connection->getHttpClient()->request('PUT', $url, [
            'session' => $this->connection->getSession(),
            'query' => [
                'name' => 'topic',
            ],
            'json' => [
                'topic' => $topic,
            ],
        ]);

        return new self($this->connection, $this->chat->getId());
    }

    public function setModerated(bool $moderated = true): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->$this->connection->getSession()->getMessengerHost(),
            $this->chat->getId()
        );

        $this->connection->getHttpClient()->request('PUT', $url, [
            'session' => $this->connection->getSession(),
            'query' => [
                'name' => 'moderatedthread',
            ],
            'json' => [
                'moderatedthread' => $moderated,
            ],
        ]);

        return new self($this->connection, $this->chat->getId());
    }

    public function setOpen(bool $open): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->$this->connection->getSession()->getMessengerHost(),
            $this->chat->getId()
        );

        $this->connection->getHttpClient()->request('PUT', $url, [
            'session' => $this->connection->getSession(),
            'query' => [
                'name' => 'joiningenabled',
            ],
            'json' => [
                'joiningenabled' => $open,
            ],
        ]);

        return new self($this->connection, $this->chat->getId());
    }

    public function setHistory(bool $history): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->$this->connection->getSession()->getMessengerHost(),
            $this->chat->getId()
        );

        $this->connection->getHttpClient()->request('PUT', $url, [
            'session' => $this->connection->getSession(),
            'query' => [
                'name' => 'historydisclosed',
            ],
            'json' => [
                'historydisclosed' => $history,
            ],
        ]);

        return new self($this->connection, $this->chat->getId());
    }

    public function addMember(string $id, bool $admin = false): self
    {
        $url = sprintf(
            '%s/threads/%s/members/8:%s',
            $this->$this->connection->getSession()->getMessengerHost(),
            $this->chat->getId(),
            $id
        );
        $role = $admin ? 'Admin' : 'User';

        $this->connection->getHttpClient()->request('PUT', $url, [
            'session' => $this->connection->getSession(),
            'json' => [
                'role' => $role,
            ],
        ]);

        return new self($this->connection, $this->chat->getId());
    }

    public function removeMember(string $id): self
    {
        $url = sprintf(
            '%s/threads/%s/members/8:%s',
            $this->$this->connection->getSession()->getMessengerHost(),
            $this->chat->getId(),
            $id
        );

        $this->connection->getHttpClient()->request('DELETE', $url, [
            'session' => $this->connection->getSession(),
        ]);
        return new self($this->connection, $this->chat->getId());
    }

    public function leave(): void
    {
        $this->removeMember($this->connection->getUser()->getUsername());
    }

    /**
    * Adds a message to bookmarks in a conversation.
    *
    * @param string $conversationId ID of the conversation.
    * @param int $messageId ID of the message.
    * @param string $cuid Unique identifier for the bookmark.
    * @return bool True if the message was successfully added to bookmarks, false otherwise.
    */
    public function addToBookmarks($messageId, $cuid): bool
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/messages/%s/properties',
            $this->connection->getSession()->getMessengerUrl(),
            urlencode($this->chat->getId()),
            $messageId
        );

        $data = [
            'poll' => [
                'key' => 'bookmark',
                'value' => json_encode(['cuid' => $cuid]),
            ],
        ];

        $response = $this->connection->getHttpClient()->request('PUT', $url, [
            'query' => ['name' => 'poll'],
            'json' => $data,
            'session' => $this->connection->getSession(),
        ]);

        return $response->getStatusCode() === 200;
    }

    /**
     * Adds a message to bookmarks in the user's own conversation.
     *
     * @param int $messageId ID of the message.
     * @param string $cuid Unique identifier for the bookmark.
     * @return bool True if the message was successfully added to bookmarks, false otherwise.
     */
    public function addToOwnConversationBookmarks($messageId, $cuid): bool
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/messages/%s/properties',
            $this->connection->getSession()->getMessengerUrl(),
            urlencode($this->chat->getId()),
            $messageId
        );

        $data = [
            'poll' => [
                'key' => 'bookmark',
                'value' => json_encode(['cuid' => $cuid, 'id' => $messageId]),
            ],
        ];

        $response = $this->connection->getHttpClient()->request('PUT', $url, [
            'query' => ['name' => 'poll'],
            'json' => $data,
            'session' => $this->connection->getSession(),
        ]);

        return $response->getStatusCode() === 200;
    }



    
}