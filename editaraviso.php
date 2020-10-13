<?php 
ob_start();
session_start();
header('Content-Type: text/html;charset=utf-8');
  require("conectdb.php");

       date_default_timezone_set('America/Sao_Paulo');
     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==1){

      $id=$_POST["ida"];
      $nmTitulo=$_POST["titulo"];
      $dsAviso=$_POST["ds"];
        $sql = mysqli_query($connect,"UPDATE  `portal_etec`.`tb_avisos` SET  `nm_titulo` =  '$nmTitulo',`ds_descricao` =  '$dsAviso' WHERE  `tb_avisos`.`cd_aviso` ='$id';");

         echo"<script language='javascript' type='text/javascript'>alert('O aviso foi alterado!');window.location.href='avisossecretaria';</script>";

         
  }
             

  ?>
