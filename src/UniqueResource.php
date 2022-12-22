<?php

namespace Fliq\Unique;

abstract class UniqueResource
{
    public function __construct(protected UniqueClient $client)
    {
    }
    protected function sendExtrinsic(string $uri, array $data): ExtrinsicResponse
    {
        $request = new ExtrinsicRequest($uri, $this->client);

        return $request->send($data);
    }
}