
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
     header("Location:PortalAluno");
  }

$contaba=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM  `tb_solicitacao` WHERE  `ic_deferido` =2 ;"));
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css">
    
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script type="text/javascript">$(function(){
  //Pesquisar os cursos sem refresh na página
  $("#pesquisa").click(function(){
    
    var pesquisa = $(this).val();
    
    //Verificar se há algo digitado
    if(pesquisa != ''){
      var dados = {
        palavra : pesquisa
      }   
      $.post('buscaTurma', dados, function(retorna){
        //Mostra dentro da ul os resultado obtidos 
        $("#resultado").html(retorna);
      });
    }else{
      $("#resultado").html('');
    }   
  });
});</script>
 <style type="text/css">
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
</head>

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
        </ul>
      </div>
    </div>
    <a class="ml-3 btn navbar-btn btn-danger" href="logout">Sair da Secretaria
      <br> </a>
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
            <li class="nav-item bg-dark">
              <a href="PortalSecretaria/1" class="nav-link text-white disabled"> <i class="fa fa-home fa-home"></i>&nbsp;Home <span class="badge"><?php echo $contaba; ?></span></a>
            </li>
            <li class="nav-item">
              <a href="avisossecretaria" class="nav-link text-white">Avisos Acadêmicos</a>
            </li>
            <li class="nav-item bg-danger">
              <a href="cadastro" class="nav-link text-white disabled">Alunos</a>
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
          <h1 class="">Consultar Turma</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-light py-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-danger py-1">Pesquisar</h3>
        </div>
      </div>
    </div>
  </div>
  <form method="POST" id="form-pesquisa" action="">
  <div class="bg-light py-2">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group w-100"> <label class="text-dark"><b>Turma:</b><br></label> 
            <select class="btn dropdown-toggle form-control" style="height: 45px;" data-toggle="dropdown" id="pesquisa" name="Turma">
                   <option class="dropdown-item">Selecione</option>
                    <?php
                $sql = mysqli_query($connect,"SELECT * FROM  `tb_turma`");
                while ($res = mysqli_fetch_array($sql)) { 
                    $cdTurma=$res['cd_turma']; 
                    $nmTurma=$res['nm_turma'];  
                       echo "<option value='$cdTurma' class='dropdown-item'>$nmTurma</option>";
                }
                            ?>
              </select>
            
           </div>
        </div>
        <div class="col-md-10 align-self-center">
        </div>
      </div>
    </div>
  </div>
   <div class="bg-light py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="resultado">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
 
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
          <h2 class="mb-4">Contato</h2>
          <p>
            <a href="mailto:info@pingendo.com" class="text-white"><i class="fa d-inline mr-3 text-secondary fa-envelope-o fa-lg"></i>etec@etec.com</a>
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
</body>

</html>