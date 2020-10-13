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
  }else if($_SESSION["ic"]==0){
     header("Location:PortalAluno");
  }

$id=$_POST["ida"];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>

<body class="bg-dark">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index">Início</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Instituição</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cursos Técnicos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cursos ETIM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="https://vestibulinhoetec.com.br/">Vestibulinho</a>
          </li>
        </ul> <p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="logout">Sair da Secretaria
      <br> </a></p>
	  </div>
    </div>
   
  </nav>
  <div class="bg-dark py-3">
    <div class="container">
      <div class="row text-left">
        <div class="col-md-12">
          <img class="img-fluid d-block float-left" src="Img\logoetec2.png"> </div>
      </div>
    </div>
  </div>
  <div class="p-0 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills bg-dark text-secondary">
            <li class="nav-item bg-danger">
              <a href="PortalSecretaria" class="nav-link disabled text-white"> <i class="fa fa-home fa-home"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item">
              <a href="avisossecretaria" class="nav-link text-white">Avisos Acadêmicos</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link text-white">Alunos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Calendário</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container"> </div>
  </div>
  <div class="bg-light py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="">Requerimentos</h1>

<?php

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
    $cdTurma=$uT['cd_turma']; }

    // Turma
     $Turma = mysqli_query($connect,"SELECT * FROM tb_turma WHERE cd_turma = '$cdTurma'") or die("erro ao selecionar");
   
    while($Tr2 =mysqli_fetch_array($Turma)){ 
      $nmTurma=$Tr2['nm_turma'];
      $cdCurso=$Tr2['cd_curso'];
      $cdPeriodo=$Tr2['cd_periodo'];
    }
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
   <form action="deferir" method="POST" id="form1" name="id">
  <div class="p-0 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <p class="mb-0" style="bottom: 0px;text-align: right;">
                <a class="card-text p-y-1"><b>Protocolo nº: <?php echo $id; ?>
                </b></a>
                <input style="display: none;" type="textarea" name="id" value='<?php echo $id; ?>'>
              </p>
              <h4 class="card-title">Documento: <?php echo $nmDocumento; ?></h4>
              <br>
			  <a class="card-text p-y-1"><b>Aluno:</b> <?php echo $nmAluno; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Curso: </b> <?php echo $nmCurso; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Período: </b><?php echo $nmPeriodo; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Turma: </b><?php echo $nmTurma; ?></a>
              <br>
              <a class="card-text p-y-1"><b>RG:</b> <?php echo $RgUser; ?></a>
              <br>
              <br>
              <a class="card-text p-y-1"><b>Documento:</b> <?php echo $nmDocumento; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Observação do aluno: </b> <?php echo $dsSolicitacao; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Data: </b><?php echo date('d/m/Y', strtotime($dtSolicitado)); ?></a>
              <br>
                <br>
                <a class="card-text p-y-1"><b>Observação da Secretaria: </b>
                  
                </a>
                <textarea name="obssecretaria" class="form-control" id="Textarea" rows="3" placeholder="Digite aqui"></textarea>
              <br>
              <br>
              <input class="btn active btn-outline-success" type="submit" name="deferir" value="Deferir" />
              <input class="btn active btn-outline-danger" type="submit" name="indeferir" value="Indeferir" />
               <?php
              // echo "<a href='deferir?id=$id' class='card-link text-success'><b>Deferido</b></a>";
              //echo "<a href='indeferir?id=$id' class='card-link text-danger'><b>Indeferido</b></a>"; ?>
            </div>
          </div>
          <p class="lead p-0"></p>
        </div>
      </div>
    </div>
  </div>
</form>
     <br>    <?php     }} ?>

        </div>
      </div>
    </div>
  </div>
  <div class="bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="p-4 col-md-4">
          <h2 class="mb-4 text-secondary">ETEC Sede</h2> <i class="d-block mx-auto fa fa-map-marker fa-2x"></i>
          <p class="text-white">Avenida Guadalajara, nº 941&nbsp;
            <br>Guilhermina&nbsp;
            <br>Praia Grande - SP</p>
          <p>
            <a href="tel:+246 - 542 550 5462" class="text-white"><i class="fa d-inline mr-3 text-secondary fa-phone"></i>(13) 3491-3153</a>
          </p>
          <p>
            <a href="tel:+246 - 542 550 5462" class="text-white"><i class="fa d-inline mr-3 text-secondary fa-phone"></i>(13) 3491-1585</a>
          </p>
        </div>
        <div class="p-4 col-md-4">
          <h2 class="mb-4 text-secondary">ETEC extensão</h2> <i class="d-block mx-auto fa fa-map-marker fa-2x"></i>
          <p class="text-white">Avenida Doutor Roberto de Almeida Vinhas, nº 10.119
            <br>Balneário Maracanã&nbsp;
            <br>Praia Grande - SP</p>
          <p>
            <a href="tel:+246 - 542 550 5462" class="text-white"><i class="fa d-inline mr-3 text-secondary fa-phone"></i>(13) 3471-2395</a>
          </p>
        </div>
        <div class="p-4 col-md-4">
          <h2 class="mb-4">Contato:</h2>
          <p>
            <a href="mailto:etec@etec.com" class="text-white"><i class="fa d-inline mr-3 text-secondary fa-envelope-o fa-lg"></i>etec@etec.com</a>
          </p>
          <div class="align-self-center col-12 my-4 col-md-12">
            <a href="https://www.facebook.com" target="blank"><i class="fa fa-facebook d-inline mr-3 text-white fa-2x"></i></a>
            <a href="https://twitter.com" target="blank"><i class="fa fa-twitter d-inline mx-3 text-white fa-2x"></i></a>
            <a href="https://www.instagram.com" target="blank"><i class="fa fa-instagram d-inline mx-3 text-white fa-2x"></i></a>
            <a href="https://plus.google.com" target="blank"></a>
            <a href="https://pinterest.com" target="blank"></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center text-white">© Copyright 2017 FeedBack - All rights reserved. </p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>