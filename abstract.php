<?php

/*
抽象类：
概念：一个物体的一种大的描述，这种描述对某类物体来说是共有的特性。这个类应该是一个模板，它指示它的子方法必须要实现的一些行为。

PHP抽象类应用的定义：
abstract class ClassName{

}

1、PHP抽象类应用要点：

　　1.定义一些方法，子类必须完全实现这个抽象中所有的方法

　　2.不能从抽象类创建对象，它的意义在于被扩展

　　3.抽象类通常具有抽象方法，方法中没有大括号

2、PHP抽象类应用重点：

　　1.抽象方法不必实现具体的功能，由子类来完成

　　2.在子类实现抽象类的方法时，其子类的可见性必须大于或等于抽象方法的定义

　　3.抽象类的方法可以有参数，也可以为空

　　4.如果抽象方法有参数，那么子类的实现也必须有相同的参数个数

PHP抽象类应用示例：
abstract public function_name(); //注意没有大括号


PHP抽象类规则：

    某个类只要至少含有一个抽象方法，就必须声明为抽象类
    抽象方法，不能够含有函数体
    继承抽象类的子类，实现抽象方法的，必须跟该抽象方法具有相同或者更低的访问级别
    继承抽象类的子类，如果不实现所有抽象方法，那么该子类也为抽象类

*/
// 抽象类
abstract class Shape{
	// 矩形面积
	abstract protected function get_area(); // 不能有大括号（方法体）
	//不能创建这个抽象类的实例：$Shape_Rect= new Shape();
}

//子类继承抽象类，并实现抽象类的所有方法
class Rectangle extends Shape{
	private $width;
	private $height;
	public function __construct($width = 0 ,$height = 0){
		$this->width = $width;
		$this->height = $height;
	}
	
	public function get_area(){
		$res = $this->width * $this->height;
		echo $res;
	}
}

$cube = new Rectangle(12,5);
$cube->get_area();

?>