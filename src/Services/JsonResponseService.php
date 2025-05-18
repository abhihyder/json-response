<?php

namespace Hyder\JsonResponse\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class JsonResponseService
{
    private int $httpStatusCode = Response::HTTP_OK;

    private array $headers = [
        'Content-Type' => 'application/json'
    ];

    /**
     * Set the status code for the response.
     */
    public function statusCode(int $statusCode): self
    {
        $this->httpStatusCode = $statusCode;
        return $this;
    }

    /**
     * Add custom headers to the response.
     */
    public function withHeader(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function response(array|object $data): JsonResponse
    {
        return response()->json($data, $this->httpStatusCode, $this->headers);
    }

    /**
     * Build the final JSON response.
     */
    private function buildResponse(bool $success, string $message, array|object|null $data = null): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if (!is_null($data) && (is_array($data) || is_object($data))) {
            $response['data'] = $data;
        }

        return $this->response($response);
    }


    public function success(string $message = 'Request completed successfully!'): JsonResponse
    {
        return $this->httpStatusCode !== Response::HTTP_OK
            ? $this->buildResponse(true, $message)
            : $this->statusCode(Response::HTTP_OK)->buildResponse(true, $message);
    }

    public function created(string $message = 'Data created successfully!', array|object $data = []): JsonResponse
    {
        return $this->statusCode(Response::HTTP_CREATED)->buildResponse(true, $message, $data);
    }

    public function updated(string $message = 'Data updated successfully!', array|object $data = []): JsonResponse
    {
        return $this->statusCode(Response::HTTP_OK)->buildResponse(true, $message, $data);
    }


    public function data(array|object $data, string $message = 'Data fetched successfully!'): JsonResponse
    {
        return $this->httpStatusCode !== Response::HTTP_OK
            ? $this->buildResponse(true, $message, $data)
            : $this->statusCode(Response::HTTP_OK)->buildResponse(true, $message, $data);
    }

    public function badRequest(string $message = 'Bad request!'): JsonResponse
    {
        return $this->statusCode(Response::HTTP_BAD_REQUEST)->buildResponse(false, $message);
    }

    public function unauthenticated(string $message = 'Unauthenticated!'): JsonResponse
    {
        return $this->statusCode(Response::HTTP_UNAUTHORIZED)->buildResponse(false, $message);
    }

    public function invalidRequest(string $message = 'Invalid request!'): JsonResponse
    {
        return $this->statusCode(Response::HTTP_FORBIDDEN)->buildResponse(false, $message);
    }

    public function validationError(string $message = 'Required field is missing!'): JsonResponse
    {
        return $this->statusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->buildResponse(false, $message);
    }

    public function notFound(string $message = 'Not found!'): JsonResponse
    {
        return $this->statusCode(Response::HTTP_NOT_FOUND)->buildResponse(false, $message);
    }

    public function internalError(string $message = 'Internal server error!'): JsonResponse
    {
        return $this->statusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->buildResponse(false, $message);
    }

    public function error(string $message = 'Something went wrong!', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->httpStatusCode !== Response::HTTP_OK
            ? $this->buildResponse(false, $message)
            : $this->statusCode($statusCode)->buildResponse(false, $message);
    }
}
