<?php
var_dump($_FILES);
    $aa= move_uploaded_file($_FILES["upload"]["tmp_name"], "/2.jpg");
    if($aa){
      echo "11";
    }
//var_dump($_POST);
exit;
if($_FILES){
$filename = $_FILES['img']['name'];
$tmpname = $_FILES['img']['tmp_name'];
if(move_uploaded_file($tmpname,dirname(__FILE__).'/upload/'.$filename)){
echo json_encode('上传成功');
}else{
$data = json_encode($_FILES);
echo $data;
}
}else{
	echo "nononm";
}


?>