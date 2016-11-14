<?php
header("Content_Type:text/xml");
set_time_limit(0); //一个php脚本只能执行30秒

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


	
	// curl
	function httpCurl($url, $method = false, $ssl = false){
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
	

$ae=file_get_contents('http://cjy.webobj.net/php_modern/curl/1.xml');
var_dump($ae);exit;
	
$url = "www.baidu.com";
//http://cjy.www.net/website/Public/img/geli.jpg
$html = httpCurl($url);
//$re = '/\<img(.+)src=("|\')(.+)\\1.*>/Us';
$re = '/\<img.*src=("|\')(.+)\\1.*>/Us';
preg_match_all($re, $html, $res);
foreach($res[2] as $k => $v){
	//echo "<br/>".strrchr($v,'/'); 字符串最后出现的位置开始取
	$imgName = ltrim(strrchr($v,'/'),'/');// 去除 /
	// 下载图片
	$img = httpCurl($url.$v);
	file_put_contents('./img/'.$imgName,$img);
}
var_dump($res);
exit;

?>