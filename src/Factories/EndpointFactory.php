<?php

namespace Akbv\PhpSkype\Factories;

use Akbv\PhpSkype\Models\Endpoint;

/**
 * Class SessionFactory manages conversion RegistrationToken to data and reverse.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class EndpointFactory
{
    public const FIELD_ENDPOINT_ID = 'id';
    public const FIELD_ENDPOINT_PRESENCE = 'presence';
    public const FIELD_ENDPOINT_SUBSCRIBED = 'subscribed';
    public const FIELD_ENDPOINT_SUBSCRIBED_PRESENCE = 'subscribedPresence';

    /**
     * @param mixed[] $data
     * @return Endpoint
     */
    public static function buildEndpointFromData(array $data): Endpoint
    {
        $result = new Endpoint();
        $result->setId($data[self::FIELD_ENDPOINT_ID]);
        $result->setPresence($data[self::FIELD_ENDPOINT_PRESENCE]);
        $result->setSubscribed($data[self::FIELD_ENDPOINT_SUBSCRIBED]);
        $result->setSubscribedPresence($data[self::FIELD_ENDPOINT_SUBSCRIBED_PRESENCE]);
        return $result;
    }

    /**
     * @param Endpoint $endpoint
     * @return mixed[]
     */
    public static function buildDataFromEndpoint(Endpoint $endpoint): array
    {
        $result = [
            self::FIELD_ENDPOINT_ID => $endpoint->getId(),
            self::FIELD_ENDPOINT_PRESENCE => $endpoint->getPresence(),
            self::FIELD_ENDPOINT_SUBSCRIBED => $endpoint->getSubscribed(),
            self::FIELD_ENDPOINT_SUBSCRIBED_PRESENCE => $endpoint->getSubscribedPresence(),
        ];
        return $result;
    }
}
