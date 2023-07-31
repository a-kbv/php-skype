<?php

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Initialize the connection and log in.
 * @var \Akbv\PhpSkype\Connection $connection
 * @param string $email
 * @param string $password
 * @param string $sessionPath
 */
$connection = new \Akbv\PhpSkype\Connection('email', 'password', __DIR__ . '/var/session');


/**
 * Get logged in user details.
 * @return \Akbv\PhpSkype\Model\SkypeUser\SkypeUser $logedUserDetails
 */
$loggedUserDetails = $connection->getUser();

/**
 * Fetch contacts.
 * @return \Akbv\PhpSkype\Model\SkypeContacts\SkypeContact[] $contacts
 */
$contacts = $connection->fetchContacts();

/**
 * Fetch conversations. returns syncState for next fetch.
 * @param string $syncStateUrl
 * @param int $pageSize
 * @return \Akbv\PhpSkype\Dto\SkypeChat\SkypeChatDto
 */
$chats = $connection->fetchConversations(null, 30)->getChats();

/**
 * Load one-to-one or group conversation.
 * @var \Akbv\PhpSkype\Chat $chat
 * @param string $id
 */
$chat = $connection->chat('19:test3');

/**
 * Create a new group conversation.
 * @var \Akbv\PhpSkype\Chat $chat
 * @param string[] $members
 * @param string[] $admins
 */
$chat = $connection->groupChat(
    [
    'live:.cid.3e1fbf86661d076d',
    'live:.cid.3e1fbf88961d076d',
    'live:.cid.3e1fbf88961d076d',
    ],
    [
    $connection->getUser()->getUsername(),
    ]
);

/**
 * Set a topic for a conversation.
 * @param string $topic
 * @return \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $chat
 */
$chat = $chat->setTopic('New Group Chat');

/**
 * Add members to a conversation.
 * @param string $skypeUsername
 * @param bool $admin
 * @return \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $chat
 */
$chat = $chat->addMember('live:.cid.3e1fbf88961d076d', true);

/**
 * Remove members from a conversation.
 * @param string $skypeUsername
 * @return \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $chat
 */
$chat = $chat->removeMember('live:.cid.3e1fbf88961d076d');

/**
 * Set a conversation to open for joining.
 * @param bool $open
 * @return \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $chat
 */
$chat = $chat->setOpen(true);

/**
 * Set a conversation to moderated.
 * @param bool $moderated
 * @return \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $chat
 */
$chat = $chat->setModerated(true);

/**
 * Set a conversation history to be readable by new members.
 * @param bool $history
 * @return \Akbv\PhpSkype\Model\SkypeChat\SkypeChat $chat
 */
$chat = $chat->setHistory(true);

/**
 * Leave a conversation.
 */
$chat->leave();

/**
 * Sends a typing indicator to a conversation.
 * @param bool $typing
 * @return \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage $message
 */
$message = $chat->setTyping(true);

/**
 * Fetch messages of a conversation.
 * @param string $syncStateUrl
 * @param int $pageSize
 * @return \Akbv\PhpSkype\Dto\SkypeMessage\SkypeMessageDto
 */
$messages = $chat->getMessages(null, 30)->getMessages();

/**
 * Send a message to a conversation.
 * @param string $content
 * @param string \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage $message to edit or delete (optional)
 *
 * @return \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage $message
 */
$message = $chat->sendMessage('test'.time());
/**
 * Edit a message.
 */
$message = $chat->sendMessage('test edited', $message);
/**
 * Delete a message.
 */
$message = $chat->sendMessage(null, $message);

/**
 * Send a file to a conversation.
 * @param string $path
 * @param string $name
 * @param bool $image tag to set if file is image type(optional)
 */
$message = $chat->sendFile('toDoList.txt', 'toDoList.txt');
/**
 * Send an image to a conversation.
 *
 */
$message = $chat->sendFile('avatar.png', 'avatar.png', true); //image


/**
 * Long poll skype for events.
 * To use in event handler for example
 */
$connection->getEvents();


$eventLoop = new \Akbv\PhpSkype\Service\EventLoop($connection);

$eventLoop->onEvent(function($event){
    var_dump($event);
});

$eventLoop->onError(function($error){
    var_dump($error);
});

/**
 * Continuously handle any incoming events using @method cycle().
 */
$eventLoop->run();

/**
 * Stop the event loop.
 */
$eventLoop->stop();


