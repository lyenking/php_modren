<?php

set_time_limit(0); //一个php脚本只能执行30秒

	function http_get($url,$data, $ssl = FALSE)
{
	$referer = "http://cn.office-converter.com/Convert-to-PDF";
	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	if($ssl)
	{
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
		//curl_setopt($curl, CURLOPT_SSLVERSION, 3);
	}
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	//curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
	curl_setopt ($curl,CURLOPT_REFERER,$referer);
	// post 请求
	curl_setopt($curl, CURLOPT_POST, 1);
	//POST 数据
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
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

function httpCurl($url, $method = "post", $ssl = false){
	$data = array(
		'filesurl' => 'http://www.u-club.cn/test.doc',
		'filessession' => '694728'
	);
	// start the curl
	$curl = curl_init();
	
	// set the url
	curl_setopt($curl,CURLOPT_URL,$url);
	if($ssl){
		// 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		
		// 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
	}
	
	// 模拟浏览器的请求
	curl_setopt($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
	
	// 设置 referer,自动设置为1，但爬虫手动设置为要请求的网站域名，避开盗链
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	if($method){
		// post 请求
		curl_setopt($curl, CURLOPT_POST, 1);
		//POST 数据
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	// 设置超时设置防止死循环
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	// 显示返回的Header区域内容
	curl_setopt($curl, CURLOPT_HEADER, 0);
	
	// 获取的信息以文件流的形式返回
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
	$info = curl_exec($curl);
	if (curl_errno($curl)) {
		return FALSE;
	}
	curl_close($curl); // 关闭CURL会话
	return $info; // 返回数据
}
$data = array(
		'filesurl' => 'http://www.u-club.cn/test.doc',
		'filessession' => '694728'
	);
$url = "http://cn.office-converter.com/files-url-process.php";
$res = http_get($url,$data);
var_dump($res);
?>