<?php
set_time_limit(0); //一个php脚本只能执行30秒
//初始化
$ch = curl_init();

// 要上传的本地文件地址"@F:/xampp/php/php.ini"上传时候，上传路径前面要有@符号
//$furl = "@F:/xampp/php/php.ini";
$furl = "http://www.u-club.cn/test.doc";
$post_data = array (
    $myfile => array(
    	$furl,$furl,$furl
    ),

);

//CURLOPT_URL 是指提交到哪里？相当于表单里的“action”指定的路径
$url = "http://cn.office-converter.com/OnlinePHP/upload.php";

$headers = array();
$headers[] = 'X-Apple-Tz: 0';
$headers[] = 'X-Apple-Store-Front: 143444,12';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Encoding: gzip, deflate';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Cache-Control: no-cache';
$headers[] = 'Content-Type: multipart/form-data; charset=utf-8';
$headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0';
$headers[] = 'X-MicrosoftAjax: Delta=true';



//设置变量
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
curl_setopt($ch, CURLOPT_HEADER, 0);//参数设置，是否显示头部信息，1为显示，0为不显示
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//伪造网页来源地址,伪造来自百度的表单提交http://www.baidu.com
curl_setopt($ch, CURLOPT_REFERER, "http://cn.office-converter.com/Convert-to-PDF");//referer伪造设置

//表单数据，是正规的表单设置值为非0
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_TIMEOUT, 131);//设置curl执行超时时间最大是多少

//使用数组提供post数据时，CURL组件大概是为了兼容@filename这种上传文件的写法，
//默认把content_type设为了multipart/form-data。虽然对于大多数web服务器并
//没有影响，但是还是有少部分服务器不兼容。本文得出的结论是，在没有需要上传文件的
//情况下，尽量对post提交的数据进行http_build_query，然后发送出去，能实现更好的兼容性，更小的请求数据包。
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

//执行并获取结果
$output = curl_exec($ch);
if($output === FALSE)
{
    echo "<br/>","cUrl Error:".curl_error($ch);
}

//    释放cURL句柄
curl_close($ch);
var_dump($output);
exit;
/*
function shorturl() {
    $url = 'http://cn.office-converter.com/files-url-process.php';
    $data = array(
		'filesurl' => 'http://www.u-club.cn/test.doc',
		'filessession' => '538225'
	);
    $curlObj = curl_init();
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => TRUE, //使用post提交
        CURLOPT_RETURNTRANSFER => TRUE, //接收服务端范围的html代码而不是直接浏览器输出
        CURLOPT_TIMEOUT => 134,
        CURLOPT_POSTFIELDS => http_build_query($data), //post的数据
    );
    curl_setopt_array($curlObj, $options);
    $response = curl_exec($curlObj);
    curl_close($curlObj);
    return $response;
}
$result = shorturl();
$reg = '#[\'"](http:(//|\\/\\/)t\.cn((/|\\/)([^\'"/]+)(/|\\/)?|(/|\\/)))[\'"]#';
preg_match_all($reg, $result, $match);
var_dump($result);

exit;
*/
$data = array(
		'myfile' => array('http://www.u-club.cn/test.doc','http://www.u-club.cn/test.doc')
	);

$query = http_build_query($data); 

$options['http'] = array(
     'timeout'=>160,
     'method' => 'POST',
     'header' => 'Content-type:application/msword',
     'content' => $query
    );

$url = "http://cn.office-converter.com/OnlinePHP/upload.php";
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
var_dump($result);
echo $result;
?>