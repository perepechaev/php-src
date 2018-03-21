<?php

/*
function foo() {
	echo "foo\n";
}

func bar() {
	echo "bar\n";
}


функция привет() {
	показать "Привет\n";
}

функция фоо() {
	return "foo";
}

bar();
foo();
привет();

echo "===============\n\n\033[0;32m";
$a = go фоо();
var_dump($a);


//echo (go bar());

echo "\033[0m";

var_dump(go foo());
echo go foo();
//go фоо();

*/







function foo() {
	echo "i'm foo\n";
	return "\033[0;32mresponse\033[0m \n";
}

echo "== Run \033[0;35mgo foo();\033[0m           ==\n";
go foo();
echo "\n";

/*
echo "== Run \033[0;35mgo 'fuck';\033[0m          ==\n";
go "fuck";
echo "\n";
*/

echo "== Run \033[0;35mvar_dump(go foo());\033[0m ==\n";
var_dump(go foo());
echo "\n";


echo "== Run \033[0;35mecho go foo();\033[0m      ==\n";
echo go foo(); 
echo "\n";

/*
echo "== Run \033[0;35mvar_dump(go 'sss');\033[0m ==\n";
var_dump(go "ssss");
*/

echo "\n";
