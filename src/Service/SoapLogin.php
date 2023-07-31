<?php

namespace Akbv\PhpSkype\Service;

class SoapLogin
{
    public const AUTH_SKYPE_SECURITY_TOKEN_URL = 'https://login.live.com/RST.srf';
    public const AUTH_SKYPE_TOKEN_URL = 'https://edge.skype.com/rps/v1/rps/skypetoken';
    public const AUTH_REGISTRATION_TOKEN_URL = 'https://client-s.gateway.messenger.live.com/v1';

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $securityToken;

    /**
     * @var string
     */
    private $skypeToken;

    /**
     * @var string
     */
    private $registrationToken;

    /**
     * @var string
     */
    private $endpointId;

    /**
     * @var \DateTime
     */
    private $skypeTokenExpires;

    /**
     * @var string
     */
    private $messengerHost;

    /**
     * @var \DateTime
     */
    private $registrationTokenExpires;

    private $httpClient;

    //construct
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->httpClient = new \Akbv\PhpSkype\Service\HttpClient();
        $this->getSecurityTokenR();
        $this->getSkypeTokenR();
        $this->getRegistrationTokenR();
    }

    /**
     * Login on Microsoft web page with SOAP and retrieves from Microsoft arguments BinarySecurityToken.
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws ClientSecurityTokenException
     */
    private function getSecurityTokenR(): void
    {   
      
        $template = file_get_contents(__DIR__. '.../../Resource/soapTemplate.xml') .PHP_EOL;
   

        // Replace placeholders in the template with actual values
        $template = str_replace('{username}', $this->username, $template);
        $template = str_replace('{password}', $this->password, $template);

        $response = $this->httpClient->request('POST', self::AUTH_SKYPE_SECURITY_TOKEN_URL, [
            'headers' => [
                'Content-Type' => 'application/soap+xml; charset=utf-8',
                'Content-Length' => strlen($template),
            ],
            'body' => $template,
        ]);

        if (!$response || $response->getStatusCode() !== 200) {
            throw new \Akbv\PhpSkype\Exception\AuthenticationSecurityTokenException($response->getStatusCode());
        }

        $xmlString = $response->getContent();
        $binarySecurityTokenRegex = '/<wsse:BinarySecurityToken[^>]*>(.*?)<\/wsse:BinarySecurityToken>/';
        preg_match($binarySecurityTokenRegex, $xmlString, $matches);

        $binarySecurityToken = $matches[1] ?? '';
        $securityToken = substr($binarySecurityToken, 2);

        if (!$securityToken) {
            throw new \Akbv\PhpSkype\Exception\AuthenticationSecurityTokenException($response->getStatusCode());
        }

        $this->securityToken = $securityToken;
    }


    /**
     * Login on Microsoft Redirect web page and setup Microsoft arguments
     * This method depends of @see loginMicrosoft retrieved values.
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Akbv\PhpSkype\Exception\AuthenticationSkypeTokenException
     */
    private function getSkypeTokenR(): void
    {
        $data = ["partner" => "999", "access_token" => $this->securityToken, "scopes" => "client"];

        $response = $this->httpClient->request('POST', self::AUTH_SKYPE_TOKEN_URL, [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
                'Content-Length' => strlen(json_encode($data)),
            ],
            'body' => json_encode($data),
            'verify_peer' => false,
            'verify_host' => false,
        ]);

        if (!$response || $response->getStatusCode() !== 200) {
            throw new \Akbv\PhpSkype\Exception\AuthenticationSkypeTokenException($response->getStatusCode());
        }

        $jsonString = $response->getContent();
        $responseBody = json_decode($jsonString);

        if (!$responseBody || !$responseBody->skypetoken) {
            throw new \Akbv\PhpSkype\Exception\AuthenticationSkypeTokenException($responseBody);
        }

        $this->skypeToken = $responseBody->skypetoken;
        $this->skypeTokenExpires = new \DateTime('+' . $responseBody->expiresIn . ' seconds');
    }

    /**
     * Register in the Skype and setup registrationToken.
     * This method depends of @see loginSkype retrieved values.
     * Method detects Messenger URL by redirecting on Clients Server.
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getRegistrationTokenR(): void
    {
        $msgsHost = self::AUTH_REGISTRATION_TOKEN_URL;
        $registrationToken = null;
        $expiry = null;
        $endpoint = null;
        $endpointResponse = null;

        while (!$registrationToken) {
          
            $headers = [
                "BehaviorOverride" => "redirectAs404",
                "Authentication" => 'skypetoken=' . $this->skypeToken,
            ];
            try {
                $endpointResponse = $this->httpClient->request('POST', "$msgsHost/users/ME/endpoints", [
                    'headers' => $headers,
                    'json' => [
                        "endpointFeatures" => "Agent"
                    ],
                ]);
            } catch (\Symfony\Component\HttpClient\Exception\ClientException $e) {
                $response = $e->getResponse();
                $headersArray = $response->getInfo()['response_headers'];
                $locHead = array_filter($headersArray, function ($header) {
                    return strpos($header, 'Location: ') !== false;
                });
                $locHead = array_shift($locHead);
                $locHead = str_replace('Location: ', '', $locHead);

                $locParts = explode('/', $locHead);
                $msgsHost = implode('/', array_slice($locParts, 0, -3));
                continue;
            }

            $locationHeader = $endpointResponse->getHeaders()['location'][0] ?? null;
            $registrationTokenHeader = $endpointResponse->getHeaders()['set-registrationtoken'][0] ?? null;
            if ($locationHeader) {
                preg_match('/(https:\/\/[^\/]+\/v1)\/users\/ME\/endpoints(\/(%7B[a-z0-9\-]+%7D))?/', $locationHeader, $locParts);
                if (isset($locParts[3])) {
                    $endpoint = str_replace("%7B", "{", str_replace("%7D", "}", $locParts[3]));
                }
                # Skype is requiring the use of a different hostname.
                if ($locParts[1] !== $msgsHost) {
                    # Don't accept the token if present, we need to re-register first.
                    $msgsHost = $locParts[1];
                    continue;
                }
            }

            if (!empty($registrationTokenHeader)) {
                preg_match('/(registrationToken=[a-z0-9\+\/=]+)/i', $registrationTokenHeader, $matches);
                $registrationToken = $matches[1] ?? null;
                $registrationToken = substr($registrationToken, 18);
                preg_match('/expires=(\d+)/', $registrationTokenHeader, $regExpiryMatch);
                if (isset($regExpiryMatch[1])) {
                    $expiry = $regExpiryMatch[1];
                }
                preg_match('/endpointId=(\{[a-z0-9\-]+\})/', $registrationTokenHeader, $regEndMatch);
                if (isset($regEndMatch[1])) {
                    $endpoint = $regEndMatch[1];
                }
            }

            if (!$endpoint && in_array($endpointResponse->getStatusCode(), [200]) && $endpointResponse->getContent()) {
                $endpoint = json_decode($endpointResponse->getContent(), true)[0]["id"];
            }
        }

        $this->endpointId = $endpoint;
        $this->registrationToken = $registrationToken;
        $this->registrationTokenExpires = \DateTime::createFromFormat("U", $expiry);
        $this->messengerHost = $msgsHost;
    }

    /**
     * Get the value of skypeToken
     *
     * @return  string
     */ 
    public function getSkypeToken()
    {
        return $this->skypeToken;
    }

    /**
     * Get the value of securityToken
     *
     * @return  string
     */ 
    public function getSecurityToken()
    {
        return $this->securityToken;
    }


    /**
     * Get the value of registrationToken
     *
     * @return  string
     */ 
    public function getRegistrationToken()
    {
        return $this->registrationToken;
    }

    /**
     * Get the value of endpointId
     *
     * @return  string
     */ 
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * Get the value of skypeTokenExpires
     *
     * @return  \DateTime
     */ 
    public function getSkypeTokenExpires()
    {
        return $this->skypeTokenExpires;
    }

    /**
     * Get the value of registrationTokenExpires
     *
     * @return  \DateTime
     */ 
    public function getRegistrationTokenExpires()
    {
        return $this->registrationTokenExpires;
    }

    /**
     * Get the value of messengerHost
     *
     * @return  string
     */ 
    public function getMessengerHost()
    {
        return $this->messengerHost;
    }
}
