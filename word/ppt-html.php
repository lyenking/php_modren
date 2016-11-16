<?php

$url = "E:/xampp/htdocs/webobj/php_modern/word/html/2.files/v3_document.html";
$newfile = "E:/xampp/htdocs/webobj/php_modern/word/html/2.files/v3_document.txt";
$result = rename($url, $newfile);
if ($result == false)
{
echo '复制成功';
}
$html = file_get_contents($newfile);
$re = '/\<o\:Slides\>.+\<\/o\:Slides\>/Us';
preg_match_all($re, $html, $res);
echo $res[0][0];exit;
exit;



// ppt convert to html
$pptapp = new COM("PowerPoint.Application");
$pptapp->Visible = TRUE;
$strpath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
//var_dump($strpath);exit; //E:\xampp\htdocs\webobj\php_modern\word
$ppname = "mytest.ppt";
$fileName = "/MyPP/";

//** open document **/
$pptapp->Presentations->Open($strpath.'/'.$ppname);

// save document
$url = $strpath."/html/2.html";
$pptapp->ActivePresentation->SaveAs($url,14);

$pptapp->Quit;
$pptapp = null;
echo "<a href='".$url."'>Click here</a>";
exit;

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

$url = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.txt"; 
echo file_get_contents($url);
exit;
$html = http_get($url);
var_dump($html);exit;
$re = '/\<o\:Slides\>.+\<\/o\:Slides\>/Us';
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




?>