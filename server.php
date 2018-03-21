<?php

go foo("1", 2+3, 777);

$server = new Server();
$server->run();

function __go($function_name, ...$args) {
	Log::info("start goroutine `$function_name()`");
	call_user_func_array($function_name, $args);
}

class Task extends Worker{

	private $connection;

	public function __construct($socket, $lock ) {
		$this->connection = $socket;
		$this->lock = $lock;
	}

	public function run() {

	 	$message = fread($this->connection, 1024);
	 	fputs ($this->connection, "HTTP/1.1 200 OK\n");
	 	fputs ($this->connection, "Content-Type:text/html; charset=utf-8\n\n");
	 	fputs ($this->connection, "Ok\n");
	 	fclose ($this->connection);

	 	Log::info('I have received that : '.$message);
	}
}

class Server {
	private $socket;

	private $port;

	public function __construct($port = 8080) {
		$this->port = $port;
	}

	public function run() {

		$lock = new Threaded();

		$socket = stream_socket_server("tcp://0.0.0.0:" . $this->port, $errno, $errstr);
  		if (!$socket) {
			Log::error("$errstr ($errno)");
  		}
  		else {

			$pool = new Pool(2);

			Log::info("Listen port {$this->port}");
			while ($conn = @stream_socket_accept($socket, 120)) {

				$task = new Task($conn, $lock);
				$pool->submit($task);

				Log::info(memory_get_usage());

				//$pool->collect(function($task) {
					//var_dump($task);
					//echo "done\n";
					//return true;
				//});
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
