<?php


$title = "PHP生成doc文件";
$html  = '<h1>PHP生成doc文件-老吧博客</h1>
<p>php生成doc格式的word文档还是比较简单的, 主要就是注意创建中文名文件容易出错, 创建前先用iconv转换一下就可以了.</p>
<p>php生成doc格式的word文档还是比较简单的, 主要就是注意创建中文名文件容易出错, 创建前先用iconv转换一下就可以了.</p>
<p>使用方法比较简单, 直接输出就行了: echo cword($data, filename) </p>
<p>使用方法比较简单, 直接输出就行了: echo cword($data, filename) </p>
<p>本段程序由<a href="http://www.lao8.org">老吧博客</a>提供:</p>';
  
  
  
//使用方法-------------------------
echo (cword($html,iconv("UTF-8","GB2312//IGNORE",$title))); //转换中文并忽视错误
//----------------------------------------
  
function cword($data,$fileName='')
{
    if(empty($data)) return '';
  
    $data = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">'.$data.'</html>';
    $dir  = "./docfile/".date("Ymd")."/";
  
    if(!file_exists($dir)) mkdir($dir,777,true);
  
    if(empty($fileName))
    {
        $fileName=$dir.date('His').'.doc';
    }
    else
    {
        $fileName =$dir.$fileName.'.doc';
    }
  
    $writefile = fopen($fileName,'wb') or die("创建文件失败"); //wb以二进制写入
    fwrite($writefile,$data);
    fclose($writefile);
    return $fileName;
}

?>