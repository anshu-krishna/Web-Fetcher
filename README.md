# Web Fetcher
Make GET or POST requests to any local or remote server. Primary goal is to be able to fetch data from REST APIs.

### Installation
```
composer require anshu-krishna/web-fetcher
```
Example:
```php
<?php
use Krishna\WebFetcher\Server;

/*
new Server(
	?string $protocal = null, // Default: http, Options: http, https
	?string $domain = null, // Default: Same as current domain
	?string $path = null, // Default: Same as current path
)
*/
$server = new Server();

/*
There are two ways to make a request:

$server->get(
	string $file,
	?array $params = null,
	?array $headers = null
): FetchResult

$server->post(
	string $file,
	?array $params = null,
	?array $headers = null
): FetchResult
*/

$result = $server->get('index.php', ['id' => 1]);

var_dump($result);

/*
FetchResult {
	string $uri, // URI of the request
	?array $params, // Parameters of the request
	array $headers, // Headers of the request and response
	$response, // Response of the request
	?string $error_msg // Error message if response is not received
}
*/
```