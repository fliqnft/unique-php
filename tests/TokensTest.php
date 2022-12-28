<?php
// TokensTest

use Fliq\Unique\Tokens;

it('creates tokens', function () {
    $collectionId = testCollection();

    $tokens = new Tokens(testClient());

    $result = $tokens->create([
        'address' => ALICE_ADDRESS,
        'owner' => ALICE_ADDRESS,
        'collectionId' => $collectionId,
    ])->wait();

    expect($result['parsed'])->toHaveKeys(['collectionId', 'tokenId']);
});

it('gets tokens', function () {
    $arr = testToken();

    $tokens = new Tokens(testClient());

    $result = $tokens->get($arr);

    expect($result->json())->toHaveKeys([
        'owner',
        'tokenId',
        'collectionId',
        'attributes',
        'image',
        'properties',
        'collection',
    ]);
});

it('gets transfers tokens', function () {
    $arr = testToken();

    $tokens = new Tokens(testClient());

    $result = $tokens->transfer([
        'address' => ALICE_ADDRESS,
        'from' => ALICE_ADDRESS,
        'to' => BOB_ADDRESS,
        'collectionId' => $arr['collectionId'],
        'tokenId' => $arr['tokenId'],
    ])->wait();

    expect($result['parsed'])->toHaveKeys([
        'collectionId',
        'tokenId',
        'from',
        'to',
    ]);
});

it('gets tokens owned by account', function () {
    $arr = testToken();

    $tokens = new Tokens(testClient());

    $result = $tokens->getAccountTokens([
        'address' => ALICE_ADDRESS,
        'collectionId' => $arr['collectionId'],
    ])->json('tokens');

    expect($result)
        ->toHaveCount(1)
        ->and($result[0])
        ->toHaveKeys(['collectionId', 'tokenId']);

})->only();