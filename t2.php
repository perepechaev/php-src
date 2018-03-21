<?php

"42";

function foo($a, $b, $c) {
	echo "\033[0;36mfoo()\033[0m\n";
	var_dump($a, $b, $c);
	return 42;
}



go foo("1", 2+3, 777);










function __go($function_name, ...$args) {
	echo "\033[0;32mstart()\033[0m\n";
	call_user_func_array($function_name, $args);
}

func hello() {
	var_dump("HELLO");
}

hello();

функция привет(){
	echo "привет\n";
}

привет();

/*
class A {
	static public function foo(){
		return 42;
	}
}
*/

//go A::foo(4, 5);

