<?php
// "<pre>";var_dump($_FILES);
//$res = json_encode($_FILES);
//file_put_contents('./res.txt',$res);
//CURLFile curl_file_create ( string 上传文件的路径 [, string 文件的Mimetype [, string 文件名 ]] )
// 创建一个 cURL 句柄 
//$ch = curl_init('E:/xampp/htdocs/webobj/php_modern/curl/curl_class/3.php'); 
// 创建一个 CURLFile 对象 
//$cfile = curl_file_create('./1.jpg','image/jpeg','test_name'); 
// 设置 POST 数据 
//$data = array('test_file' => $cfile); 
//curl_setopt($ch, CURLOPT_POST,1); 
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
// 执行句柄 
//curl_exec($ch);
/*
$post_data = array(
"media"=>"E:/xampp/htdocs/webobj/php_modern/curl/curl_class/1.jpg"
);
$url="E:/xampp/htdocs/webobj/php_modern/curl/curl_class/3.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
ob_start();
curl_exec($ch);
$result = ob_get_contents() ;
ob_end_clean();

echo $result;
*/

/*
 $url = "E:/xampp/htdocs/webobj/php_modern/curl/curl_class/3.php";
 $post_data = array(
 "foo" => "bar",
 //要上传的本地文件地址
 "upload" => "@/3.txt"
 );
$ch = curl_init();
 curl_setopt($ch , CURLOPT_URL , $url);
 curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch , CURLOPT_POST, 1);
 curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
 $output = curl_exec($ch);
 curl_close($ch);
 echo $output;
*/

//模拟POST上传文件  
$file = '/1.txt';
$ch = curl_init();
$post_data = array(
    'loginfield' => 'username',
    'username' => 'ybb',
    'password' => '123456',
'file' => '@E:/xampp/htdocs/webobj/php_modern/curl/curl_class/3.txt'
);
curl_setopt($ch, CURLOPT_HEADER, false);
//启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
curl_setopt($ch, CURLOPT_POST, true);  
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
curl_setopt($ch, CURLOPT_URL, 'http://www.b.com/handleUpload.php');
$info= curl_exec($ch);
curl_close($ch);
   
print_r($info);

?>