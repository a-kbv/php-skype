![php-skype-logo](/php-skype.png)

# php-skype

php-skype is a library that wraps Skype Web API. The library is designed to be user-friendly and comes with comprehensive documentation and examples to help integrate Skype functionality into projects quickly and easily.

## Installation

Use the package manager composer to install php-skype.

```bash
composer require akbv/php-skype
```

## Usage
Note this is just the basic example to get you started. For more examples, please see the documentation and examples folder.

```php
<?php 
// Create a connection to Skype
$connection = new \Akbv\PhpSkype\Connection('email', 'password', __DIR__ . '/var/session');

// Get all contacts
$contacts = $connection->getContacts();

// Start one-to-one chat with a contact
$chat = $connection->chat('8:live:username');

// Send a message to the chat
$message = $chat->sendMessage('Hello World!');

```

## Supported features

- [x] Login With Microsoft Account (SOAP)
- [ ] Login With Microsoft Account (Live)
- [x] Get Contacts
- [x] Get Conversations
- [x] Create a one-to-one chat
- [x] Create a group chat
- [x] Get a user profile
- [x] Get user invites
- [x] Configure endpoint
- [x] Subscribe to contact and conversation events
- [x] Send messages (text, files, images, contacts)
- [x] Edit messages
- [x] Delete messages
- [x] Set consumption horizon
- [x] Set typing indicator
- [x] Get chat messages
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

### NOTE: `This library is not affiliated with Skype or Microsoft in any way. Use at your own risk`
