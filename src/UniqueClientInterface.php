<?php

namespace Fliq\Unique;

interface UniqueClientInterface
{
    public function get(string $uri, $query = []): UniqueResponseInterface;

    public function post(string $uri, array $data): UniqueResponseInterface;

    public function patch(string $uri, array $data): UniqueResponseInterface;

}