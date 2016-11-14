<?php

// 引入机制 use

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

// 在当前空间引入需要的空间
use beijing\chaoyang\wangjing;
echo wangjing\test::$name; // 通过限定名称(wangjing)访问
echo wangjing\f();
