<?php

namespace Fliq\Unique;

class Collections
{

    public function __construct(protected Client $client)
    {
    }

    public function create(array $data)
    {
        $request = new ExtrinsicRequest('collections', $this->client);

        return $request->send($data);
    }

    // maybe instead of an int make it mixed so it could be an array, then I could have an interface
    // common between different Unique resources ie collections & tokens.
    public function get(int $collectionId)
    {
        return $this->client->get('collections', ['collectionId' => $collectionId]);
    }


}