<!DOCTYPE html>
<html>
<head>
  <title></title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> 
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">


         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php 
ob_start();
session_start();
header('Content-Type: text/html;charset=utf-8');
     date_default_timezone_set('America/Sao_Paulo');
	require("conectdb.php");

    $login = $_SESSION["login"];
  $obs=$_POST["obssecretaria"];
  $id=trim($_POST["id"]);
  
     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==1){
 
	switch (get_post_action('deferir', 'indeferir')) {
    case 'indeferir':

    	$indeferindo= mysqli_query($connect,"UPDATE  `portal_etec`.`tb_solicitacao` SET  `ic_deferido` =  '0',`ds_obs_secretaria` =  '$obs' WHERE  `tb_solicitacao`.`cd_solicitacao` =$id;");
      ?>
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"     data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Indeferido!</h4>
                       
                      
                    </div>
                    <div class="modal-body">
                      <?php
                      echo "<p>A solicitação do documento nº$id foi indeferida!</p>";
                      ?>
                     </h5>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="alterarsenha"><button type="button" class="btn btn-danger">Ok!</button></a>
                    </div>
                </div>
            </div>
        </div>
      <?php
        break;

    case 'deferir':

    	$deferindo= mysqli_query($connect,"UPDATE  `portal_etec`.`tb_solicitacao` SET  `ic_deferido` =  '1',`ds_obs_secretaria` =  '$obs' WHERE  `tb_solicitacao`.`cd_solicitacao` =$id;");
      ?>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"     data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Deferido!</h4>
                       
                      
                    </div>
                    <div class="modal-body">
                        <p> <?php echo("<p>A solicitação do documento nº$id foi deferida!</p>"); ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="portal"><button type="button" class="btn btn-success">Ok!</button></a>
                    </div>
                </div>
            </div>
        </div>
      <?php
        break;

    default:

    echo"<script language='javascript' type='text/javascript'>window.location.href='PortalSecretaria';</script>";


}
?>

 <script>
          $(document).ready(function(){
            $('#myModal').modal('show');
          });
        </script>
<?php
	}else{
		header("Location:index");
	}

              function get_post_action($name)
                {
                  $params = func_get_args();
                   foreach ($params as $name) {
                     if (isset($_POST[$name])) {
                 return $name;
                         }
                       }
                    }
?>	