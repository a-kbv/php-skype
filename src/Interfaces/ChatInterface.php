<?php

namespace Akbv\PhpSkype\Interfaces;

use Akbv\PhpSkype\Chat;
use Akbv\PhpSkype\Models\GroupChat;
use Akbv\PhpSkype\Models\Message;

/**
 * Class ChatInterface implements methods to interact with Skype Server.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
interface ChatInterface
{
    /**
     * Dependant on the parameters passed, this method will send a text message, a rich text message.
     * @param string $content
     * @param Message|null $edit
     * @param bool $me
     * @param bool $rich
     * @return Message
     */
    public function sendMessage(?string $content, $edit = null, $me = false, $rich = false): Message;

    /**
     * Upload a file to the conversation.  Content should be an ASCII or binary file-like object.
     * If an image, Skype will generate a thumbnail and link to the full image.
     * @param string $filePath
     * @param string $fileName
     * @param bool $isImage
     * @return Message
     */
    public function sendFile(string $filePath, string $fileName, bool $isImage = false): Message;

    /**
     * Share one or more contacts with the conversation.
     * @param \Akbv\PhpSkype\Models\User[] $contacts
     * @return Message
     */
    public function sendContacts(array $contacts): Message;

    /**
     * Update the user's consumption horizon for this conversation, i.e. where it has been read up to.
     * @param string $horizon
     * @return void
     */
    public function setConsumption(string $horizon): void;

    /**
     * Send a text message to the conversation.
     * Dependant on the parameters passed, this method will send, edit or delete a message.
     * @param mixed $editId
     * @param mixed $content,
     * @param mixed $messageType
     * @param mixed $contentType
     * @param mixed[] $customProperties
     * @return Message
     */
    public function processMessage($editId = null, $content, $messageType, $contentType, array $customProperties = []): Message;

    /**
     * Create group chat with contacts.
     * @param mixed[] $contacts
     * @param mixed[] $admins
     * @param bool $moderated
     * @return Chat
     */
    public function createGroupChat(array $contacts, array $admins, bool $moderated=false): Chat;

    /**
     * Send a typing presence notification to the conversation.  This will typically show the "{name} is typing..." message in others clients.
     * It may be necessary to send this type of message continuously, as each typing presence usually expires after a few seconds.
     * @param bool $typing
     * @return void
     */
    public function setTyping(bool $typing = true): void;

    /**
     * Retrieve a batch of messages from the conversation.
     * This method can be called repeatedly to retrieve older messages.
     * If new messages arrive in the meantime, they are returned first in the next batch.
     * @param mixed $startTime
     * @param mixed $pageSize
     *
     * @return mixed[] Array of messages.
     */
    public function getMessages($startTime, $pageSize): array;
}
