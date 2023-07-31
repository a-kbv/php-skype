<?php

namespace Akbv\PhpSkype\Service;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class HttpClient {

    private $httpClientOptions = [
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36',
            'Referer' => 'https://web.skype.com/',
        ],
    ];

    private $httpClient;

    public function __construct() {
        $this->httpClient = \Symfony\Component\HttpClient\HttpClient::create($this->httpClientOptions);
    }

    /**
     * Make server request.
     * Extends basic options by internal.
     * Catch redirects while request.
     * @param string $method
     * @param string $url
     * @param mixed[] $options [
     *    'authorization_session' => <Session> Add auth headers by Session.
     * ]
     * @param string $redirectUrl Returns url on that those 301 redirect.
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function request(string $method, string $url, array $options = [], string &$redirectUrl = null): ?\Symfony\Contracts\HttpClient\ResponseInterface
    {
        // echo "requesting $url".PHP_EOL;
        if (isset($options['session'])) {
            /* @var $session Session */
            $session = $options['session'];
            if ($session->getSkypeToken()) {
                $options['headers']['X-Skypetoken'] = $session->getSkypeToken();
                $options['headers']['Authentication'] = 'skypetoken=' . $session->getSkypeToken();
                $options['headers']['Cookie'] = 'skypetoken_asm=' . $session->getSkypeToken();
            }
            if ($session->getRegistrationToken()) {
                $options['headers']['RegistrationToken'] = 'registrationToken=' . $session->getRegistrationToken();
            }
            if (!isset($options['timeout'])) {
                $options['timeout'] = 60;
            }
            unset($options['session']);
        }
        $options['on_progress'] = function (int $dlNow, int $dlSize, array $info) use (&$redirectUrl): void {
            if (isset($info['http_code']) && ($info['http_code'] == 301)) {
                foreach ($info['response_headers'] as $responseHeader) {
                    if ('location' === substr($responseHeader, 0, 8)) {
                        $redirectUrl = trim(substr($responseHeader, 9));
                        break;
                    }
                }
            }
        };
        $response = $this->httpClient->request($method, $url, $options);
        // Try to execute Request.
        try {
            $response->getContent();
        } catch (\Symfony\Component\HttpClient\Exception\ClientException $exception) {
            // For testing purpose Skype can change Server Messenger URL and attempting to request should be repeated.
            if (!empty($redirectUrl)) {
                $response = $this->httpClient->request($method, $redirectUrl, $options, $redirectUrl);
            } else {
                throw $exception;
            }
        }
        return $response;
    }
}