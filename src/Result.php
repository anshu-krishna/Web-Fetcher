<?php
namespace KrishnaFetch;

class Result {
	public function __construct(string $uri, ?array $params, array $headers, $response) {
		$this->uri = $uri;
		$this->params = $params;
		$this->header = $headers;
		$this->response = $response;
	}
}