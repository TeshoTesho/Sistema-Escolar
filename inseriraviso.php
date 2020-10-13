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

      $login=$_SESSION['login'];
      $titulo=$_POST["titulo"];
      $descricao=$_POST["ds"];
      $date = date('Y-m-d');


       try{
        $solicita = mysqli_query($connect,"INSERT INTO `portal_etec`.`tb_avisos` (`cd_aviso`, `nm_titulo`, `ds_descricao`, `dt_data`, `cd_rm_user`) VALUES (NULL, '$titulo', '$descricao', '$date', '$login');");


        $verifica = mysqli_query($connect,"SELECT * FROM tb_avisos WHERE cd_rm_user = $login") or die("erro ao selecionar");
             while($Sol =mysqli_fetch_array($verifica)){
              $cdAviso=$Sol['cd_aviso'];
             }

         $verifica2 = mysqli_query($connect,"SELECT * FROM `tb_avisos` WHERE  `cd_aviso` ='$cdAviso' AND  `cd_rm_user` ='$login';");

         if (mysqli_num_rows($verifica2)<=0){
           echo"<script language='javascript' type='text/javascript'>alert('Erro ao adicionar o Aviso!');</script>";
            die();
          }else{
           setcookie("requerido","1");
            echo"<script language='javascript' type='text/javascript'>alert('Aviso adicionado com sucesso!');</script>";
            
          }
          header("Location: PortalSecretaria/1");
  }catch (Exception $e) {
      echo 'Exceção capturada: ',  $e->getMessage(), "\n";
  }
  }
             

  ?>
