<?php

header('content-type:text/html;charset=utf8');
$url = "http://127.0.0.1:8080/gettest.php";
$data = array(
"file1"  => "@D:/1.jpg"  //（这里需要注意：不能上传临时地址，而只能是存在的物理绝对路径）
);
print_r(uploadByCURL($data,$url));

function uploadByCURL($post_data,$post_url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $post_url);
curl_setopt($curl, CURLOPT_POST, 1 );
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/4.0");
$result = curl_exec($curl);
$error = curl_error($curl);
return $error ? $error : $result;
}

exit;
Action_Upload();
function Action_Upload(){
    //$this->path_config();
    //exit();
    $furl="@E:\xampp\htdocs\webobj\php_modern\curl\curl_class\1.txt";
    //$url= "http://localhost/DemoIndex/curl_pos/";
    $url = "http://cjy.webobj.net/php_modern/curl/curl_class/getimg.php";
    upload_file_to_cdn($furl, $url);
}
function upload_file_to_cdn($furl,$url){
    //  初始化
    $ch = curl_init();
    // 要上传的本地文件地址"@F:/xampp/php/php.ini"上传时候，上传路径前面要有@符号
    $post_data = array (
      "upload" => $furl
    );
    //print_r($post_data);
    //CURLOPT_URL 是指提交到哪里？相当于表单里的“action”指定的路径
    //$url = "http://localhost/DemoIndex/curl_pos/";
    //  设置变量
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
    curl_setopt($ch, CURLOPT_HEADER, 0);//参数设置，是否显示头部信息，1为显示，0为不显示
    //伪造网页来源地址,伪造来自百度的表单提交
    curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com");
    //表单数据，是正规的表单设置值为非0
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);//设置curl执行超时时间最大是多少
    //使用数组提供post数据时，CURL组件大概是为了兼容@filename这种上传文件的写法，
    //默认把content_type设为了multipart/form-data。虽然对于大多数web服务器并
    //没有影响，但是还是有少部分服务器不兼容。本文得出的结论是，在没有需要上传文件的
    //情况下，尽量对post提交的数据进行http_build_query，然后发送出去，能实现更好的兼容性，更小的请求数据包。
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //   执行并获取结果
    curl_exec($ch);
    if(curl_exec($ch) === FALSE)
    {
      echo "<br/>"," cUrl Error:".curl_error($ch);
    }
    //  释放cURL句柄
    curl_close($ch);
    echo "aaa45";
}
function action_curl_pos(){
    var_dump($_FILES);
    $aa= move_uploaded_file($_FILES["upload"]["tmp_name"], "/wamp/tools/1.rar");
    if($aa){
      echo "11";
    }
}

exit;


/*
//$url = "http://127.0.0.1:8080/gettest.php";
$url = "http://cjy.webobj.net/php_modern/curl/curl_class/getimg.php";
$post_data = array ("username" => "bob","key" => "12345");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// post数据
curl_setopt($ch, CURLOPT_POST, 1);
// post的变量
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$output = curl_exec($ch);
curl_close($ch);
//打印获得的数据
print_r($output);

exit;
*/

$ch = curl_init();

//加@符号curl就会把它当成是文件上传处理
$data = array('img'=>'@/1.jpg');
curl_setopt($ch,CURLOPT_URL,"http://127.0.0.1:8080/gettest.php");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result = curl_exec($ch);
curl_close($ch);
echo json_decode($result);

exit;
$url = "http://127.0.0.1:8080/gettest.php";
 $post_data = array(
 "foo" => "bar",
 //要上传的本地文件地址
 "upload" => "@/curl_class/1.txt"
 );
$ch = curl_init();
 curl_setopt($ch , CURLOPT_URL , $url);
 curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch , CURLOPT_POST, 1);
 curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
 $output = curl_exec($ch);
 curl_close($ch);
 echo $output;
?>