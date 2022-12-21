<?php

namespace Fliq\Unique;

class ExtrinsicResponse
{

    public function __construct(protected array $response, protected Client $client)
    {
    }

    public function hash()
    {
        return $this->response['hash'];
    }

    public function wait()
    {
        do {
            usleep(5000);
            $data = $this->client->get('extrinsic/status', ['hash' => $this->hash()])->json();
        } while ($data['isCompleted'] == false);

        return $data;
    }

}