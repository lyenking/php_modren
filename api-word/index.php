<?php

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
$url = "http://wordtopdf.55.la/";
$res = httpCurl($url);
echo "<pre>";var_dump($res);exit;


$curl = file_get_contents("http://wordtopdf.55.la/");
echo "<pre>";var_dump($curl);exit;


$as = file_get_contents("http://61.142.254.57:98/api/down.aspx?id=386B774FE353BB7AE4EBDAE863080E65");
file_put_contents('./1.pdf',$as);
echo "ok";exit;
$pages = 0;

try {
	$fp=@fopen($as,"r");
    if (!$fp) {
        return $pages;
    }else {
        $max=0;
        while(!feof($fp)) {
            $line = fgets($fp,255);
            
            if (preg_match('/\/Count [0-9]+/', $line, $matches)){
            	var_dump($matches);exit;
                preg_match('/[0-9]+/',$matches[0], $matches2);
                if ($max<$matches2[0]) $max=$matches2[0];
            }
        }
        fclose($fp);
        // 返回页数
        $pages = $max;
    }
} catch(Exception $e) {}

echo $pages;
