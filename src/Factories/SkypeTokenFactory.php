<?php

namespace Akbv\PhpSkype\Factories;

use Akbv\PhpSkype\Models\SkypeToken;

/**
 * Class SessionFactory manages conversion SkypeToken to data and reverse.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeTokenFactory
{
    public const FIELD_SKYPE_TOKEN = 'skypeToken';
    public const FIEL_SKYPE_TOKEN_EXPIRY = 'expiresIn';

    /**
     * @param mixed[] $data
     * @return SkypeToken
     */
    public static function buildSkypeTokenFromData(array $data): SkypeToken
    {
        $result = new SkypeToken();
        $result->setSkypeToken($data[self::FIELD_SKYPE_TOKEN]);
        $result->setExpiresIn($data[self::FIEL_SKYPE_TOKEN_EXPIRY]);
        return $result;
    }

    /**
     * @param SkypeToken $skypeToken
     * @return mixed[]
     */
    public static function buildDataFromSkypeToken(SkypeToken $skypeToken): array
    {
        $result = [
            self::FIELD_SKYPE_TOKEN => $skypeToken->getSkypeToken(),
            self::FIEL_SKYPE_TOKEN_EXPIRY => $skypeToken->getExpiresIn(),
        ];
        return $result;
    }
}
