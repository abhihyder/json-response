# Changelog

## [3.0.1] - 2025-05-18

#### Fixed

* Corrected the `@method` docblock annotation for the `data()` method:

  ```php
  @method static \Illuminate\Http\JsonResponse data(array|object $data, string $message = "Data fetched successfully!")
  ```

  > Ensures accurate static analysis and IDE support.

---


## [3.0.0] - 2025-05-18
### Breaking Changes
- Removed the `withData()` method. Use the new `data()` method instead.
- Changed the JSON response key from `status` to `success` to improve clarity.
- Renamed internal property from `statusCode` to `httpStatusCode` to avoid naming conflicts.
- Method `statusCode()` now works with the new `httpStatusCode` property.

### Added
- Added the `data()` method for returning data responses with success status and message.

### Removed
- Completely removed the `withData()` method without deprecation.

### Notes
- Update all usages of `withData()` to use `data()` method.
- Update your code or clients expecting a `status` key in JSON response to expect `success` instead.
