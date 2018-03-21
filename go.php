<?php

function __go($function_name, ...$args) {
	global $_tm;
	if (!$_tm) {
		$_tm  = new TaskManager();
	}

	$_tm->add(function() use ($function_name, $args) {
		call_user_func_array($function_name, $args);
	});
}

class TaskManager 
{
	public function __construct() {
		Log::info("create new pool");
		$this->pool = new Pool(40);
	}

	public function add($clb) {
		$this->pool->submit(new Task($this, $clb));
	}
}

class Task extends Worker {

	public function __construct($tm, $clb) {
		$this->clb = $clb;
		$this->tm = $tm;
	}
	
	public function run() {
		global $_tm;
		if (!$_tm) {
			$_tm = $this->tm;
		}

		$clb = $this->clb;
		$clb();
	}
}

