<?php

namespace Akbv\PhpSkype\Factories;

use Akbv\PhpSkype\Models\Account;
use Akbv\PhpSkype\Models\Session;
use Akbv\PhpSkype\Models\Endpoint;
use DateTime;

/**
 * Class SessionFactory manages conversion Session to data and reverse.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class SessionFactory
{
    public const FIELD_CONVERSATION = 'conversation';
    public const FIELD_SKYPE_TOKEN = 'skypeToken';
    public const FIELD_REGISTRATION_TOKEN = 'registrationToken';
    public const FIELD_EXPIRY = 'expiry';
    public const FIELD_ENDPOINT = 'endpoint';

    /**
     * Produce Session from data array.
     * @param Account $account
     * @param mixed[] $data
     * @return Session
     */
    public static function buildSessionFromData(Account $account, array $data): Session
    {
        $result = new Session($account);
        $account->setConversation(ConversationFactory::buildConversationFromData($data[self::FIELD_CONVERSATION]));
        $result->setSkypeToken(SkypeTokenFactory::buildSkypeTokenFromData($data[self::FIELD_SKYPE_TOKEN]));
        $result->setRegistrationToken(RegistrationTokenFactory::buildRegistrationTokenFromData($data[self::FIELD_REGISTRATION_TOKEN]));
        $result->setExpiry(\DateTime::createFromFormat('Y-m-d H:i:s', (string)$data[self::FIELD_EXPIRY]));
        $result->setEndpoint(EndpointFactory::buildEndpointFromData($data[self::FIELD_ENDPOINT]));
        return $result;
    }

    /**
     * @param Session $session
     * @return mixed[]
     */
    public static function buildDataFromSession(Session $session): array
    {
        $result = [
            self::FIELD_CONVERSATION => ConversationFactory::buildDataFromConversation($session->getAccount()->getConversation()),
            self::FIELD_SKYPE_TOKEN => SkypeTokenFactory::buildDataFromSkypeToken($session->getSkypeToken()),
            self::FIELD_REGISTRATION_TOKEN => RegistrationTokenFactory::buildDataFromRegistrationToken($session->getRegistrationToken()),
            self::FIELD_EXPIRY => $session->getExpiry()->format('Y-m-d H:i:s'),
            self::FIELD_ENDPOINT => EndpointFactory::buildDataFromEndpoint($session->getEndpoint()),
        ];
        return $result;
    }
}
