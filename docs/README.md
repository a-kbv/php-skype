# php-skype

php-skype is a library that wraps Skype Web API. The library is designed to be user-friendly and comes with comprehensive documentation and examples to help integrate Skype functionality into projects quickly and easily.

Note: `library is under development, please use it with caution`

## Installation

Use the package manager composer to install php-skype.

```bash
$ composer require akbv/php-skype
```

## Example

```PHP
<?php

/** Create session manager */
$sessionManager = new \Akbv\PhpSkype\Services\SessionManager(
    __DIR__ . '/sessions',
    "hardToGuessSecretKeyUpTo32Characters"
);

/** Create account Object */
$account = new Akbv\PhpSkype\Models\Account(
    'email@example.com',
    'password'
);

/** Login */
$client = new Akbv\PhpSkype\SkypeClient($sessionManager);
$client->login($account);

/** Get contacts list */
$client->getMyContacts();

/** Start chat with contact */
$chat = $client->chat('8:live:example');

/** Get messages from chat */
$messages = $chat->getMessages();

/** Send message to chat */
$message = $chat->sendMessage('Hello world!');

```

## Usage
Examples usage of the the library.

### Account

*	This class is responsible for storing and handling the user's credentials. 

```PHP
$account = new Akbv\PhpSkype\Models\Account(
    'email@example.com',
    'password'
);
```

### SessionManager

*	This class is responsible for managing sessions.
	A session is a file that contains the cookies and tokens required to authenticate with the Skype API.
	The session file is created when the user logs in and is deleted when the user logs out or tokens expire.
 	The session file is encrypted using the secret key provided in the constructor.
	The session file is stored in the directory provided in the constructor.

```PHP
$sessionManager = new \Akbv\PhpSkype\Services\SessionManager(
    __DIR__ . '/sessions',
    "hardToGuessSecretKeyUpTo32Characters"
);
```

### Client

*	This class is responsible for managing the Skype API.
	It is used to log in and out, and to get contacts, chats, and messages.

```PHP
$client = new Akbv\PhpSkype\SkypeClient(\Akbv\PhpSkype\Services\SessionManager $sessionManager);
```

#### Login

*	Login to Skype API.

```PHP
$client->login(Akbv\PhpSkype\Models\Account $account);
```

#### Get Contacts

*	Get contacts list. This method returns an array of user's contacts.

```PHP
$client->getMyContacts();
```

#### Get Conversations

*	Get conversations list. This method returns a selection of conversations with the most recent activity. 
Calling it multiple times will return conversations, sorted by most recently modified first. 
Returns syncStateUrl for pagination. If no syncStateUrl is provided, the first page is returned.

```PHP
$recentChats = $client->getRecentChats($syncStateUrl);
$syncStateUrl = isset($recentChats['_metadata']['syncState']) ? $recentChats['_metadata']['syncState'] : null;
```

#### Get User Properties

*	Get current user properties. This method returns an array of user's properties.

```PHP
$client->getMyProperties();
```

#### Get User Profile

* Get current user profile. This method returns an array of user's profile.

```PHP
$client->getMyProfile();
```

#### Get User Invites

*	Get current user invites. This method returns an array of user's invites.

```PHP
$client->getMyInvites();
```

#### Enable Presence

*	Subscribe to contact and conversation events. This method returns an array of user's invites.

```PHP
$client->subscribePresence();
```

#### Get Events

*	Retrieve array of events since last call to this method.

```PHP
$client->getEvents();
```


### Chat

*	Start chat with contact. This method returns a chat object.

```PHP
$chat = $client->chat('8:live:example');
```

#### Get Messages

*	Get messages from chat. This method returns an array of messages with.
Calling it multiple times will return messages, sorted by most recently modified first.
Returns syncStateUrl and backwardLink for pagination. If no syncStateUrl or backwardLink is provided, the first page is returned.

```PHP

$messageResponse = $chat->getMessages($syncStateUrl);
$messages = $messageResponse['messages'];
$backwardLink = isset($messageResponse['_metadata']['backwardLink']) ? $messageResponse['_metadata']['backwardLink'] : null;
```

