<?php

class curl
{
         function __construct($use = 1)
         {
         $this->ch = curl_init();
                 if($use = 1)
                 {
                         curl_setopt ($this->ch, CURLOPT_POST, 1);
                         curl_setopt ($this->ch, CURLOPT_COOKIEJAR, 'cookie.txt');
                         curl_setopt ($this->ch, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
                 }
                 else
                 {
                         return 'There is the possibility, that this script wont work';
                 }
         }
         function first_connect($loginform,$logindata)
         {
                 curl_setopt($this->ch, CURLOPT_URL, $loginform);
                 curl_setopt($this->ch, CURLOPT_POSTFIELDS, $logindata);
         }
         function store()
         {
                 $this->content = curl_exec ($this->ch);
         }
         function execute($page)
         {
                 curl_setopt($this->ch, CURLOPT_URL, $page);
                 $this->content = curl_exec ($this->ch);
         }
         function close()
         {
                 curl_close ($this->ch);
         }

         function __toString()
         {
         return $this->content;
         }

         function upload($file)
         {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
            curl_setopt($this->ch, CURLOPT_URL, 'http://uploadsite.com/index.php?act=files&do=upload');
            $postdata = array("file[]" => "@/".realpath($file));
            echo $postdata;
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postdata);
            curl_exec ($this->ch);
         }
}


$getit = new curl();
$getit->first_connect('http://uploadsite.com/index.php?act=login&login=true','login=true&file_session=&email=xxx%40yahoo.de&password=xxx&upload=Login');
$getit->store();
$getit->execute('http://uploadsite.com/index.php?act=user&do=home');
$getit->upload('Sample.mp4');







?>