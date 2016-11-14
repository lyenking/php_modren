<?php
set_time_limit(0); //一个php脚本只能执行30秒
// 基本原理：获得上传文件数据，移动文件到目标目录
// 简单如下
/*
$file = $_FILES['file']; // 得到传输的数据
$upload_path = "E:/xampp/htdocs/webobj/php_modern/upfile/";
if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
	echo "successfully ! ";
	
}else{
	echo "failed !";
}
*/

//echo "<pre>";var_dump($_SERVER);exit;

function word2html($wordname,$htmlname)
{
 $word = new COM("word.application") or die("Unable to instanciate Word");
 $word->Visible = 1;
 $word->Documents->Open($wordname);
 $word->Documents[1]->SaveAs($htmlname,8);
 $word->Quit();
 $word = null;
 unset($word);
}
$time = time();
//$htmlname = $_SERVER['DOCUMENT_ROOT'].'/upload_html/'.$time.'.html';
//word2html('E:/xampp/htdocs/webobj/php_modern/upfile/test-for -the-2003.docx','E:/xampp/htdocs/webobj/php_modern/upfile/78.html');
//exit;
//$ae=file_get_contents('http://cjy.webobj.net/php_modern/upfile/6.html');
//var_dump($ae);exit;



function http_get($url, $ssl = FALSE)
{
	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	if($ssl)
	{
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
		//curl_setopt($curl, CURLOPT_SSLVERSION, 3);
	}
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
	curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
	curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	$tmpInfo = curl_exec($curl); // 执行操作
	if (curl_errno($curl)) {
		var_dump(curl_error($curl));
		return FALSE;
	}
	curl_close($curl); // 关闭CURL会话
	return $tmpInfo; // 返回数据
}

$url = "http://cjy.webobj.net/php_modern/upfile/78.html";
//http://cjy.www.net/website/Public/img/geli.jpg
$html = http_get($url);
//<o:Pages>3</o:Pages>
$re = '/\<o\:Pages\>.+\<\/o\:Pages\>/Us';
preg_match_all($re, $html, $res);
var_dump($res);exit;
if(file_exists("78.files")){
	echo "ok";
	//rmdir("78.files");
	unlink("./78.files/filelist.xml");
	unlink("./78.files/header.html");
	rmdir("78.files");
}
//echo $res[0][0];
exit;




exit;

$file = $_FILES['file']; // 获得文件数据
$pos = strripos($file['name'],'.');
$file_name = substr($file['name'],0,$pos);
$file_ext = substr($file['name'],$pos+1);
if($file_ext == "doc"){
	$upload_path = "E:/xampp/htdocs/webobj/php_modern/upfile/";
	if(move_uploaded_file($file['tmp_name'],$upload_path.$file_name.'.docx')){
		echo "successfully ! ";
		
	}else{
		echo "failed !";
	}
}
echo "<pre/>";var_dump($file);exit;

// 安全判断
$name = $file['name'];
$type = substr($name,strrpos($name,'.')+1); // 获得文件后缀名
$types = strtolower($type); // 转化成小写

// 允许上传的文件
$allow_type = array('jpg','jpeg','gif','png');

//判断文件类型是否被允许上传
if(!in_array($types,$allow_type)){
	// 文件不允许上传
	echo "文件类型不符合";
	exit;
}

//判断是否是通过HTTP POST上传的
if(!is_uploaded_file($file['tmp_name'])){
  //如果不是通过HTTP POST上传的
  return ;
  exit;
}

$upload_path = "E:/xampp/htdocs/webobj/php_modern/upfile/";
if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
	echo "successfully ! ";
	
}else{
	echo "failed !";
}
//echo "<pre>";var_dump($file);exit;


