<?php

// ClientTest

use Fliq\Unique\Client;
use GuzzleHttp\Promise\PromiseInterface;

it('sends get requests', function () {
    $client = new Client(LOCAL_REST_URI);

    $response = $client->get('address-utils/mirror/substrate-to-ethereum', [
        'address' => '5GH16wWqd8QmupCxsdAUCUaf7XvmPCjxexKgugxbCN2a7W9Y',
    ]);

    expect($response->json('address'))->toBe('0xBA51EF218dac84818e5b7C0a9a41630f2fEe48ED');
});

it('sends post requests', function () {
    $client = new Client(LOCAL_REST_URI);

    $response = $client->post('account/generate', [
        'pairType' => 'sr25519',
        'meta' => [],
    ]);

    $words = explode(' ', $response->json('mnemonic'));

    expect($words)->toHaveCount(12);

});