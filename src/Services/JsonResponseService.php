<?php

namespace Hyder\JsonResponse\Services;

use Illuminate\Http\Response;

class JsonResponseService
{

    private $statusCode = Response::HTTP_OK;

    private $header = [];

    private function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function withHeader(array $header)
    {
        $this->header = $header;

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
        return $this->setStatusCode(Response::HTTP_CREATED)->response([
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
        return $this->setStatusCode(Response::HTTP_BAD_REQUEST)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function unauthenticate($message = 'Unauthenticate!')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function invalidRequest($message = 'Sorry! Required field is missing')
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function notFound($message = 'Not found!')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->response([
            'status' => false,
            'message' => $message
        ]);
    }

    public function internalError($message = 'Something went wrong!')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->response([
            'status' => false,
            'message' => $message
        ]);
    }
}
