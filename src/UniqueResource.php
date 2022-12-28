<?php

namespace Fliq\Unique;

abstract class UniqueResource
{
    public function __construct(protected UniqueClientInterface $client)
    {
    }
    protected function sendExtrinsic(string $uri, array $data, string $method = 'POST'): ExtrinsicResponse
    {
        $request = new ExtrinsicRequest($uri, $this->client, $method);

        return $request->send($data);
    }
}