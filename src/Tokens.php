<?php

namespace Fliq\Unique;

class Tokens extends UniqueResource
{

    public function create(array $args): ExtrinsicResponse
    {
        return $this->sendExtrinsic('tokens', $args);
    }

    public function get(array $args): UniqueResponseInterface
    {
        return $this->client->get('tokens', $args);
    }

    public function transfer(array $args): ExtrinsicResponse
    {
        return $this->sendExtrinsic('tokens/transfer', $args, 'PATCH');
    }

}