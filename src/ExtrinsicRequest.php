<?php

namespace Fliq\Unique;

class ExtrinsicRequest
{

    public function __construct(protected string $uri, protected UniqueClientInterface $client)
    {
    }

    public function send(array $data)
    {
        $buildResult = $this->build($data);
        $signResult = $this->sign($buildResult);
        $submitResult = $this->submit($signResult);

        return new ExtrinsicResponse($submitResult, $this->client);
    }

    protected function build(array $data): mixed
    {
        return $this->client->post($this->uri . '?use=Build', $data)->json();
    }


    protected function sign(mixed $buildResult): mixed
    {
        return $this->client->post($this->uri . '?use=Sign', $buildResult)->json();
    }


    protected function submit(mixed $signResult): mixed
    {
        return $this->client->post($this->uri . '?use=Submit', $signResult)->json();
    }

}