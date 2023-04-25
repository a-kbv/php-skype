<?php

namespace Akbv\PhpSkype\Factories;

use Akbv\PhpSkype\Models\RegistrationToken;

/**
 * Class SessionFactory manages conversion RegistrationToken to data and reverse.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class RegistrationTokenFactory
{
    public const FIELD_REGISTRATION_TOKEN = 'registrationToken';
    public const FIELD_MESSENGER_URL = 'messengerUrl';
    public const FIELD_RESPONSE = 'response';
    public const FIELD_ENDPOINT = 'endpoint';
    public const FIELD_EXPIRY = 'expiry';

    /**
     * @param mixed[] $data
     * @return RegistrationToken
     */
    public static function buildRegistrationTokenFromData(array $data): RegistrationToken
    {
        $result = new RegistrationToken();
        $result->setRegistrationToken($data[self::FIELD_REGISTRATION_TOKEN]);
        $result->setResponse($data[self::FIELD_RESPONSE]);
        $result->setMessengerUrl($data[self::FIELD_MESSENGER_URL]);
        $expiry = new \DateTime($data[self::FIELD_EXPIRY]);
        $result->setExpiry($expiry);
        return $result;
    }

    /**
     * @param RegistrationToken $registrationToken
     * @return mixed[]
     */
    public static function buildDataFromRegistrationToken(RegistrationToken $registrationToken): array
    {
        $result = [
            self::FIELD_REGISTRATION_TOKEN => $registrationToken->getRegistrationToken(),
            self::FIELD_RESPONSE => $registrationToken->getResponse(),
            self::FIELD_MESSENGER_URL => $registrationToken->getMessengerUrl(),
            self::FIELD_EXPIRY => $registrationToken->getExpiry()->format("Y-m-d H:i:s"),
        ];
        return $result;
    }
}
