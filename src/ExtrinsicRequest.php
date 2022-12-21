<?php

namespace Fliq\Unique;

class ExtrinsicRequest
{

    public function __construct(protected string $uri, protected Client $client)
    {
    }

    public function send(array $data)
    {
        $buildResult = $this->build($data);
        $signResult = $this->sign($buildResult);
        $submitResult = $this->submit($signResult);

        return new ExtrinsicResponse($submitResult, $this->client);
    }

    public function build(array $data): mixed
    {
        return $this->client->post($this->uri . '?use=Build', $data)->json();
    }


    public function sign(mixed $buildResult): mixed
    {
        return $this->client->post($this->uri . '?use=Sign', $buildResult)->json();
    }


    public function submit(mixed $signResult): mixed
    {
        return $this->client->post($this->uri . '?use=Submit', $signResult)->json();
    }

}