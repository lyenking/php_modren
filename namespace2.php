<?php
// 多级空间（子级空间）

/**
* @  三种方式访问空间元素
* 非限定名称     echo test::$name;  
* 限定名称(前面不带\)       tianjin\binhai\taida\test::$name;
* 完全限定名称      \tianjin\binhai\taida\test::$name;
*/

namespace beijing\chaoyang\wangjing;
class test{
	public static $name = "wangjing <br/ >";
	public function __construct(){
		echo "wANGJING";
	}
}

namespace tianjin\binhai\taida;
class test{
	public static $name = "taida <br/>";
}

echo test::$name; // 就近原则

echo \tianjin\binhai\taida\test::$name;

echo \beijing\chaoyang\wangjing\test::$name;
$w1 = new \beijing\chaoyang\wangjing\test();


