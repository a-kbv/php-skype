<?php

namespace Akbv\PhpSkype;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class QueryBuilder
{
    private $session;
    private $httpClient;
    private $limit;
    private $queryConditions;

    public function __construct($session)
    {
        $this->session = $session;
        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36',
                'Referer' => 'https://web.skype.com/',
            ],
        ]);
        $this->limit = 30;
        $this->queryConditions = [];
    }

    public function andWhere($field, $value)
    {
        if ($field && $value) {
            $this->queryConditions['AND'][] = [$field => $value];
        }

        return $this;
    }

    public function orWhere($field, $value)
    {
        if ($field && $value) {
            $this->queryConditions['OR'][] = [$field => $value];
        }

        return $this;
    }

    public function limit($value)
    {
        $this->limit = $value;
        return $this;
    }

    public function execute()
    {
        $query = $this->buildQuery($this->queryConditions);

        $result = $this->executeQuery($query);

        return $result;
    }

    private function buildQuery()
    {
        $query = [
            'OPTION' => [
                'RESULTBASE' => 0,
                'RESULTCOUNT' => $this->limit
            ],
            'QUERYSTRING' => $this->queryConditions
        ];

        return $query;
    }

    public function request(string $method, string $url, array $options = []): ?ResponseInterface
    {

        if ($this->getSession()->getSkypeToken()) {
            $options['headers']['X-Skypetoken'] = $this->getSession()->getSkypeToken()->getSkypeToken();
        }
        if (!isset($options['timeout'])) {
            $options['timeout'] = 60;
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

        return $response;
    }

    private function executeQuery($query)
    {
        $url = "https://msgsearch.skype.com/v2/query";

        $response = $this->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => json_encode($query),
        ]);

        return json_decode($response->getContent(), true);
    }

    public function querySkypeDirectory($params)
    {
        $threadId = $params['threadId'] ?? null;
        $from = $params['from'] ?? null;
        $to = $params['to'] ?? null;
        $content = $params['content'] ?? null;
        $user = $params['user'] ?? null;
        $messageId = $params['messageId'] ?? null;

        $queryConditions = [];

        if ($user) {
            $queryConditions[] = [
                'OR' => [
                    [
                        'Annotation' => [
                            'TYPE' => 'at',
                            'VALUE' => [
                                'id' => $user
                            ]
                        ]
                    ],
                    [
                        'Annotation' => [
                            'TYPE' => 'quote',
                            'VALUE' => [
                                'author' => $user
                            ]
                        ]
                    ]
                ]
            ];
        }

        if ($threadId) {
            $queryConditions[] = [
                'ThreadId' => $threadId
            ];
        }

        if ($from) {
            $queryConditions[] = [
                'From' => $from
            ];
        }

        if ($to) {
            $queryConditions[] = [
                'To' => $to
            ];
        }

        if ($messageId) {
            $queryConditions[] = [
                'MessageId' => $messageId
            ];
        }

        if ($content) {
            $queryConditions[] = [
                'Content' => $content
            ];
        }

        if ($user && $content) {
            $queryConditions[] = [
                'AND' => [
                    [
                        'Content' => $content
                    ],
                    [
                        'From' => $user
                    ]
                ]
            ];
        }

        $query = $this->buildQuery($queryConditions);

        $result = $this->executeQuery($query);

        return $result;
    }

    /**
     * Get the value of session
     */
    public function getSession()
    {
        return $this->session;
    }

}
