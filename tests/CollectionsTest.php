<?php
// CollectionsTestTest

use Fliq\Unique\Collections;

it('creates collections', function () {

    $collections = new Collections(testClient());

    $response = $collections->create([
        'address' => '5GrwvaEF5zXb26Fz9rcQpDWS57CtERHpNehXCPcNoHGKutQY',
        'name' => 'Chickens',
        'description' => 'lots of chickens',
        'tokenPrefix' => 'CKN',
    ]);

    // transaction hash
    expect($response->hash())->toStartWith('0x');

    // wait for extrinsic to complete
    $resultedData = $response->wait()['parsed'];

    expect($resultedData)->toHaveKey('collectionId');

});

it('gets collections by id', function () {
    $collectionId = testCollection();

    $collections = new Collections(testClient());

    $response = $collections->get($collectionId);

    $data = $response->json();

    ray($data['properties']);

    expect($data)->toHaveKeys([
        'mode',
        'name',
        'description',
        'tokenPrefix',
        'sponsorship',
        'limits',
        'readOnly',
        'permissions',
        'id',
        'owner',
        'properties',
        'flags',
        'tokenPropertyPermissions',
    ]);
});

it('gets collection properties', function () {
    $collectionId = testCollection();

    $collections = new Collections(testClient());

    $response = $collections->getProperties($collectionId);

    $keys = array_map(fn($prop) => $prop['key'], $response->json('properties'));

    expect($keys)->toContain('schemaName', 'coverPicture.ipfsCid');
});

it('sets the collection sponsor', function () {
    $collectionId = testCollection();
    $collections = new Collections(testClient());

    $response = $collections->setSponsor([
        'address' => ALICE_ADDRESS,
        'collectionId' => $collectionId,
        'newSponsor' => ALICE_ADDRESS,
    ])->wait();

    expect($response['parsed']['sponsor'])->toBe(ALICE_ADDRESS);

    $response = $collections->confirmSponsorship([
        'address' => ALICE_ADDRESS,
        'collectionId' => $collectionId,
    ])->wait();

    expect($response['parsed']['sponsor'])->toBe(ALICE_ADDRESS);
});

it('sets collection admins', function () {
    $collectionId = testCollection();
    $collections = new Collections(testClient());

    $response = $collections->setAdmin([
        'address' => ALICE_ADDRESS,
        'collectionId' => $collectionId,
        'newAdmin' => BOB_ADDRESS,
    ])->wait();

    expect($response['parsed']['newAdmin'])->toBe(BOB_ADDRESS);
});