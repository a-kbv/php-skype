<?php

namespace Akbv\PhpSkype;

use Akbv\PhpSkype\Interfaces\ChatInterface;
use Akbv\PhpSkype\Models\Message;
use Akbv\PhpSkype\Models\SingleChat;
use Akbv\PhpSkype\Models\GroupChat;
use Akbv\PhpSkype\Client;
use Akbv\PhpSkype\Utils\Utils;
use Symfony\Component\HttpClient\Exception\ClientException;

/**
 * A conversation within Skype.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Chat implements ChatInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Object
     */
    private $chat;
    /**
     * Unique identifier of the conversation.
     * One-to-one chats have identifiers of the form {type}:{username}.
     * Cloud group chat identifiers are of the form {type}:{identifier}@thread.skype.
     * @var string
     */
    private $id;

    /**
     * Constructor.
     * @param Client $client
     * @param mixed[] $raw
     */
    public function __construct(Client $client, array $raw)
    {
        $id = $raw["id"];
        $this->id = $id;
        $this->client = $client;

        if (substr($id, 0, 3) == "19:") {
            $response = null;
            try {
                $url = sprintf(
                    "%s/threads/%s",
                    $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
                    $raw["id"]
                );

                $response = $this->getClient()->request('GET', $url, [
                    'authorization_session' => $this->getClient()->getSession(),
                    'query' => [
                        'view' => 'msnp24Equivalent'
                    ]
                ]);
            } catch (ClientException $e) {
                $response = $e->getResponse();
                if (in_array($response->getStatusCode(), [403,404])) {
                } else {
                    throw $e;
                }
            }

            $data = json_decode($response->getContent(), true);
            $raw = array_merge($raw, $data);

            $this->chat = new GroupChat($raw);
        } else {
            $url = sprintf(
                '%s/users/ME/conversations/%s',
                $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
                $raw["id"]
            );

            $response = $this->getClient()->request('GET', $url, [
                'authorization_session' => $this->getClient()->getSession(),
                'query' => [
                    'view' => 'msnp24Equivalent'
                ]
            ]);

            $data = json_decode($response->getContent(), true);

            $this->chat = new SingleChat($data);
        }
    }


    /**
     * Get cloud group chat identifiers are of the form {type}:{identifier}@thread.skype.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cloud group chat identifiers are of the form {type}:{identifier}@thread.skype.
     *
     * @param  string  $id  Cloud group chat identifiers are of the form {type}:{identifier}@thread.skype.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Client
     *
     * @return  Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get the value of chat
     *
     * @return  Object
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
    * {@inheritdoc}
    */
    public function getMessages(): array
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/messages',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->chat->getId()
        );

        $response = $this->getClient()->request('GET', $url, [
            'query' => [
                'startTime' => 0,
                'pageSize' => 100,
                'view' => 'supportsExtendedHistory|msnp24Equivalent|supportsMessageProperties',
            ],
            'authorization_session' => $this->getClient()->getSession(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'BehaviorOverride' => 'redirectAs404',
                'Sec-Fetch-Dest' => 'empty',
                'Sec-Fetch-Mode' => 'cors',
                'Sec-Fetch-Site' => 'cross-site',
            ],
        ]);

        $messages = [];
        $msgs = json_decode($response->getContent(), true)['messages'];
        if (!empty($msgs)) {
            foreach ($msgs as $msg) {
                $messages[] = new Message($msg);
            }
        }
        // file_put_contents('messages.json', $response->getContent());
        return $messages;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage($content, $edit = null, $me = false, $rich = false): Message
    {
        $msgType = 'Text';
        $properties = ['Has-Mentions' => 'false'];

        if ($edit instanceof Message) {
            $edit = $edit->getId();
        }

        if ($me) {
            $content = $this->getClient()->getSession()->getAccount()->getConversation()->getName() . ' ' . $content;
            $properties['skypeemoteoffset'] = strlen($this->getClient()->getSession()->getAccount()->getConversation()->getName()) + 1;
        } elseif ($rich) {
            $msgType = 'RichText';
            if (preg_match('/<at id=".+?">.+<\/at>/', $content)) {
                $properties['Has-Mentions'] = 'true';
            }
        }

        return $this->processMessage($edit, $content, $msgType, 'text', $properties);
    }

    /**
     * {@inheritdoc}
     */
    public function processMessage($editId = null, $content, $messageType, $contentType, array $customProperties = []): Message
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
                    $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
                    $this->id,
                    $editId
                );

                $response = $this->getClient()->request('PUT', $url, [
                    'authorization_session' => $this->getClient()->getSession(),
                    'json' => $message,
                ]);

                $data = json_decode($response->getContent(), true);
                $arriveTime = $data['edittime'];
            } else {
                //DELETE
                $arriveTime = null;
                $url = sprintf(
                    '%s/users/ME/conversations/%s/messages/%s',
                    $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
                    $this->id,
                    $editId
                );

                $response = $this->getClient()->request('DELETE', $url, [
                    'authorization_session' => $this->getClient()->getSession(),
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
                $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
                $this->id
            );

            $response = $this->getClient()->request('POST', $url, [
                'authorization_session' => $this->getClient()->getSession(),
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
        $message['conversationLink'] = sprintf('%s/users/ME/conversations/%s', $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(), $this->id);
        $message['from'] = sprintf('%s/users/ME/contacts/8:%s', $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(), $this->getClient()->getSession()->getAccount()->getConversation()->getName());
        $message['imdisplayname'] = $this->getClient()->getSession()->getAccount()->getConversation()->getLabel();
        $message['isactive'] = true;

        if ($clientTime) {
            $clientDate = \DateTime::createFromFormat('U', (string)(intval($clientTime / 1000)));
            $message['composetime'] = $clientDate->format('Y-m-d\TH:i:s.u\Z');
        }

        if ($arriveTime) {
            $arriveDate = \DateTime::createFromFormat('U', (string)(intval($arriveTime / 1000)));
            $message['originalarrivaltime'] = $arriveDate->format('Y-m-d\TH:i:s.u\Z');
        }

        $sentMessage = new Message($message);

        return $sentMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function setTyping($typing = true): void
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/properties',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->id
        );
        $messageType = $typing ? 'Control/Typing' : 'Control/ClearTyping';

        $this->processMessage(null, null, $messageType, "text");
    }

    /**
     * {@inheritdoc}
     */
    public function sendFile(string $filePath, string $fileName, bool $isImage = false): Message
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

        $response = $this->getClient()->request('POST', 'https://api.asm.skype.com/v1/objects', [
            'authorization_session' => $this->getClient()->getSession(),
            'headers' => [
                'X-Client-Version' => '0/0.0.0.0'
            ],
            'json' => $meta
        ]);

        $data = json_decode($response->getContent(), true);
        $objId = $data['id'];
        $objType = $isImage ? 'imgpsh' : 'original';
        $urlFull = "https://api.asm.skype.com/v1/objects/{$objId}";

        $response = $this->getClient()->request('PUT', "{$urlFull}/content/{$objType}", [
            'authorization_session' => $this->getClient()->getSession(),
            'body' => $content,
            'headers' => [
                'Content-Length' => $length,
            ]
        ]);

        if ($isImage) {
            $viewLink = Utils::formatUrl("https://api.asm.skype.com/s/i?{$objId}");
            $body = Utils::uriObject(
                "{$viewLink}<meta type=\"photo\" originalName=\"{$fileName}\"/>",
                "Picture.1",
                $urlFull,
                "{$urlFull}/views/imgt1"
            );
        } else {
            $viewLink = Utils::formatUrl("https://login.skype.com/login/sso?go=webclient.xmm&docid={$objId}");
            $body = Utils::uriObject(
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
        return $this->processMessage(null, $body, $msgType, null);
    }

    /**
     * {@inheritdoc}
     */
    public function sendContacts(array $contacts): Message
    {
        $contactTags = array_map(function ($contact) {
            return '<c t="s" s="' . (string)$contact->getId() . '" f="' . (string)$contact->getName() . '"/>';
        }, $contacts);
        $content = '<contacts>' . implode('', $contactTags) . '</contacts>';
        return $this->processMessage(null, $content, 'RichText/Contacts', null);
    }

    /**
     * {@inheritdoc}
     */
    public function setConsumption(string $horizon): void
    {
        $url = sprintf(
            '%s/users/ME/conversations/%s/properties',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->id
        );

        $this->getClient()->request('POST', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'query' => [
                'name' => 'consumptionhorizon',
            ],
            'json' => [
                'consumptionhorizon' => $horizon,
            ],
        ]);
    }

    /**
     * *******************************************************
     * *******************************************************
     *              *** Group Chat Related ***
     * *******************************************************
     * *******************************************************
     */
    /**
     * {@inheritdoc}
     */
    public function createGroupChat(array $contacts, array $admins, bool $moderated=false): Chat
    {
        $url = sprintf(
            '%s/threads',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl()
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

        $response = $this->getClient()->request('POST', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'json' => [
                'members' => $members,
                'properties' => $properties,
            ],
        ]);

        $data = ['id' => Utils::getChatIdFromUrl($response->getHeaders()['location'][0]),];

        return new self($this->client, $data);
    }


    public function setTopic(string $topic): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getChat()->getId()
        );

        $this->getClient()->request('PUT', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'query' => [
                'name' => 'topic',
            ],
            'json' => [
                'topic' => $topic,
            ],
        ]);

        return new self($this->client, ['id' => $this->getChat()->getId()]);
    }

    public function setModerated(bool $moderated = true): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getChat()->getId()
        );

        $this->getClient()->request('PUT', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'query' => [
                'name' => 'moderatedthread',
            ],
            'json' => [
                'moderatedthread' => $moderated,
            ],
        ]);

        return new self($this->client, ['id' => $this->getChat()->getId()]);
    }

    public function setOpen(bool $open): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getChat()->getId()
        );

        $this->getClient()->request('PUT', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'query' => [
                'name' => 'joiningenabled',
            ],
            'json' => [
                'joiningenabled' => $open,
            ],
        ]);

        return new self($this->client, ['id' => $this->getChat()->getId()]);
    }

    public function setHistory(bool $history): self
    {
        $url = sprintf(
            '%s/threads/%s/properties',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getChat()->getId()
        );

        $this->getClient()->request('PUT', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'query' => [
                'name' => 'historydisclosed',
            ],
            'json' => [
                'historydisclosed' => $history,
            ],
        ]);

        return new self($this->client, ['id' => $this->getChat()->getId()]);
    }

    public function addMember(string $id, bool $admin = false): self
    {
        $url = sprintf(
            '%s/threads/%s/members/8:%s',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getChat()->getId(),
            $id
        );
        $role = $admin ? 'Admin' : 'User';

        $this->getClient()->request('PUT', $url, [
            'authorization_session' => $this->getClient()->getSession(),
            'json' => [
                'role' => $role,
            ],
        ]);

        return new self($this->client, ['id' => $this->getChat()->getId()]);
    }

    public function removeMember(string $id): self
    {
        $url = sprintf(
            '%s/threads/%s/members/8:%s',
            $this->getClient()->getSession()->getRegistrationToken()->getMessengerUrl(),
            $this->getChat()->getId(),
            $id
        );

        $this->getClient()->request('DELETE', $url, [
            'authorization_session' => $this->getClient()->getSession(),
        ]);
        return new self($this->client, ['id' => $this->getChat()->getId()]);
    }

    public function leave(): void
    {
        $this->removeMember($this->getClient()->getSession()->getAccount()->getConversation()->getName());
    }
}
