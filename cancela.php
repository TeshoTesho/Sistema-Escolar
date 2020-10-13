
<?php
header('Content-Type: text/html;charset=utf-8');
ob_start();
session_start();

     date_default_timezone_set('America/Sao_Paulo');
  require("conectdb.php");
    $login = $_SESSION["login"];

     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>

</head>
<body class="bg-dark">
  <?php

$idh=$_GET['v']; 
$id=hexdec($idh);
  $sql = mysqli_query($connect,"SELECT * FROM  `tb_solicitacao` WHERE  `cd_solicitacao` ='$id'");
   $conta = mysqli_num_rows($sql);
   if ($conta <= 0) {
    echo '<h3>Não Há solicitações nesse momento!</h3>';
   }else {
      while ($res = mysqli_fetch_array($sql))
       {        
    $CdUser=$res['cd_rm_user'];
      $cdSolicita=$res['cd_solicitacao'];
      $dsSolicitacao=$res['ds_solicitacao'];
        $ic_deferido=$res['ic_deferido'];
        $cdDocumento=$res['cd_documento'];
    $dtSolicitado=$res['dt_solicitacao'];
	   }
	   if($ic_deferido==3||$ic_deferido==0||$ic_deferido==1){
		    echo"<script language='javascript' type='text/javascript'>alert('Essa Solicitação não pode ser cancelada, verifique se a mesma foi deferida/indeferida ou mesmo cancelada anteriormente');window.close();</script>";
	
	   }else{
	   $te=$_SESSION["login"];
	if($te==$CdUser){
	
     // Aluno
     $Aluno = mysqli_query($connect,"SELECT * FROM tb_usuario WHERE cd_rm_user = '$CdUser'") or die("erro ao selecionar");
   
    while($Al =mysqli_fetch_array($Aluno)){ 
      $nmAluno=$Al['nm_user'];
      $cd=$Al['cd_rm_user'];
    $RgUser=$Al['cd_rg'];
    }

   // User Turma
   $userT = mysqli_query($connect,"SELECT * FROM usuario_turma WHERE cd_rm_user = '$cd'") or die("erro ao selecionar");

   while($uT =mysqli_fetch_array($userT)){
    $cdTurma=$uT['cd_turma'];

    // Turma
     $Turma = mysqli_query($connect,"SELECT * FROM tb_turma WHERE cd_turma = '$cdTurma'") or die("erro ao selecionar");
   
    while($Tr2 =mysqli_fetch_array($Turma)){ 
      $nmTurma=$Tr2['nm_turma'];
      $cdCurso=$Tr2['cd_curso'];
      $cdPeriodo=$Tr2['cd_periodo'];
    }}
    //Periodo
    $Periodo = mysqli_query($connect,"SELECT * FROM tb_periodo WHERE cd_periodo = '$cdPeriodo'") or die("erro ao selecionar");

         while($Pp =mysqli_fetch_array($Periodo)){ 
          $nmPeriodo=$Pp['nm_periodo'];
        }
        //Curso
    $Curso = mysqli_query($connect,"SELECT * FROM tb_curso WHERE cd_curso = '$cdCurso'") or die("erro ao selecionar");
      while($Cc =mysqli_fetch_array($Curso)){ 
        $nmCurso=$Cc['nm_curso'];
        }

        //Documento

     $Documento = mysqli_query($connect,"SELECT * FROM  `tb_documento` WHERE  `cd_documento` ='$cdDocumento'") or die("erro ao selecionar");
   
    while($Do =mysqli_fetch_array($Documento)){ 
      $nmDocumento=$Do['nm_documento']; }?>
   <form action="detalhes?id=$id" method="get" id="form1" name="id">
  <div class="p-0 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Documento: <?php echo $nmDocumento; ?></h4>
              <a class="card-text p-y-1"><b>Aluno:</b> <?php echo $nmAluno; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Curso: </b> <?php echo $nmCurso; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Periodo: </b><?php echo $nmPeriodo; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Turma: </b><?php echo $nmTurma; ?></a>
              <br>
              <a class="card-text p-y-1"><b>RG:</b> <?php echo $RgUser; ?></a>
              <br>
              <br>
              <a class="card-text p-y-1"><b>Documento:</b> <?php echo $nmDocumento; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Observação: </b> <?php echo $dsSolicitacao; ?>.</a>
              <br>
              <a class="card-text p-y-1"><b>Data: </b><?php echo date('d/m/Y', strtotime($dtSolicitado)); ?></a>
              <br>
              <br>
              <?php echo "<a href='cancelar.php?id=$id' class='card-link text-danger'><b>Cancelar Solicitação</b></a>";?>
            </div>
          </div>
          <p class="lead p-0"></p>
        </div>
      </div>
    </div>
  </div>
</form>
      <?php 
          
          
		    }else{
			header("Location:login");}
	   }
   }
 
   
         
      ?>

  </body>
</html>