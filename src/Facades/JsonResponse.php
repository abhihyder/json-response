<?php

namespace Hyder\JsonResponse\Facades;

use Illuminate\Support\Facades\Facade;

class JsonResponse extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'json-response-service';
    }
}
