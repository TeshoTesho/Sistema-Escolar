
<?php

ob_start();
session_start();

     date_default_timezone_set('America/Sao_Paulo');
  require("conectdb.php");
    if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==1){
     header("Location:PortalSecretaria");
  }
    $login = $_SESSION["login"];
   $Postagens = 0;
   $ids;

    //inclusão da conexão com banco de dados
    //A quantidade de valor a ser exibida
    $quantidade = 4;
    //a pagina atual$url = explode('/',$_GET['url']);
    $pagina = !empty($url[1]) ? (int)$url[1] : 0;
    if($pagina==0){
     //  header("Location: Solicitacoes.php/1");
      $pagina=1;
    }
    //echo "<p>Pagina: ".$pagina."<hr></p>";

    //Calcula a pagina de qual valor será exibido
    $inicio     = ($quantidade * $pagina) - $quantidade;

    //Monta o SQL com LIMIT para exibição dos dados  
    $sql = "SELECT * FROM  `tb_solicitacao` WHERE  `cd_rm_user` ='$login' ORDER BY cd_solicitacao DESC LIMIT $inicio, $quantidade";
    //Executa o SQL
    $qr  = mysqli_query($connect,$sql) or die(mysqli_error());
    //Percorre os campos da tabela
    $conta = mysqli_num_rows($qr);

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
		<p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="../logout">Sair <?php echo $login ?>
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
            <li class="nav-item">
               <a href="../PortalAluno" class="nav-link text-white disabled"> <i class="fa fa-home fa-home"></i>&nbsp;Home</a>
             </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="../avisosalunos">Avisos Acadêmicos</a>
            </li>
            <li class="nav-item">
              <a href="../Requerimento" class="nav-link text-white">Requerimentos</a>
            </li> 
            <li class="nav-item">
              <a href="../Solicitacoes/" class="nav-link text-white bg-danger">Minhas Solicitações</a>
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
  <div class="p-0 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="py-3">Solicitações</h1>
          <br>
           <?php
  
   if ($conta <= 0) {
    echo  "<h4 class='py-2'>Você não fez nenhuma solicitação até o momento!</h4>"; 
  }else {
    ?>

 <?php
   while ($res = mysqli_fetch_assoc($qr)) { 
    $CdUser=$res['cd_rm_user']; 
    $cdSolicita=$res['cd_solicitacao']; 
    $dsSolicitacao=$res['ds_solicitacao']; 
    $ic_deferido=$res['ic_deferido'];
    $cdDocumento=$res['cd_documento']; 
    $dtSolicitado=$res['dt_solicitacao']; 
    $dsSecretaria=$res['ds_obs_secretaria']; 

       $Aluno = mysqli_query($connect,"SELECT * FROM tb_usuario WHERE cd_rm_user = '$CdUser'") or die("erro ao selecionar"); while($Al =mysqli_fetch_array($Aluno)){ $nmAluno=$Al['nm_user'];
        $cd=$Al['cd_rm_user']; } 
     $Documento = mysqli_query($connect,"SELECT * FROM `tb_documento` WHERE `cd_documento` ='$cdDocumento'") or die("erro ao selecionar"); while($Do =mysqli_fetch_array($Documento)){ $nmDocumento=$Do['nm_documento']; }
  
  $doc = mysqli_query($connect,"SELECT * FROM  `tb_documento` WHERE  `cd_documento` ='$cdDocumento'");
  while ($res = mysqli_fetch_array($doc)) { 
    $TipoDocx=$res['cd_tipo_documento']; }
  $docp = mysqli_query($connect,"SELECT * FROM  `tipo_documento` WHERE  `cd_tipo_documento` ='$TipoDocx'");
    while ($res = mysqli_fetch_array($docp)) { 
    $prazo=$res['prazo']; }
    if($ic_deferido==1){
   ?>
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Documento: <?php echo $nmDocumento; ?></h4>
           <?php 
       
       echo"<p>Seu documento foi deferido! Prazo de entrega é de $prazo dias uteis. Para a retirada do documento comaparecer presencialmente na ETEC de Praia Grande</p><p>$dsSecretaria</p>"; ?>
           <p class="mb-0" style="bottom: 0px;text-align: right;">
            <a href="#">Protocolo nº<?php $hcdSolicita=dechex($cdSolicita);echo $hcdSolicita; ?></a></p>
          </div>
          <?php
}else if($ic_deferido==0){
  ?>
  <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Documento: <?php echo $nmDocumento; ?></h4>
            <p>Seu documento foi indeferido! Para informações sobre o indeferimento comparecer pessoalmente a secretaria!</p>
            <?php echo "<p>$dsSecretaria</p>"; ?>          
            <p class="mb-0" style="bottom: 0px;text-align: right;"><a href="#">Protocolo nº
      <?php $hcdSolicita=dechex($cdSolicita);echo $hcdSolicita; ?></a></p>
          </div>
        <?php
}else if($ic_deferido==2){
  ?>
 <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Documento: <?php echo $nmDocumento; ?></h4>
            <p>Sua Solicitação está em andamento! Aguarde...</p>
            <p class="mb-0" style="bottom: 0px;text-align: right;">
              <?php $hcdSolicita=dechex( $cdSolicita); echo "<a href=# onClick=window.open('../cancela.php?v=$hcdSolicita','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=804,height=360'); return false; >Protocolo nº$hcdSolicita</a></p>"; ?>
          </div>
          <?php
}else if($ic_deferido==3){
  ?>
 <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Documento: <?php echo $nmDocumento; ?></h4>
            <p>Você Cancelou essa solicitação!.</p>
            <p class="mb-0" style="bottom: 0px;text-align: right;"><a href="#">Protocolo nº<?php $hcdSolicita=dechex($cdSolicita);echo $hcdSolicita; ?></a></p>
          </div>
          <?php

     }



   } 
   /**
   * SEGUNDA PARTE DA PAGINAÇÃO
   */
  //SQL para saber o total
  $sqlTotal   = "SELECT cd_solicitacao FROM tb_solicitacao where cd_rm_user = $login";
  //Executa o SQL
  $qrTotal    = mysqli_query($connect,$sqlTotal) or die(mysqli_error());
  //Total de Registro na tabela
  $numTotal   = mysqli_num_rows($qrTotal);
  //O calculo do Total de página ser exibido
  $totalPagina= ceil($numTotal/$quantidade);
   /**
    * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
    */
   $exibir = 5;
   /**
    * Aqui montará o link que voltará uma pagina
    * Caso o valor seja zero, por padrão ficará o valor 1
    */
   $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
   /**
    * Aqui montará o link que ir para proxima pagina
    * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
    * caso contrario, ele pegar o valor da página + 1
    */
   $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
   /**
    * Agora monta o Link paar Primeira Página
    * Depois O link para voltar uma página
    */
  /**
    * Agora monta o Link para Próxima Página
    * Depois O link para Última Página
    */
    ?>
    <div id="navegaca">

    <ul class="pagination">
        <?php
        echo "<li><a class='t' href='../Solicitacoes/1'>primeira</a> </li> ";
        echo "<li><a href='../Solicitacoes/$anterior'><<</a> </li> ";

         /**
    * O loop para exibir os valores à esquerda
    */
   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
       if($i > 0){
        echo '<li><a href="../Solicitacoes/'.$i.'"> '.$i.' </a></li>';}
  }

  echo '<li><a  class="active" href="../Solicitacoes/'.$pagina.'">'.$pagina.'</a></li>';

  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
       if($i <= $totalPagina)
        echo '<li><a href="../Solicitacoes/'.$i.'"> '.$i.' </a></li>';
  }
echo "  <li><a href='../Solicitacoes/$posterior'>>></a> </li> ";
    echo "  <li><a  class='t' href=\"../Solicitacoes/$totalPagina\">última</a></li>";

    ?>
</ul>

  </div>
<?php
 }
 
  
  ?>

 <br>
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