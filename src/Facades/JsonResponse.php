<?php

namespace Hyder\JsonResponse\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static \Illuminate\Http\JsonResponse success(string $message = "Request completed successfully!")
 * @method static \Illuminate\Http\JsonResponse created(string $message = "Data created successfully!", array $data = [])
 * @method static \Illuminate\Http\JsonResponse updated(string $message = "Data updated successfully!", array $data = [])
 * @method static \Illuminate\Http\JsonResponse data(array $data, string $message = "Data fetched successfully!")
 * @method static \Illuminate\Http\JsonResponse badRequest(string $message = "Bad request!")
 * @method static \Illuminate\Http\JsonResponse unauthenticated(string $message = 'Unauthenticated!')
 * @method static \Illuminate\Http\JsonResponse invalidRequest(string $message = 'Invalid request!')
 * @method static \Illuminate\Http\JsonResponse validationError(string $message = 'Required field is missing!')
 * @method static \Illuminate\Http\JsonResponse notFound(string $message = 'Not found!')
 * @method static \Illuminate\Http\JsonResponse internalError(string $message = 'Internal server error!')
 * @method static \Illuminate\Http\JsonResponse error(string $message = 'Something went wrong!', int $statusCode = 500)
 * @method static \Hyder\JsonResponse\Services\JsonResponseService statusCode(int $statusCode)
 * @method static \Hyder\JsonResponse\Services\JsonResponseService withHeader(array $header)
 */


class JsonResponse extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'json-response-service';
    }
}
