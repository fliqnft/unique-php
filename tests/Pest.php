<?php

use Fliq\Unique\Client;
use Fliq\Unique\Collections;
use function Pest\Faker\faker;

const LOCAL_REST_URI = 'http://localhost:3333/v1/';

const SEED = '//Alice';


function testClient(): Client
{
    return new Client(LOCAL_REST_URI, [
        'Authorization' => 'Seed ' . SEED,
    ]);
}


function testCollection(): int
{
    $collections = new Collections(testClient());

    return $collections->create([
        'address' => '5GrwvaEF5zXb26Fz9rcQpDWS57CtERHpNehXCPcNoHGKutQY',
        'name' => faker()->word(),
        'description' => faker()->sentence(),
        'tokenPrefix' => strtoupper(faker()->randomLetter() . faker()->randomLetter() . faker()->randomLetter()),
    ])->wait()['parsed']['collectionId'];
}