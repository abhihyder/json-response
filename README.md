## About Package
This simple package provides a minimalistic functionality for Laravel applications to return JSON responses for HTTP requests.

## Installing 
To install this package into your laravel application just run the following command:
```bash
composer require hyder/json-response
```

## Optional
The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:

```php
'providers' => [
    // ...
    Hyder\JsonResponse\JsonResponseServiceProvider::class,
];
```

## Uses
There are few methods available to return JSON responses. Before using these methods you have to add this line:

```php
use Hyder\JsonResponse\Facades\JsonResponse;
```

### Available success methods
```php
return JsonResponse::success('Your message'); // Message is optional. Status Code: 200
```
```php
return JsonResponse::created('Your message', $yourData); // Message and data are optional. Status Code: 201
```
```php
return JsonResponse::updated('Your message', $yourData); // Message and data are optional. Status Code: 200
```
```php
return JsonResponse::withData($yourData, 'Your message'); // Message is optional. Status Code: 200
```

### Method chaining
You can chain methods together

```php
    return JsonResponse::statusCode($myStatusCode)->success('Your message');
```
or

```php
    return JsonResponse::statusCode($myStatusCode)->withHeader(array $header)->success('Your message');
```
#### Note that the statusCode() method will not effect when chaining with created method or any available error methods

### Response 

```json
    {
        status : true,
        message : 'Your message',
        data : {
            // ...
        }
    }
```

### Available error methods
```php
return JsonResponse::badRequest('Your message'); // Message is optional. Status Code: 400
```
```php
return JsonResponse::unauthenticate('Your message'); // Message is optional. Status Code: 401
```
```php
return JsonResponse::invalidRequest('Your message'); // Message is optional. Status Code: 403
```
```php
return JsonResponse::notFound('Your message'); // Message is optional. Status Code: 404
```
```php
return JsonResponse::internalError('Your message'); // Message is optional. Status Code: 500
```

### Response 

```json
    {
        status : false,
        message : 'Your message', // Message can contain any data type
    }
```
