
<?php
ob_start();
session_start();
header('Content-Type: text/html;charset=utf-8');
require("conectdb.php");
  if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==1){
	   header("Location:PortalSecretaria");
  }
    $login = $_SESSION["login"];

function Mask( $mask,$val) {
  $maskared = '';
  $k = 0;
  for ($i = 0; $i <= strlen($mask) - 1; $i++) {
    if ($mask[$i] == '#') {
      if (isset ($val[$k]))
        $maskared .= $val[$k++];
    } else {
      if (isset ($mask[$i]))
        $maskared .= $mask[$i];
    }
  }
  return $maskared;
}
try {
  
} catch (Exception $e) {
  
}
$b2=md5($login);
		$verifica1 = mysqli_query($connect,"SELECT * FROM `tb_usuario` WHERE  `cd_rm_user` =$login AND  `cd_password_user` ='$b2';");
		 if (mysqli_num_rows($verifica1)==1){ 
		 	$senhmuda="mudar";
        }else if (mysqli_num_rows($verifica1)<=0){
   			$senhmuda="nmudar";
 // Trazendo Nome e rm
   $verifica = mysqli_query($connect,"SELECT * FROM tb_usuario WHERE cd_rm_user = '$login'") or die("erro ao selecionar");

   // User Turma
   $userT = mysqli_query($connect,"SELECT * FROM usuario_turma WHERE cd_rm_user = '$login'") or die("erro ao selecionar");
   $cdTurma="";
   while($uT =mysqli_fetch_array($userT)){
    $cdTurma=$uT['cd_turma']; }


    if($cdTurma!=""){

     $Turma = mysqli_query($connect,"SELECT * FROM tb_turma WHERE cd_turma = '$cdTurma'") or die("erro ao selecionar");

    while($Tr2 =mysqli_fetch_array($Turma)){ 
      $nmTurma=$Tr2['nm_turma'];
      $cdCurso=$Tr2['cd_curso'];
      $cdPeriodo=$Tr2['cd_periodo'];
      }

    $Periodo = mysqli_query($connect,"SELECT * FROM tb_periodo WHERE cd_periodo = '$cdPeriodo'") or die("erro ao selecionar");

         while($Pp =mysqli_fetch_array($Periodo)){ 
          $nmPeriodo=$Pp['nm_periodo'];
        }


    $Curso = mysqli_query($connect,"SELECT * FROM tb_curso WHERE cd_curso = '$cdCurso'") or die("erro ao selecionar");
      while($Cc =mysqli_fetch_array($Curso)){ 
        $nmCurso=$Cc['nm_curso'];
        }
      }else{
        $nmTurma="Não possui";
        $nmCurso="Não possui";
        $nmPeriodo="Não possui";
        }
        
      
      }

        
		

?>

<!DOCTYPE html>
<html>
 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>
<script type="text/javascript">
 
</script>
<body class="bg-dark">

  
<?php
	include "modalsenha.php";
 if($senhmuda=="mudar"){
?>
				<script>
					$(document).ready(function(){
						$('#myModal').modal('show');
					});
				</script>
			<?php } ?>
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
		</ul> 
	
			 <p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="logout">Sair <?php echo $login ?></a></p>
      </div>
    </div>
  </nav>
  <div class="bg-dark py-3">
    <div class="container">
      <div class="row text-left">
        <div class="col-md-12">
          <img class="img-fluid d-block float-left" src="Img/logoetec2.png"> </div>
      </div>
    </div>
  </div>
  <div class="p-0 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills bg-dark text-secondary">
            <li class="nav-item bg-danger">
                <a href="PortalAluno" class="nav-link text-white disabled"> <i class="fa fa-home fa-home"></i>&nbsp;Home</a>
             </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="avisosalunos">Avisos Acadêmicos</a>
            </li>
            <li class="nav-item">
              <a href="Requerimento" class="nav-link text-white">Requerimentos</a>
            </li> 
            <li class="nav-item">
              <a href="Solicitacoes/1" class="nav-link text-white">Minhas Solicitações</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link text-white">Calendário</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container"> </div>
  </div>
  <div class="bg-light py-4 px-2">
   <p class="mb-0" style="bottom: 0px;text-aling:right;"><a href="alterarsenha" class="btn btn-secondary text-light float-right">Alterar Senha</a></p>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="">Dados do Aluno</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="p-0 bg-light">
    <div class="container">
      <?php 
        while($prod =mysqli_fetch_array($verifica))
        { ?>

      <div class="row">
        <div class="col-md-12 py-2">
          <p class="lead p-0"><b>Nome:</b> <?php echo $prod['nm_user'] ?>&nbsp;</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 py-2">
          <p class="lead p-0"><b>RM:</b> <?php echo $prod['cd_rm_user']?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 py-2">
          <p class="lead p-0"><b>RG:</b> <?php echo Mask("##.###.###-#",$prod['cd_rg']);?></p>
        </div>
        <div class="col-md-8 py-2">
          <p class="lead p-0"><b>CPF:</b> <?php echo Mask("###.###.###-##",$prod['cd_cpf'])?></p>
        </div>
      </div>
      <div class="row">
         <div class="col-md-4 py-2">
          <p class="lead p-0"><b>Telefone Celular:</b> <?php echo Mask("(##) #####-####",$prod['cd_telefone'])?></p>
        </div>
        <div class="col-md-8 py-2">
          <p class="lead p-0"><b>E-mail:</b> <?php echo $prod['ds_email']?></p>
        </div>
       
      </div>
      <div class="row">
        <div class="col-md-12 py-2">
          <p class="lead p-0"><b>Endereço:</b> <?php echo $prod['ds_endereco']?></p>
        </div>
      </div>
       

      <?php
        }
      ?>
        <div class="row">
        <div class="col-md-4 py-2">
          <p class="lead p-0"><b>Turma:</b> <?php echo $nmTurma; ?></p>
        </div>
        <div class="col-md-4 py-2">
          <p class="lead p-0"><b>Curso:</b> <?php echo $nmCurso; ?></p>
        </div>
        <div class="col-md-4 py-2">
          <p class="lead p-0"><b>Período:</b> <?php echo $nmPeriodo; ?></p>
        </div>
      </div>
    
      <div class="row">
        <div class="col-md-12">
          <p class="lead p-0"></p>
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