<?php
// 获得文件数据
$file = $_FILES['file'];
if(count($file['name']) > 11){
	echo "不能同时上传超过10张图片";
	exit;
} 

// 允许上传的文件
$allow_type = array('jpg','jpeg','gif','png');
foreach($file['name'] as $k => $v){
	$type = substr($v,strrpos($v,'.')+1); 
	$types = strtolower($type);
	if(!in_array($types,$allow_type)){
		// 文件不允许上传
		echo "文件类型不符合<br />";
		exit;
	}
}

$upload_path = "E:/xampp/htdocs/webobj/php_modern/upfile/img/";

//判断是否是通过HTTP POST上传的
foreach($file['tmp_name'] as $k => $v){
	if(!is_uploaded_file($v)){
	  //如果不是通过HTTP POST上传的
	  echo "非法操作<br />";
	  exit;
	}
	if(move_uploaded_file($v,$upload_path.$file['name'][$k])){
		$res = "successfully ! <br />";
	}else{
		echo "failed !";
		exit;
	}
}

echo $res;


