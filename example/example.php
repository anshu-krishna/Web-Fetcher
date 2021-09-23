<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Example</title>
</head>
<?php
require_once 'vendor/autoload.php';
use KrishnaFetch\Server;

$req = ['server.php', [
	'msg' => 'hi',
	'null' => null,
	'bool' => false,
	// 'arr' => [1, [2, 3], false]
]];
$server = new Server();
?>
<body>
	<div>
		<span>GET</span>
		<pre><?php print_r($server->get(...$req)); ?></pre>
	</div>
	<div>
		<span>POST</span>
		<pre><?php print_r($server->post(...$req)); ?></pre>
	</div>
	<style>
		body {
			padding: 0;
			margin: 0;
			display: grid;
			gap: 0.5em;
			grid-template-columns: 1fr 1fr;
		}
		pre {
			white-space: pre-wrap;
		}
		span {
			display: block;
			font-weight: bold;
			font-size: 1.5em;
			text-align: center;
			border-bottom: 1px solid;
		}
		div {
			padding: 0.5em;
			border: 1px solid;
		}
	</style>
</body>
</html>