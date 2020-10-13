
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
  }else if($_SESSION["ic"]==0){
     header("Location:../PortalAluno");
  }
   $Postagens = 0;
   $ids;
   $quantidade = 4;
    //a pagina atual$url = explode('/',$_GET['url']);
    $pagina = !empty($url[1]) ? (int)$url[1] : 0;
    if($pagina==0){
      //header("Location:../Portal.php");

  }
    //echo "Pagina: ".$pagina."<hr>";

    $inicio     = ($quantidade * $pagina) - $quantidade;

    $qr  = mysqli_query($connect,"SELECT * FROM  `tb_solicitacao` WHERE  `ic_deferido` =2 ORDER BY 'cd_solicitacao' ASC LIMIT $inicio, $quantidade");
    $conta=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM  `tb_solicitacao` WHERE  `ic_deferido` =2 ;"));
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../Css/estilo2.css" type="text/css"> 
  <style type="text/css">
ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
    position: relative;
left: 50%;
transform:translateX(-50%)
}

ul.pagination li {display: inline;}

ul.pagination li a {
    color: #161617;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 5px;
    background-color: #f1f2f3;
}

ul.pagination li a.active {
    background-color: #007CBC;
    color: white;
    border-radius: 5px;
}

ul.pagination li a:hover:not(.active):not(.t) {background-color: #A5A8A8;}
ul.pagination li a:hover:not(.active){background-color: #00283C;color: #FFF;}
</style></head>
<style type="text/css">
  .footer {
      height: 50px;
      margin-top: -50px;
    }
    .footer,
    .push {
      height: 50px;
    }
.badge,.tag{

      background-color:#f8f9fa;
      color: #471414;
      display:inline-block;
      padding-left:8px;
      padding-right:8px;
      text-align:center
      }
      .badge{border-radius:50%}

</style>
<body class="bg-dark">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="../">Início</a>
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
        </ul>
		<p class="mb-0" style="bottom: 0px;text-align: right;">
		 <a class="ml-3 btn navbar-btn btn-danger" href="../logout">Sair da Secretaria
      <br> </a></p>
      </div>
    </div>
   
  </nav>
  <div class="bg-dark py-3">
    <div class="container">
      <div class="row text-left">
        <div class="col-md-12">
          <img class="img-fluid d-block float-left" src="../Img/logoetec2.png"> </div>
      </div>
    </div>
  </div>
  <div class="p-0 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills bg-dark text-secondary">
            <li class="nav-item bg-danger">
              <a href="#" class="nav-link disabled text-white"> <i class="fa fa-home fa-home"></i>&nbsp;Home <span class="badge"><?php echo $conta; ?></span></a>
            </li>
            <li class="nav-item">
              <a href="../avisossecretaria" class="nav-link text-white">Avisos Acadêmicos</a>
            </li>
            <li class="nav-item">
              <a href="../cadastro" class="nav-link text-white">Alunos</a>
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


   <?php 
if($conta>=1){ 
	?>	
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h4 class="alert-heading">Aviso!</h4>
            <p>Você possui <?php echo $conta; ?> novos requerimentos! </p>
          </div>
        </div>
     </div>
    </div>
  </div>
  <?php
}
          ?>


  <div class="p-0 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
		
          <h1 class="py-3">Requerimentos</h1>
          <br>



<?php
  
  if ($conta <= 0) {
    echo '<h3 class="py-2">Não há solicitações nesse momento!</h3>';
   }else {
      while ($res = mysqli_fetch_array($qr))
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
      $nmDocumento=$Do['nm_documento'];
      
    }
   ?>
     <div class="card">
            <div class="card-body"> 
              <form action="../detalhes" method="post">
                <input style="display: none;" type="textarea" name="ida" value='<?php echo $cdSolicita; ?>'>
              <h4 class="card-title">Documento: <?php echo $nmDocumento; ?></h4>

              <h6 class="card-subtitle text-muted">Aluno: <?php echo $nmAluno; ?></h6>
              <br>
              <a class="card-text p-y-1"><b>Curso: </b> <?php echo $nmCurso; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Periodo: </b><?php echo $nmPeriodo; ?></a>
              <br>
              <a class="card-text p-y-1"><b>Data: </b><?php echo date('d/m/Y',  strtotime($dtSolicitado)); ?></a>
              <p class="card-text p-y-1"><b>Observação: </b> <?php echo $dsSolicitacao; ?></p>
        
               <button  name="Deta" class='btn active btn-outline-danger' type="submit" >Ver Detalhes</button>

		 <p class="mb-0" style="bottom: 0px;text-align: right;"><a href="#">Protocolo nº<?php $hcdSolicita=dechex($cdSolicita);echo $hcdSolicita; ?></a></p>
        </form>
      </div>  
    </div>

     <br>


    <?php


     }
     ?>
     
         <?php
  $sqlTotal   = "SELECT cd_solicitacao FROM tb_solicitacao where ic_deferido=2";
  $qrTotal    = mysqli_query($connect,$sqlTotal) or die(mysqli_error());
  $numTotal   = mysqli_num_rows($qrTotal);
  $totalPagina= ceil($numTotal/$quantidade);
   $exibir = 5;
   $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
   $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
    ?>
    <ul class="pagination">
    <div id="navegacao">
        <?php
        echo "<li><a class='t' href='../PortalSecretaria/1'>primeira</a> </li> ";
        echo "<li><a href='../PortalSecretaria/$anterior'><<</a> </li> ";
    ?>
        <?php
   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
       if($i > 0){
        echo '<li><a href="../PortalSecretaria/'.$i.'"> '.$i.' </a></li>';}
  }

  echo '<li><a  class="active" href="../PortalSecretaria/'.$pagina.'">'.$pagina.'</a></li>';

  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
       if($i <= $totalPagina)
        echo '<li><a href="../PortalSecretaria/'.$i.'"> '.$i.' </a></li>';
  }
    ?>
    <?php echo "  <li><a href='../PortalSecretaria/$posterior'>>></a> </li> ";
    echo "  <li><a  class='t' href=\"../PortalSecretaria/$totalPagina\">última</a></li>";

    ?>
  </div>
</ul>
<?php 
}
?>
    <br>
           
         
        </div>
      </div>
    </div>
  </div>
  <div class="bg-dark text-white" "> 
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
          <h2 class="mb-4 text-secondary">ETEC Extensão</h2> <i class="d-block mx-auto fa fa-map-marker fa-2x"></i>
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