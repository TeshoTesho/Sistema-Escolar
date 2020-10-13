<?php 
ob_start();
session_start();
header('Content-Type: text/html;charset=utf-8');
     date_default_timezone_set('America/Sao_Paulo');
  require("conectdb.php");
    $login = $_SESSION["login"];

     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==1){
    header("Location: PortalSecretaria");
  }
?>
  <!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>

<body class="bg-dark">
<?php 
    $login = $_SESSION["login"];

     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==0){
  
$id=trim($_GET["id"]);

     date_default_timezone_set('America/Sao_Paulo');
	require("conectdb.php");


 
$idh=$id;
$sql = mysqli_query($connect,"SELECT * FROM  `tb_solicitacao` WHERE  `cd_solicitacao` ='$id'");
   $conta = mysqli_num_rows($sql);
   if ($conta <= 0) {
   header("Location: PortalAluno");
   }else if($conta>0){
	$deferindo= mysqli_query($connect,"UPDATE  `portal_etec`.`tb_solicitacao` SET  `ic_deferido` =  '3' WHERE  `tb_solicitacao`.`cd_solicitacao` =$id;");
	 echo"<script language='javascript' type='text/javascript'>alert('A solicitação do documento nº$idh foi cancelada');window.location.href='PortalAluno';window.close();</script>";
	}else{
    echo"<script language='javascript' type='text/javascript'>alert('Sua solicitação foi atualizada pela secretaria. Reveja a decisão!');window.location.href='PortalAluno';window.close();</script>";
	}}
?>	
</body>
</html>