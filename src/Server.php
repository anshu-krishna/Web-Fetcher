<?php
namespace KrishnaFetch;

class Server {
	protected
		$_base_uri = [],
		$_protocal;
	public function __construct(
		?string $protocal = null,
		?string $domain = null,
		?string $path = null
	) {
		$protocal = $protocal ?? 'http';
		switch($protocal) {
			case 'http':
			case 'https':
				break;
			default:
				$protocal = 'http';
				break;
		}
		$domain ??= $_SERVER['HTTP_HOST'];
		$path ??= dirname(parse_url($_SERVER['REQUEST_URI'])['path']);
		$this->_base_uri = "{$protocal}://{$domain}{$path}/";
		$this->_protocal = $protocal;
	}
	protected static function _normalize(array &$data) {
		foreach ($data as &$item) {
			if(is_array($item)) {
				static::_normalize($item);
			} elseif(is_bool($item)) {
				$item = $item ? 'true' : 'false';
			} elseif ($item === null) {
				$item = '';
			}
		}
	}
	protected static function _query(array $data) {
		static::_normalize($data);
		return http_build_query($data);
	}
	protected function _fetch(string $method, string $file, array $headers, ?array $params = null) : Result {
		$file = $this->_base_uri . $file;
		$context = ['method' => $method];
		if(count($headers) > 0) {
			$context['header'] = implode("\r\n", $headers);
		}
		if($params !== null) {
			if($method === 'POST') {
				$context['content'] = static::_query($params);
			} else {
				$file = $file . '?' . static::_query($params);
			}
		}
		$response = @file_get_contents(
			filename: $file,
			context: stream_context_create([$this->_protocal => $context])
		);
		if($response === false) {
			$response = null;
		}
		return new Result($file, $params, [
			'req' => $headers,
			'res' => $http_response_header
		], $response);
	}
	public function get(string $file, ?array $params = null, ?array $headers = null) : Result {
		return $this->_fetch('GET', $file, $headers ?? [], $params);
	}
	public function post(string $file, ?array $params = null, ?array $headers = null) : Result {
		$headers ??= [];
		if($params !== null) {
			$headers[] = 'Content-type: application/x-www-form-urlencoded';
		}
		return $this->_fetch('POST', $file, $headers, $params);
	}
}