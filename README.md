# JSON-Response Laravel Package

## Overview

The JSON-Response package provides a simple and minimalistic interface for handling JSON responses in your Laravel applications. It offers convenient methods for returning success responses and error responses with standardized formats.

## Installing

You can install the JSON-Response package via Composer. Run the following command in your terminal:

```bash
composer require hyder/json-response
```

## Optional

The service provider will automatically get registered. Or you may manually add the service provider in your `config/app.php` file:

```php
'providers' => [
    // ...
    Hyder\JsonResponse\JsonResponseServiceProvider::class,
];
```

## Uses

### Basic Usage

To use the JSON-Response package, you need to import the JsonResponse facade and make use of its methods in your controllers or routes.

```php
use Hyder\JsonResponse\Facades\JsonResponse;

// ...

public function store(Request $request)
{
    try {

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            // Validation rules
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return a validation error response
            return JsonResponse::validationError($validator->errors());
        }

        // Process the request and create a new resource

        // Return a success response
        return JsonResponse::created($message);
    } catch(\Exception $ex){
        return JsonResponse::internalError($ex->getMessage());
    }

}

public function update(Request $request, $id)
{
    // Process the request and update the specified resource

    // Return a success response
    return JsonResponse::updated($message);
}

```

### Available Success Methods

The following methods are available for returning success responses:

1. `created($message = "Data created successfully!", $data = null)`
   Returns a response with a 201 Created status code, a success message, and optional data.
2. `updated($message = "Data updated successfully!", $data = null)`
   Returns a response with a 200 OK status code, a success message, and optional data.
3. `success($message = "Request completed successfully!")`
   Returns a response with a 200 OK status code and a success message.
4. `withData($data, $message = "Data fetched successfully!")`
   Returns a response with a 200 OK status code, a success message, and the provided data.

### Method Chaining

You can chain methods together for more flexibility:

```php
// Return a success response with a custom status code and message
return JsonResponse::statusCode($myStatusCode)->success('Your message');

// Return a success response with a custom status code, header, and message
return JsonResponse::statusCode($myStatusCode)->withHeader($header)->success('Your message');
```

Please note that the `statusCode()` method will not affect the chaining when using the `created()` method.

### Success Response

```json
{
  "status": true,
  "message": "Your message",
  "data": {
    // ...
  }
}
```

### Available Error Methods

The following methods are available for returning error responses:

1. `badRequest($message = "Bad request!")`  
   Returns a response with a 400 Bad Request status code and an optional error message. This method is used to indicate a general "bad request" error.

2. `unauthenticated($message = 'Unauthenticated!')`
   Returns a response with a 401 Unauthorized status code and an optional error message. It is used to indicate that the user making the request is not authenticated.

3. `invalidRequest($message = 'Sorry! Required field is missing')`
   Returns a response with a 403 Forbidden status code and an optional error message. It is used to indicate that the request is invalid or does not meet the server's expectations.

4. `validationError($message = 'Sorry! Required field is missing')`
   Returns a response with a 422 Unprocessable Entity status code and an optional error message. It is used to indicate that the request data failed validation checks.

5. `notFound($message = 'Not found!')`
   Returns a response with a 404 Not Found status code and an optional error message. It is used to indicate that the requested resource was not found.

6. `internalError($message = 'Something went wrong!')`
   Returns a response with a 500 Internal Server Error status code and an optional error message. It is used to indicate that an unexpected internal server error occurred.

7. `error($message = 'Something went wrong!', int $statusCode = 500)`
   Returns a response with the specified status code and error message.

Please note that you can provide a custom error message for each error response if needed.

Feel free to adjust the method names and default error messages to better suit your application's needs.

### Chaining with error method

You can chain methods together for more flexibility:

```php
// Return a error response with a custom status code and message
return JsonResponse::statusCode($myStatusCode)->success('Your message');

// Return a error response with a custom status code, header, and message
return JsonResponse::withHeader($header)->error($message, 400);
```

Please note that the `statusCode()` method will affect only when chaining with `error()` method.

### Response

```json
{
  "status": false,
  "message": "Your message" // Message can contain any data type
}
```

### Customized Response

In addition to the provided methods, you can also return a customized JSON response using the `response()` method. This method allows you to specify the data, status code, and headers for the response.

```php
// Return a custom response with a custom status code and data
return JsonResponse::statusCode($myStatusCode)->response($array);

// Return a custom response with a custom status code, header, and data
return JsonResponse::statusCode($myStatusCode)->withHeader($header)->response($array);

```

### License
This package is open-source software licensed under the MIT license.

### Credits
This package is developed and maintained by Tofayel Hyder Abhi.