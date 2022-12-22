<?php
// ExtrinsicRequestTest

// mock the unique client assert query param
use Fliq\Unique\ExtrinsicRequest;
use Fliq\Unique\ExtrinsicResponse;
use Fliq\Unique\UniqueClientInterface;
use Fliq\Unique\UniqueResponseInterface;

it('sends an extrinsic by building it, signing it and submitting it', function () {
    $client = Mockery::mock(UniqueClientInterface::class);
    $response = Mockery::mock(UniqueResponseInterface::class);

    $response->shouldReceive('json')
        ->times(3)
        ->andReturn([]);

    $client->shouldReceive('post')->with('foo?use=Build', [])->andReturn($response);
    $client->shouldReceive('post')->with('foo?use=Sign', [])->andReturn($response);
    $client->shouldReceive('post')->with('foo?use=Submit', [])->andReturn($response);

    $request = new ExtrinsicRequest('foo', $client);

    $response = $request->send([]);

    expect($response)->toBeInstanceOf(ExtrinsicResponse::class);

});