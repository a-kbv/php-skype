# php-skype
php-skype is a library that wraps Skype Web API. The library is designed to be user-friendly and comes with comprehensive documentation and examples to help integrate Skype functionality into projects quickly and easily.

# Note: `library is under development, please use it with caution`

## Installation 


Use the package manager composer to install php-skype. 

```bash 
$ composer require akbv/php-skype 
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

## Usage
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
$client->getAllContacts();

/** Start chat with contact */
$chat = $client->chat('8:live:example');

/** Send message to chat */
$message = $chat->sendMessage('Hello world!'); 

```

## Contributing

Pull requests are welcome.

## License

[BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause)

### NOTE: `This library is not affiliated with Skype or Microsoft in any way. Use at your own risk`.
