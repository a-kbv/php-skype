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

    private function executeQuery($query)
    {
        $url = "https://msgsearch.skype.com/v2/query";

        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-Skypetoken' => $this->getSession()->getSkypeToken()->getSkypeToken(),
            ],
            'json' => $query,
        ]);

        return json_decode($response->getContent(), true);
    }

    /**
     * Get the value of session
     */
    public function getSession()
    {
        return $this->session;
    }

}
