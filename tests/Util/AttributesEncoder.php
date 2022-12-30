<?php
// AttributesEncoderTest

use Fliq\Unique\Util\AttributesEncoder;

// the attribute encoder is a helper class to convert numerical array keys into proper json.
// normally an array key like ['0' => 'x', '1' => 'y'] would convert to ['x', 'y'],
// but now it will become {'0': 'x', '1': 'y'}

it('encodes attributes into json object', function () {
    $encoder = new AttributesEncoder;

    $result = $encoder->encode([
       '0' => [
           'name' => ['_' => 'foo'],
           'type' => 'string'
       ],
        '1' => [
            'name' => ['_' => 'bar'],
            'type' => 'string'
        ],
    ]);

    expect($result)
        ->not->toBeArray()
        ->and($result)
        ->toHaveProperty('0');
});