#### Send message
*	Send message to chat. This method returns a message object.

```PHP
$message = $chat->sendMessage('test');
```

#### Edit message
*	Edit message in chat. This method returns a message object.
	Accepts message object as second parameter to edit.

```PHP
$message = $chat->sendMessage('test edited', $message);
```

#### Delete message
*	Delete message in chat. This method returns a message object.
	Accepts message object as second parameter to delete.

```PHP
$message = $chat->sendMessage(null, $message);
```

#### Send file
*	Send file to chat. This method returns a message object.
	Accepts file path as second parameter to send.
	Content should be an ASCII or binary file-like object.

```PHP
$message = $chat->sendFile('toDoList.txt', 'toDoList.txt');
```

#### Send image

*	Send image to chat. This method returns a message object.
	Accepts image path as second parameter to send.

```PHP
$message = $chat->sendFile('avatar.png', 'avatar.png', true);
```

#### Send contact
*	Share one or more contacts with the conversation.

```PHP
$message = $chat->sendContact('live:.cid.3e1fbf88961d076d');
```

#### Typing indicator

*	Send a typing presence notification to the conversation. This will typically show the "{name} is typing..." message in others clients.
	It may be necessary to send this type of message continuously, as each typing presence usually expires after a few seconds.

```PHP
$message = $chat->setTyping();
```

#### Consumption

*	Update the user's consumption horizon for this conversation, i.e. where it has been read up to.

```PHP
$chat->setConsumption("horizonId");
```

### Group Chat

*	Start group chat with contacts. This method returns a chat object.

```PHP
$chat = $client->groupChat(
    [
        "live:johndoe",
        "live:.cid.72d1f34f06b2c28a",
        "live:samarabales"
    ],
    [
        $client->getSession()->getAccount()->getConversation()->getName(),
    ]
);

```
`All methods of the Chat class are available for group chat. And the following methods are available only for group chat.`

#### Set topic
*	Set topic for group chat.

```PHP
$chat->setTopic('New Group Chat');
```

#### Add member
*	Add member to group chat.

```PHP
$chat = $chat->addMember('live:.cid.3e1fbf88961d076d');
```

#### Remove member
*	Remove member from group chat.

```PHP
$chat = $chat->removeMember('live:.cid.3e1fbf88961d076d');
```

#### Moderated chat
*	Set group chat as moderated.

```PHP
$chat = $chat->setModerated(true);
```

#### Open
*	Set group chat as open for joining.

```PHP
$chat = $chat->setOpen(true);
```

#### History
*	Set group chat history disclosed.

```PHP
$chat = $chat->setHistory(true);
```


#### Leave chat
*	Leave group chat.

```PHP
$chat = $chat->leave();
```


## Supported features

- [x] Login
- [x] Get contacts list
- [x] Get contact details
- [x] Get recent chats
- [x] Create a group chat
- [x] Get user properties
- [x] Get a user profile
- [x] Get user invites
- [x] Configure endpoint
- [x] Subscribe to contact and conversation events
- [x] Subscribe to presence_changes
- [x] Get events
- [x] Allow presence
- [x] Ping endpoint (keep-alive)
- [x] Set user presence
- [x] Send text messages
- [x] Edit text messages
- [x] Delete text messages
- [x] Send file attachments
- [x] Send images
- [x] Send contacts
- [x] Set consumption horizon
- [x] Set typing indicator
- [x] Get chat messages history
- [x] Set group chat topic
- [x] Set group chat as moderated/unmoderated
- [x] Set group chat as open/closed for joining
- [x] Set group chat history disclosed/undisclosed
- [x] Add and remove group chat members
- [x] Make a group chat member an admin
- [x] Remove admin status from a group chat member
- [x] Leave a group chat

## Contributing

Pull requests are welcome.

## License

[BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause)

 NOTE: `This library is not affiliated with Skype or Microsoft in any way. Use at your own risk`.
