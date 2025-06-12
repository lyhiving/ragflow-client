<?php

namespace lyhiving\ragflow\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \lyhiving\ragflow\Api\Agent agent()
 * @method static \lyhiving\ragflow\Api\Chat chat()
 * @method static \lyhiving\ragflow\Api\Dataset dataset()
 * @method static \lyhiving\ragflow\Api\Document document()
 * @method static \lyhiving\ragflow\Api\Chunk chunk()
 * @method static \lyhiving\ragflow\Api\Session session()
 */
class Ragflow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ragflow';
    }
}