<?php

$data = array(
    'input_file[0]' => new CURLFile('E:/xampp/htdocs/webobj/php_modern/curl/curl_class/1.txt', 'text/plain', 'testfile.txt'),
    'input_file[1]' => new CURLFile('E:/xampp/htdocs/webobj/php_modern/curl/curl_class/2.txt', 'text/plain'),
    'input_file[2]' => new CURLFile('E:/xampp/htdocs/webobj/php_modern/curl/curl_class/3.txt', 'text/plain'),
);
    $ch = curl_init('E:/xampp/htdocs/webobj/php_modern/curl/curl_class/2.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
	echo $res;


?>