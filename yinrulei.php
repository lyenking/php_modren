<?php

// 空间类元素的引入

namespace beijing\chaoyang\wangjing;
class test{
	public static $name = "wangjing <br/ >";
	public function __construct(){
		echo "wANGJING";
	}
}
function f(){
	echo "use ruto";
}

namespace tianjin\binhai\taida;
class test{
	public static $name = "taida <br/>";
}

// 空间类元素的直接引用 (注意引用别名，避免冲突)
use beijing\chaoyang\wangjing\test as w_test;
echo w_test::$name;
echo test::$name;



