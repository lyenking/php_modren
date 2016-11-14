<?php

/*
	PHP5.4后新增traits实现代码复用机制，Trait和类相似，但不能被实例化，
	无需继承，只需要在类中使用关键词use引入即可，可引入多个Traits，用','隔开。
	
	优先级问题
		Trait会覆盖继承的方法，当前类会覆盖Trait方法。


	多个Trait冲突问题
		如果没有解决冲突，会产生致命错误；
		可用insteadof来明确使用冲突中哪一个方法；
		可用as操作符将其中一个冲突方法另起名；

*/


trait A {
    public function test() {
        echo 'A::test()';
    }
}
 
trait B {
    public function test() {
        echo 'B::test()';
    }
}
 

trait  HelloWorld  {
    public function  sayHello () {
        echo  'Hello World!' ;
    }
}
 
 
class C {
	// 修改 sayHello 的访问控制
	use  HelloWorld  {  sayHello  as protected; }
    use A,B {
        B::test insteadof A;
        B::test as t;
    }
}
 
$c = new C();
$c->test(); //B::test()
$c->t(); //B::test()
