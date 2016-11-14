<?php
function FormatHeader($url, $myIp = null,$xml = null)
{
 // 解悉url
 $temp = parse_url($url);
 $query = isset($temp['query']) ? $temp['query'] : '';
 $path = isset($temp['path']) ? $temp['path'] : '/';
 $header = array (
 "POST {$path}?{$query} HTTP/1.1",
 "Host: {$temp['host']}",
 "Content-Type: text/xml; charset=utf-8",
 'Accept: */*',
 "Referer: http://{$temp['host']}/",
 'User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1)',
 "X-Forwarded-For: {$myIp}",
 "Content-length: 380",
 "Connection: Close"
 );
 return $header;
}
$interface = 'http://localhost/test/header2.php';
$header = FormatHeader($interface,'10.1.11.1');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $interface);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置头信息的地方
curl_setopt($ch, CURLOPT_HEADER, 0); //不取得返回头信息
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
var_dump($result);
?>