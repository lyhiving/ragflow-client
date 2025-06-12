<?php

namespace lyhiving\ragflow\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \lyhiving\ragflow\client
 */
class ragflow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ragflow';
    }
}