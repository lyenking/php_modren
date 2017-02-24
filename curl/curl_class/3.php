<?php
print_r($_POST);
echo '===file upload info:';
print_r($_FILES);
exit;
 echo var_export($_FILES,true);
 echo file_get_contents($_FILES['upload']['tmp_name']);
 copy($_FILES['upload']['tmp_name'], "./log_copy.txt");



?>