<?php

namespace Fliq\Unique;

class ExtrinsicRequest
{

    public function __construct(protected string $uri, protected UniqueClientInterface $client, protected $method = 'POST')
    {
    }

    public function send(array $data): ExtrinsicResponse
    {
        $buildResult = $this->build($data);
        $signResult = $this->sign($buildResult);
        $submitResult = $this->submit($signResult);

        return new ExtrinsicResponse($submitResult, $this->client);
    }

    protected function build(array $data): mixed
    {
        return $this->request($this->uri . '?use=Build', $data);
    }


    protected function sign(mixed $buildResult): mixed
    {
        return $this->request($this->uri . '?use=Sign', $buildResult);
    }


    protected function submit(mixed $signResult): mixed
    {
        return $this->request($this->uri . '?use=Submit', $signResult);
    }

    protected function request($uri, $result)
    {
        return $this->client->{strtolower($this->method)}($uri, $result)->json();
    }

}