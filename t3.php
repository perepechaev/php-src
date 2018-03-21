<?php


function foo() {
	echo "foo\n";
}

func bar() {
	echo "bar\n";
}

функция foobar(){
	foo();
	bar();
}

//foo();

//bar();

function go($name, $args...) {
	fork();

	$name($args...);
}

go foobar();
