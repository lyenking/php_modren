<?php
set_time_limit(0); 

function word2html($wordname,$htmlname)
{
 //$wordname doc文档的路径 ，$htmlname 转换成html文件的路径
 $word = new COM("word.application") or die("Unable to instanciate Word");
 $word->Visible = 1;
 $word->Documents->Open($wordname);
 $word->Documents[1]->SaveAs($htmlname,8);
 $word->Quit();
 $word = null;
 unset($word);
}
$fn = "./test.doc";
$fhml = "./2.html";
word2html($fn,$fhml);

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

$html = http_get($fhml);
$re = '/\<o\:Pages\>.+\<\/o\:Pages\>/Us';
preg_match_all($re, $html, $res);
echo $res[0][0];
exit;
if(file_exists("78.files")){
	unlink("./78.files/filelist.xml");
	unlink("./78.files/header.html");
	rmdir("78.files");
}
exit;

?>