<?php

namespace Fliq\Unique;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    public function __construct(protected GuzzleResponse $response)
    {
    }

    public function json(string $key = null)
    {
        $json = json_decode($this->response->getBody()->getContents(), true);

        if ($key) {
            return $json[$key];
        }

        return $json;
    }

}