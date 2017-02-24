<?php
	function httpRequest($url,$method,$params=array()){
		$method=strtolower($method);
		if(trim($url)==''||!in_array($method,array('get','post'))||!is_array($params)){
			return false;
		}
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HEADER,0 ) ;
		switch($method){
			case 'get':
				$str='?';
				foreach($params as $k=>$v){
					$str.=$k.'='.$v.'&';
				}
				$str=substr($str,0,-1);
				$url.=$str;//$url=$url.$str;
				curl_setopt($curl,CURLOPT_URL,$url);
				$result='';
			break;
			case 'post':
				//judge the upload file method
			    if (class_exists('CURLFile')) {//new method
    				curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
				} elseif (defined('CURLOPT_SAFE_UPLOAD')) {//may be defined in old method.
        			curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
    			}
				curl_setopt($curl,CURLOPT_URL,$url);
				curl_setopt($curl,CURLOPT_POST,1 );
				curl_setopt($curl,CURLOPT_POSTFIELDS,$params);
				curl_setopt($curl, CURLOPT_TIMEOUT, 1);
				$result='';
			break;
			default:
				$result='';
			break;
		}
		if(isset($result)){
			$result=curl_exec($curl);
		}
		//echo 'Here is some more debugging info:'.curl_error($curl);
		curl_close($curl);
		return $result;
	}

    if (! empty($_POST["JOBID"])){
      $JobID = $_POST["JOBID"];
    }
    else{
      $JobID = $_GET["JobID"];
    }

   	$ScriptDir=dirname($_SERVER['SCRIPT_FILENAME']);
    $uploaddir = $ScriptDir.'/MIBPBRun/';

    //mission completed
	if (file_exists($uploaddir.$JobID."/Result_$JobID.zip")){
		echo "<script>window.location='http://localhost/wei/mibpb2.php?software=mibpb&JobID=$JobID';</script>";
	}
	//start asyn-job by curl.
	elseif (!file_exists($uploaddir.$JobID)){
		$uploadfile = $uploaddir . basename($_FILES['files']['name']);
		//copy the upload file from tmp path to local path
		if (move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
    		;//echo "File is valid, and was successfully uploaded.\n";
		} else {
    		echo "Possible file upload error!<br>";
		}

		//judge the upload file class
		if (class_exists('CURLFile')) {//new method.
    		$_POST['files'] = curl_file_create($uploadfile,$_FILES['files']['type'],$_FILES['files']['name']);
		} else {
    		$_POST['files'] = '@' . $uploadfile;//old method.
		}

		//use curl to submit job and stop
    	httpRequest("http://localhost/wei/mibpb2.php?JobID=$JobID",'POST',$_POST,$uploadfile);

		echo "Your Job ID: $JobID has been submitted!<br>Please wait or close your page and take your result later. ";
    	echo "<script>setTimeout('window.location.reload()',5000);</script>"; //指定5秒刷新一次
    	unlink($uploadfile);//enough time to upload?
    }
    //is still running
	elseif (file_exists($uploaddir.$JobID)){
		echo "Your Job ID: $JobID is still running....<br>Please wait or close your page and take your result later.";
    	echo "<script>setTimeout('window.location.reload()',5000);</script>"; //指定5秒刷新一次
	}
?>