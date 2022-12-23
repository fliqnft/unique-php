<?php
// UniqueTest

use Fliq\Unique\Collections;
use Fliq\Unique\Tokens;
use Fliq\Unique\Unique;
use Fliq\Unique\UniqueClientInterface;

it('can get instances of classes', function ($method, $class) {
    $unique = new Unique(testClient());

    // Example: $unique->collections();
    expect($unique->{$method}())->toBeInstanceOf($class);

    // Example: $unique->tokens;
    expect($unique->{$method})->toBeInstanceOf($class);
})->with([
    ['collections', Collections::class],
    ['tokens', Tokens::class],
]);


it('can get the client', function () {
    $unique = new Unique(testClient());


    expect($unique->client())->toBeInstanceOf(UniqueClientInterface::class);

});