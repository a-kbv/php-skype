<?php
require_once __DIR__ . '/bootstrap.php';

use Akbv\PhpSkype\Client;
use Akbv\PhpSkype\Services\SessionManager;

/**
 * Get session if exists or create new one
 */
$sessionManager = new SessionManager(
    __DIR__ . '/sessions',
    $_ENV['SESSION_SECRET']
);
$client = new Client($sessionManager);
/**
 * New account model
 */
$account = new Akbv\PhpSkype\Models\Account($_ENV['SKYPE_LOGIN'], $_ENV['SKYPE_PASSWORD']);
/**
 * Login
 */
$client->login($account);
/**
 * Get contacts
 */
$client->getAllContacts();

/**
 * Create one to one chat or load existing one , no matter group chat or one to one
 */
$chat = $client->chat("8:live:.cid.3e1fbf88961d076d");
/**
 * Get messages
 */
$messages = $chat->getMessages();
/**
 * Send message
 */
$message = $chat->sendMessage('test');
/**
 * Edit message
 */
$message = $chat->sendMessage('test edited', $message);
/**
 * Delete message
 */
$message = $chat->sendMessage(null, $message);
/**
 * Send file
 */
$message = $chat->sendFile('toDoList.txt', 'toDoList.txt');
/**
 * Send image
 */
$message = $chat->sendFile('avatar.png', 'avatar.png', true);

/**
 * Create group chat
 */
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

/**
 * Get messages
 */
$messages = $chat->getMessages();
/**
 * Set topic
 */
$chat->setTopic('New Group Chat');
/**
 * Add member
 */
$chat = $chat->addMember('live:.cid.3e1fbf88961d076d');
/**
 * Remove member
 */
$chat = $chat->removeMember('live:.cid.3e1fbf88961d076d');
/**
 * Leave chat
 */
$chat = $chat->leave();

/**
* Subscribe for events
*/
$eventLoop = new Akbv\PhpSkype\Services\EventLoop($client);

$eventLoop->onEvent(function ($event) use ($eventLoop) {
    echo "Got event: " . $event->getType() . PHP_EOL;
    if ($event->getType() == 'NewMessage') {
        if ($event->getType() == 'NewMessage') {
            /** @var \Akbv\PhpSkype\Models\Message */
            $message = $event->NewMessage->getMessage();
            if ($message->getMessagetype() =='Control/Typing') {
                print_r($message->getImdisplayname() . ' is typing...');
                echo PHP_EOL;
            }
        }
    }
});

$eventLoop->onError(function (\Throwable $e) use ($eventLoop) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    $eventLoop->stop();
});

$eventLoop->run();







