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
$contaba=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM  `tb_solicitacao` WHERE  `ic_deferido` =2 ;"));
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  
<script language="JavaScript">
/* Formatação para qualquer mascara */

function formatar(src, mask) 
{
var i = src.value.length;
var saida = mask.substring(0,1);
var texto = mask.substring(i)
if (texto.substring(0,1) != saida) 
{
src.value += texto.substring(0,1);
}
}

/* Valida Data */

var reDate4 = /^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/;
var reDate = reDate4;

function doDateVenc(Id, pStr, pFmt){
d = document.getElementById(Id);
if (d.value != ""){ 
if (d.value.length < 10){
alert("Data Inválida!\nDigite corretamente a data: dd/mm/aaaa !");
d.value="";
d.focus(); 
return false;
}else{

eval("reDate = reDate" + pFmt);
if (reDate.test(pStr)) {
return false;
} else if (pStr != null && pStr != "") {
alert("ALERTA DE ERRO!!\n\n" + pStr + " NÃO é uma data válida.");
d.value="";
d.focus(); 
return false;
}
} 
}else{
return false;
}
}
</script>
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
		<p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="logout">Sair da Secretaria
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
          <h1 class="">Cadastro de Alunos</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-light py-1">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h3 class="text-danger py-1">Escolha um arquivo:</h3> <label class="text-dark">O arquivo deverá estar salvo em extensão .xml<br></label> </div>
      </div>
    </div>
  </div>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row align-middle">
        <div class="col-md-6 ">
          <form method="POST" action="insertexcelxmlAluno" enctype="multipart/form-data" class="align-middle">
            <input type="file" name="arquivo" class="align-middle">
            <br>
            <br>
            <button type="submit" class="btn mt-2 active btn-outline-danger align-middle">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-light py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-body p-5">
              <form action="cadastrandoaluno" method="post">
                <div class="form-group"> <label class="text-dark"><b>RM:</b><br></label>
                  <input class="form-control w-25" name="rmuser" placeholder="Número Matrícula"> </div>
                <div class="form-group"> <label class="text-dark" >Nome Completo:&nbsp;<br></label>
                  <input class="form-control" placeholder="Nome Completo" name="nmuser"> </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark" >RG:&nbsp;</label>
                      <input id="rg" class="form-control" placeholder="RG" maxlength="12" OnKeyPress="formatar(this, '##.###.###-#')" name="rguser" type="text"> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark" >CPF:&nbsp;</label>
                      <input id="cpf" class="form-control" placeholder="CPF" maxlength="14" OnKeyPress="formatar(this, '###.###.###-##')" name="cpfuser" type="text"> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark" >Data de Nascimento:&nbsp;</label>
                      <input type="text" id="data" maxlength="10" class="form-control w-50" name="dtnascimentouser" placeholder="dd/mm/aaaa"  OnKeyPress="formatar(this, '##/##/####')" onBlur="return doDateVenc(this.id,this.value, 4);"> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark" >E-mail:&nbsp;</label>
                      <input class="form-control" placeholder="E-mail" name="emailuser" type="email"> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark" >Número de Telefone:</label>
                      <input id="telefone" class="form-control" name="teluser" placeholder="(00) 3333-3333" type="text"> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark">Cidade:</label>
                      <input class="form-control" placeholder="Cidade"  name="cidadeuser" type="text"> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark">Bairro:</label>
                      <input class="form-control" placeholder="Bairro"  name="bairrouser" type="text"> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark">Endereço:</label>
                      <input class="form-control" placeholder="Rua"  name="enderecouser" type="text"> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark">Número: </label>
                      <input class="form-control" placeholder="Número" name="cdenederecouser" type="text"> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group"> <label class="text-dark" >Complemento:</label>
                      <input class="form-control" placeholder="Bloco, apto, etc" name="complementouser" type="text"> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group"> <label class="text-dark">Turma:</label>
                      <br>
                      <div class="btn-group w-25"> <select class="btn dropdown-toggle form-control" style="height: 45px;" data-toggle="dropdown" name="Turma">
                   <option class="dropdown-item">Selecione</option>
                    <?php
                $sql = mysqli_query($connect,"SELECT * FROM  `tb_turma`");
                while ($res = mysqli_fetch_array($sql)) { 
                    $cdTurma=$res['cd_turma']; 
                    $nmTurma=$res['nm_turma'];  
                       echo "<option value='$cdTurma' class='dropdown-item'>$nmTurma</option>";
                }
                            ?>
              </select> </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn mt-2 active btn-outline-danger">Cadastrar</button>
              </form>
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>