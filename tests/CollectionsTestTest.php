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

it('can get a collection by id', function () {
    $collectionId = testCollection();

    $collections = new Collections(testClient());

    $response = $collections->get($collectionId);

    $data = $response->json();

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

})->only();