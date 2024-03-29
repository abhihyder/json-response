<?php

namespace Hyder\JsonResponse\Services;

use Illuminate\Http\Response;

class JsonResponseService
{

    private $statusCode = Response::HTTP_OK;

    private $header = [
        'Content-Type' => 'application/json'
    ];

    public function statusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function withHeader(array $header)
    {
        $this->header = array_merge($this->header, $header);

        return $this;
    }

    public function response(array $data)
    {
        return response()->json($data, $this->statusCode, $this->header);
    }

    public function success($message = "Request completed successfully!")
    {
        return $this->response([
            'status' => true,
            'message' => $message
        ]);
    }

    public function created($message = "Data created successfully!", $data = [])
    {
        return $this->statusCode(Response::HTTP_CREATED)->response([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function updated($message = "Data updated successfully!", $data = [])
    {
        return $this->response([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function withData($data, $message = "Data fetched successfully!")
    {
        return $this->response([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function badRequest($message = "Bad request!")
    {
        return $this->statusCode(Response::HTTP_BAD_REQUEST)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function unauthenticated($message = 'Unauthenticated!')
    {
        return $this->statusCode(Response::HTTP_UNAUTHORIZED)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function invalidRequest($message = 'Invalid request!')
    {
        return $this->statusCode(Response::HTTP_FORBIDDEN)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function validationError($message = 'Required field is missing!')
    {
        return $this->statusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function notFound($message = 'Not found!')
    {
        return $this->statusCode(Response::HTTP_NOT_FOUND)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function internalError($message = 'Internal server error!')
    {
        return $this->statusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function error($message = 'Something went wrong!', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        if ($this->statusCode != Response::HTTP_OK) return $this->response(['status' => false, 'message' => $message]);

        return $this->statusCode($statusCode)->response([
            'status' => false,
            'message' => $message
        ]);
    }
}
