<?php

namespace Fliq\Unique;


use Psr\Http\Message\ResponseInterface;

class Response implements UniqueResponseInterface
{
    public function __construct(protected ResponseInterface $response)
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