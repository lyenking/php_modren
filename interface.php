<?php

// 接口
interface Dome1{
	const NAME = 'CJY';
	const AGE = '22';
	function test1();
	function test2();
}

interface Dome2 extends Dome1{
	function test3();
	function test4();
}

class doit implements Dome2{
	function test1(){
		echo "test1";
	}
	function test2(){
		echo "test2";
	}
	function test3(){
		echo "test3";
	}
	
	function test4(){
		echo "test4";
	}
}

$res = new doit();
echo $res->test1();
echo $res->test2();
echo $res->test3();
echo $res->test4();

?>