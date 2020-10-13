
<?php
ob_start();
session_start();
require("conectdb.php");
  if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    $t="Login";
  }else {
     $t="Perfil: ".$_SESSION['login'];
  }
    
  ?>

<!DOCTYPE html>
<html>

<head>

	<title>Página Não Encontrada!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="Css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>

<body class="bg-light">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="home">Início</a>
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
		<p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="Portal"><?php echo $t;?>
      <br> </a></p>
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
 
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center display-3 text-danger"><b>Página não encontrada</b></h1><br>
          <h6 class="text-center display-9 text-dark"><b>Esta página foi removida ou não existe! Clique <a href="home">AQUI</a> para voltar ao início</b></h6>
        </div>
      </div>
    </div>
  </div>
  <center class="p-0 bg-light"><i class="fa mb-5 fa-Hourglass fa-3x text-center"></i></center>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>