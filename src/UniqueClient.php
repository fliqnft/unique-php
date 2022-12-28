<?php

namespace Fliq\Unique;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class UniqueClient implements UniqueClientInterface
{

    private GuzzleClient $client;

    public function __construct(string $baseUri, $headers = [])
    {
        $this->client = new GuzzleClient([
            'base_uri' => $baseUri,
            'headers' => array_merge([
                'Accept' => 'application/json',
            ], $headers),
        ]);
    }

    public function get(string $uri, $query = []): UniqueResponseInterface
    {
        return $this->request('GET', $uri, ['query' => $query]);
    }

    public function post(string $uri, array $data): UniqueResponseInterface
    {
        return $this->request('POST', $uri, ['json' => $data]);
    }

    public function patch(string $uri, array $data): UniqueResponseInterface
    {
        return $this->request('PATCH', $uri, ['json' => $data]);
    }

    private function request(string $method, string $uri, array $options = []): UniqueResponseInterface
    {
        return new Response($this->client->request($method, $uri, $options));
    }
}
