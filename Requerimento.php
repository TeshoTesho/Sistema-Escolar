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
  $login = $_SESSION['login'];  
   $verifica = mysqli_query($connect,"SELECT cd_rm_user FROM tb_usuario WHERE cd_rm_user = '$login'") or die("erro ao selecionar");
   while($uT =mysqli_fetch_array($verifica)){
    $login=$uT['cd_rm_user']; }
?>


<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>

<body class="bg-dark">  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
		<p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="logout">Sair <?php echo $login ?>
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
  <div class="p-0 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills bg-dark text-secondary">
            <li class="nav-item ">
               <a href="PortalAluno" class="nav-link text-white disabled"> <i class="fa fa-home fa-home"></i>&nbsp;Home</a>
             </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="avisosalunos">Avisos Acadêmicos</a>
            </li>
            <li class="nav-item bg-danger">
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
 

  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="">Lista de documentos:</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-0 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th class="border border-dark align-middle">Documento:</th>
                <th class="border border-dark align-middle">Descrição:</th>
                <th class="border border-dark">Prazo de Entrega:</th>
              </tr>
            </thead>            
              <tbody>
              <?php 
                  $sql = mysqli_query($connect,"SELECT * FROM  `tb_documento`");
                  $conta = mysqli_num_rows($sql);
                    while ($res = mysqli_fetch_array($sql)) { 
                    $nmDocumento=$res['nm_documento']; 
                    $dsDocumento=$res['ds_documento']; 
                    $cdTipoDocumento=$res['cd_tipo_documento']; 
                    $Documento = mysqli_query($connect,"SELECT * FROM `tipo_documento` WHERE `cd_tipo_documento` ='$cdTipoDocumento'") or die("erro ao selecionar"); while($Do =mysqli_fetch_array($Documento)){ $prazo=$Do['prazo']; }
                    echo "<tr>";
                echo "<td class='border border-dark'>$nmDocumento</td>";
                echo "<td class='border border-dark'>$dsDocumento</td>";
                echo "<td class='border border-dark'>$prazo dias úteis</td>";
                echo "</tr>";}                  
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="text-white bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-dark">Requerimento de Documentos</h1>
          <form action="requerer" method="post" id="form1"> <label for="InputEmail1" class="text-dark">Escolha o documento:</label>
            <p> </p>
            <div class="btn-group">
              <select class="btn dropdown-toggle form-control" style="height: 45px;" data-toggle="dropdown" name="documento">
              	<?php
                $sql = mysqli_query($connect,"SELECT * FROM  `tb_documento`");
                while ($res = mysqli_fetch_array($sql)) { 
                    $cdDocumento=$res['cd_documento']; 
                    $nmDocumento=$res['nm_documento'];  
                echo "<option value='$cdDocumento' class='dropdown-item'>$nmDocumento</option>";}
                ?>               
              </select>
            </div>
            <br><br>     
            <div class="form-group"> <label for="InputEmail1" class="text-dark">Observação:</label> <textarea name="Observacao" rows="5" class="form-control" id="InputObservacao" placeholder="Observação"></textarea>
               </div>
          </form>
          <div class="row">
            <div class="col-md-12 bg-light py-3">
              <button type="submit" form="form1" value="Submit" class="btn active btn-outline-danger">Solicitar</button>
            </div>

          </div>
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