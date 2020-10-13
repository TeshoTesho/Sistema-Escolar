
<?php
ob_start();
header('Content-Type: text/html;charset=utf-8');
session_start();
require("conectdb.php");

     date_default_timezone_set('America/Sao_Paulo');
  if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==0){
     header("Location:PortalAluno");
  }else{
  $login=$_SESSION['login'];

  
  
  
  $documento= $_POST['documento'];
  $texto=$_POST['Observacao'];
    $date = date('Y-m-d');
     try{
      $solicita = mysqli_query("INSERT INTO `portal_etec`.`tb_solicitacao` (`cd_solicitacao`, `dt_solicitacao`, `ds_solicitacao`, `ic_deferido`, `cd_rm_user`, `cd_documento`) VALUES (NULL, '$date',  '$texto', '2', '$login', '$documento');");


      $verifica = mysqli_query("SELECT * FROM tb_solicitacao WHERE cd_rm_user = $login") or die("erro ao selecionar");
           while($Sol =mysqli_fetch_array($verifica)){
            $cdSolicita=$Sol['cd_solicitacao'];
           }

       $verifica2 = mysqli_query("SELECT * FROM `tb_solicitacao` WHERE  `cd_solicitacao` ='$cdSolicita' AND  `cd_rm_user` ='$login';");

       if (mysqli_num_rows($verifica2)<=0){
         echo"<script language='javascript' type='text/javascript'>alert('Erro ao fazer requerimento');window.location.href='PortalAluno';</script>";
          die();
        }else{
         setcookie("requerido","1");
          echo"<script language='javascript' type='text/javascript'>alert('Documento solicitado com sucesso!');window.location.href='Requerimento';</script>";
          
        }
}catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}
}
           

?>
