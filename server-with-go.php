<?php

require "go.php";

function tick($sleep) {
	Log::error("start $sleep");
	while (true) {
		sleep($sleep);
		Log::error("wake up $sleep");
	}
}

function create_routine_in_loop($cnt) {
	Log::info("create_routine_in_loop runned for sleep to 10 seconds");
	for ($i = 1; $i <= $cnt; $i++) {
		go tick($i);
	}
	Log::info("done");
}

go tick(1);
go tick(2);
go tick(3);
go tick(4);
go tick(5);
go tick(6);
go tick(7);
go tick(8);
go sleep(100);
Log::info("done");
die;




class Log {
	static public function info($message) {
		echo "\033[0;36m$message\033[0m\n";
	}

	static public function error($message) {
		echo "\033[0;31m$message\033[0m\n";
	}
}
