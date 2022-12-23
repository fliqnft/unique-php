<?php

namespace Fliq\Unique;

/**
 * @property Collections $collections
 * @property Tokens $tokens
 * @property UniqueClientInterface $uniqueClient
 */
class Unique
{

    public function __construct(protected UniqueClientInterface $client)
    {
    }

    public function collections(): Collections
    {
        return new Collections($this->client);
    }

    public function tokens(): Tokens
    {
        return new Tokens($this->client);
    }

    public function client(): UniqueClientInterface
    {
        return $this->client;
    }

    public function __get(string $name)
    {
        return $this->{$name}();
    }

}