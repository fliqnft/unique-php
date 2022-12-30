<?php

namespace Fliq\Unique\Util;

class AttributesEncoder
{
    public function encode(array $attributes): mixed
    {
        return json_decode(json_encode($attributes, JSON_FORCE_OBJECT));
    }
}