<?php

namespace Akbv\PhpSkype\Service;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class QueryBuilder
{
    private $session;
    private $httpClient;
    private $limit;
    private $queryConditions;

    public function __construct($session)
    {
        $this->session = $session;
        $this->httpClient = new \Akbv\PhpSkype\Service\HttpClient();
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
                'X-Skypetoken' => $this->getSession()->getSkypeToken(),
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
