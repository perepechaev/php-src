<?php

go foo("1", 2+3, 777);

$server = new Server();
$server->run();

function __go($function_name, ...$args) {
	Log::info("start goroutine `$function_name()`");
	call_user_func_array($function_name, $args);
}

class Server {
	private $socket;

	private $port;

	public function __construct($port = 8080) {
		$this->port = $port;
	}

	public function run() {

		$socket = stream_socket_server("tcp://0.0.0.0:" . $this->port, $errno, $errstr);
  		if (!$socket) {
    		Log::error("$errstr ($errno)");
  		}
  		else {
			Log::info("Listen port {$this->port}");
    		while ($conn = @stream_socket_accept($socket, 120)) {
     			$message= fread($conn, 1024);
     			Log::info('I have received that : '.$message);
     			fputs ($conn, "HTTP/1.1 200 OK\n");
     			fputs ($conn, "Content-Type:text/html; charset=utf-8\n\n");
     			fputs ($conn, "Ok\n");
     			fclose ($conn);

			Log::info(memory_get_usage());
    		}
    		fclose($socket);
			Log::info("Connection was closed");
  		}
	}
}

class Log {
	static public function info($message) {
		echo "\033[0;36m$message\033[0m\n";
	}

	static public function error($message) {
		echo "\033[0;31m$message\033[0m\n";
	}
}
