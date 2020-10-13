
<?php
$hostname = 'localhost';
$username ='root'; 
$senha = ''; 
$banco = 'portal_etec'; 

  $connect = mysqli_connect($hostname,$username,$senha,$banco);
  $connect -> set_charset("utf8");
?>