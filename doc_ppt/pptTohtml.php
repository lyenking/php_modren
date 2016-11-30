<?php

// ppt convert to html
function pptTohtml($ppname,$url){
	$pptapp = new COM("PowerPoint.Application");
	$pptapp->Visible = TRUE;
	//$strpath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
	//var_dump($strpath);exit; 
	//$ppname = "mytest.ppt"; //ppt的位置

	// open document 
	$pptapp->Presentations->Open($ppname);

	// save document
	//$url = $strpath."/html/1.html";// 存放html的目录
	$pptapp->ActivePresentation->SaveAs($url,14);

	$pptapp->Quit;
	$pptapp = null;

}

function http_get($url)
{
	$curl = curl_init(); 
	curl_setopt($curl, CURLOPT_URL, $url); 
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1); 
	curl_setopt($curl, CURLOPT_TIMEOUT, 30); 
	curl_setopt($curl, CURLOPT_HEADER, 0); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	$tmpInfo = curl_exec($curl); 
	if (curl_errno($curl)) {
		var_dump(curl_error($curl));
		return FALSE;
	}
	curl_close($curl); 
	return $tmpInfo; 
}

function getPage($url,$newfile){
	//$url = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.html";
	//$newfile = "E:/xampp/htdocs/webobj/php_modern/word/html/1.files/v3_document.txt";
	$result = rename($url, $newfile);
	
	$html = http_get($newfile);
	$re = '/\<o\:Slides\>.+\<\/o\:Slides\>/Us';
	preg_match_all($re, $html, $res);
	echo $res[0][0];
	exit;
}

pptTohtml($ppname,$url);
getPage($url,$newfile);

?>