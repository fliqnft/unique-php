<?php

namespace Fliq\Unique;

class Collections extends UniqueResource
{

    public function create(array $data)
    {
        return $this->sendExtrinsic('collections', $data);
    }

    // maybe instead of an int make it mixed so it could be an array, then I could have an interface
    // common between different Unique resources ie collections & tokens.
    public function get(int $collectionId)
    {
        return $this->client->get('collections', ['collectionId' => $collectionId]);
    }

    public function getProperties(int $collectionId)
    {
        return $this->client->get('collections/properties', ['collectionId' => $collectionId]);
    }

    public function setSponsor(array $args)
    {
        return $this->sendExtrinsic('collections/sponsorship', $args);
    }

    public function confirmSponsorship(array $args)
    {
        return $this->sendExtrinsic('collections/sponsorship/confirm', $args);
    }

    public function setAdmin(array $args)
    {
        return $this->sendExtrinsic('collections/admins', $args);
    }


}