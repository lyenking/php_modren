<?php

// ppt convert to html
function pptTohtml(){
	$pptapp = new COM("PowerPoint.Application");
	$pptapp->Visible = TRUE;
	$strpath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
	//var_dump($strpath);exit; //E:\xampp\htdocs\webobj\php_modern\word
	$ppname = "mytest.ppt"; //ppt的位置

	// open document 
	$pptapp->Presentations->Open($strpath.'/'.$ppname);

	// save document
	$url = $strpath."/html/1.html";// 存放html的目录
	$pptapp->ActivePresentation->SaveAs($url,14);

	$pptapp->Quit;
	$pptapp = null;

}



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

function getPage(){
	$url = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.html";
	$newfile = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.txt";
	$result = rename($url, $newfile);
	
	$html = http_get($newfile);
	$re = '/\<o\:Slides\>.+\<\/o\:Slides\>/Us';
	preg_match_all($re, $html, $res);
	echo $res[0][0];
	//var_dump($res);
	exit;
	
	// 如果考虑内存压力，可以删除文件
	if(file_exists("78.files")){
		echo "ok";
		//rmdir("78.files");
		unlink("./78.files/filelist.xml");
		unlink("./78.files/header.html");
		rmdir("78.files");
	}
	//echo $res[0][0];
}

function getPagef(){
	$url = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.html";
	$newfile = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.txt";
	$html = file_get_contents($newfile);
	$re = '/\<o\:Slides\>.+\<\/o\:Slides\>/Us';
	preg_match_all($re, $html, $res);
	var_dump($res);exit;
	$result = rename($url, $newfile);
	if ($result == false)
	{
	echo '复制成功';
	}
	exit;
}

pptTohtml();
getPage();

?>