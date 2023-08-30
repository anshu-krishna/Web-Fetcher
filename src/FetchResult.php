<?php
namespace Krishna\WebFetcher;

class FetchResult {
	public function __construct(
		public string $uri,
		public ?array $params,
		public array $headers,
		public $response,
		public ?string $error_msg,
	) {
	}
}