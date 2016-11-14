<?php
// 命名空间的名字与目录没有关系
namespace beijing;
function test1(){
	echo "this is beijing namespace <br/>";
}
const host = "localhost";

test1();// 就近原则

namespace shanghai;
function test1(){
	echo "this is shanghai namespace <br/>";
}
const host = "127.0.0.2";


test1();// 就近原则

namespace tianjin;
function test1(){
	echo "this is shanghai tianjin <br/>";
}


test1();// 就近原则
//echo host; // 不能这样访问
\tianjin\test1(); // 通过命名空间名称
echo \beijing\host;