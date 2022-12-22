<?php

use Fliq\Unique\UniqueClient;
use Fliq\Unique\Collections;
use function Pest\Faker\faker;

const LOCAL_REST_URI = 'http://localhost:3333/v1/';

const ALICE_SEED = '//Alice';
const ALICE_ADDRESS = '5GrwvaEF5zXb26Fz9rcQpDWS57CtERHpNehXCPcNoHGKutQY';

const BOB_SEED = '//Bob';
const BOB_ADDRESS = '5FHneW46xGXgs5mUiveU4sbTyGBzmstUspZC92UhjJM694ty';


function testClient(string $seed = ALICE_SEED): UniqueClient
{
    return new UniqueClient(LOCAL_REST_URI, [
        'Authorization' => 'Seed ' . $seed,
    ]);
}


function testCollection(): int
{
    $collections = new Collections(testClient());

    return $collections->create([
        'address' => ALICE_ADDRESS,
        'name' => faker()->word(),
        'description' => faker()->sentence(),
        'tokenPrefix' => strtoupper(faker()->randomLetter() . faker()->randomLetter() . faker()->randomLetter()),
        'schema' => [
            'schemaName' => 'unique',
            'schemaVersion' => '1.0.0',
            'image' => ['urlTemplate' => 'some_url/{infix}.extension'],
            'coverPicture' => ['ipfsCid' => 'Qmb8Mun46txkiACS5tSnKXvoHXxVQ2nofMPftqrDnbuP2A'],
        ],
    ])->wait()['parsed']['collectionId'];
}