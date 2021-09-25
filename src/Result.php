<?php
namespace KrishnaFetch;

class Result {
	public function __construct(public string $uri, public ?array $params, public array $headers, public $response, $error) {
		if($response === null) {
			$this->error_msg = $error;
		}
	}
}