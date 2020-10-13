
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="Css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> 
  <style type="text/css">
    .gradient-overlay2 {
  overflow: hidden;
  position: relative; }
  .gradient-overlay2 > *:first-child:before {
    content: '';
    width: 100%;
    height: 100%;
    display: block;
    position: absolute;
    left: 0px;
    top: 0px;
    pointer-events: none;
    background: linear-gradient(to bottom, #343a40, #f8f9fa); }
  </style>
</head>

<body class="bg-dark">
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
		<p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="login"><?php echo $t;?>
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
  <div class="text-center text-white p-0 bg-dark gradient-overlay2">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div id="carouselArchitecture" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselArchitecture" data-slide-to="0" class="active"><i></i></li>
              <li data-target="#carouselArchitecture" data-slide-to="1" class=""><i></i></li>
              <li data-target="#carouselArchitecture" data-slide-to="2" class=""><i></i></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="Img/Vestibulinho.jpg" data-holder-rendered="true"> </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="Img/INOVA.png" data-holder-rendered="true"> </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="Img/Fetesp.png" data-holder-rendered="true"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center display-3 text-danger"><b>Cursos Técnicos Oferecidos</b></h1>
        </div>
      </div>
    </div>
  </div>
  <center class="p-0 bg-light"><i class="fa mb-5 fa-book fa-3x text-center"></i></center>
  <div class="p-5 bg-secondary style">
    <div class="container">
      <div class="row">
        <div class="p-3 align-self-center col-md-4">
          <div class="card">
            <div class="card-block p-5">
              <h1>
                <center><span style="font-size: 30px;">Informática</span></center>
              </h1> <i class="d-block mx-auto fa fa-code fa-3x text-center"></i>
              <hr>
              <center>
                <a href="#" class="btn btn-dark">Leia Mais</a>
              </center>
            </div>
          </div>
        </div>
        <div class="p-3 align-self-center col-md-4">
          <div class="card">
            <div class="card-block p-5">
              <h1>
                <center><span style="font-size: 30px;">Farmácia</span></center>
              </h1> <i class="d-block mx-auto fa fa-3x text-center fa-eyedropper"></i>
              <hr>
              <center>
                <a href="#" class="btn btn-dark">Leia Mais</a>
              </center>
            </div>
          </div>
        </div>
        <div class="p-3 align-self-center col-md-4">
          <div class="card">
            <div class="card-block p-5">
              <h1>
                <center><span style="font-size: 30px;">Contabilidade</span></center>
              </h1> <i class="d-block mx-auto fa fa-3x text-center fa-calculator"></i>
              <hr>
              <center>
                <a href="#" class="btn btn-dark">Leia Mais</a>
              </center>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="p-3 align-self-center col-md-4">
          <div class="card">
            <div class="card-block p-5">
              <h1>
                <center><span style="font-size: 30px;">Transações Imobiliárias</span></center>
              </h1> <i class="d-block mx-auto fa fa-3x text-center fa-home"></i>
              <hr>
              <center>
                <a href="#" class="btn btn-dark">Leia Mais</a>
              </center>
            </div>
          </div>
        </div>
        <div class="p-3 align-self-center col-md-4">
          <div class="card">
            <div class="card-block p-5">
              <h1>
                <center><span style="font-size: 30px;">Informática para Internet</span></center>
              </h1> <i class="d-block mx-auto fa fa-3x text-center fa-at"></i>
              <hr>
              <center>
                <a href="#" class="btn btn-dark">Leia Mais</a>
              </center>
            </div>
          </div>
        </div>
        <div class="p-3 align-self-center col-md-4">
          <div class="card">
            <div class="card-block p-5">
              <h1>
                <center><span style="font-size: 30px;">Logistica<br><br></span></center>
              </h1> <i class="d-block mx-auto fa fa-3x text-center fa-ship"></i>
              <hr>
              <center>
                <a href="#" class="btn btn-dark">Leia Mais</a>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-light text-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="Img/Colação.png">
          <h5><b>Colação de Grau</b></h5>
        </div>
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4 py-3" src="Img/Mesa Redonda Contabilidade.png">
          <h5><b>Mesa Redonda de Contabilidade</b></h5>
        </div>
        <div class="col-md-4 my-3">
          <img class="img-fluid d-block mb-4" src="Img/I Jogos Logisticos.png">
          <h5><b>1º Jogos Logísticos</b></h5>
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