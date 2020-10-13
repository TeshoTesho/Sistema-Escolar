
<!DOCTYPE html>
<html>
 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> 
  <link href="css/bootstrap.min.css" rel="stylesheet"></head>

<body class="bg-dark">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  
 <?php
  echo "Aguarde...";
  ob_start();
  session_start();
header('Content-Type: text/html;charset=utf-8');
  require("conectdb.php");

       date_default_timezone_set('America/Sao_Paulo');
    if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
      header("Location:login");
      exit();
    }else{
    $login=$_SESSION['login'];
    $documento= !empty($_POST['documento']) ? $_POST['documento'] : 'Não selecionado';
    $texto= !empty($_POST['Observacao']) ? $_POST['Observacao'] : '';
      $date = date('Y-m-d');
    $lin=!empty(0)?:0;
   if ($documento=='Não selecionado') {
     $lin=0;
     $lin2=0;
   }else{

      // verificar se existe um igual

      $verificaigual=mysqli_query($connect,"SELECT * FROM `tb_solicitacao` WHERE `ds_solicitacao`='$texto' AND `ic_deferido` = 2 AND `cd_rm_user` = '$login' AND `cd_documento` = '$documento';");
      $verificaigualn=mysqli_num_rows($verificaigual);
      echo $verificaigualn;

      if($verificaigualn>0){
        $lin2=291291;
      }else{


      
       $solicita = mysqli_query($connect,"INSERT INTO `portal_etec`.`tb_solicitacao` (`cd_solicitacao`, `ds_solicitacao`, `ic_deferido`, `cd_rm_user`, `cd_documento`, `dt_solicitacao`, `ds_obs_secretaria`) VALUES (NULL, '$texto', '2', '$login', $documento, '$date', ''); ");

        $verifica = mysqli_query($connect,"SELECT * FROM tb_solicitacao WHERE cd_rm_user = $login") or die("erro ao selecionar");
             while($Sol =mysqli_fetch_array($verifica)){
              $cdSolicita=$Sol['cd_solicitacao'];
             }

         $verifica2 = mysqli_query($connect,"SELECT * FROM `tb_solicitacao` WHERE  `cd_solicitacao` ='$cdSolicita' AND  `cd_rm_user` ='$login';");



        $Documento = mysqli_query($connect,"SELECT * FROM tb_documento WHERE cd_documento='$documento';");
        while ($doc=mysqli_fetch_array($Documento)) {
          $nmDocumento = $doc['nm_documento'];
          $tipo = $doc['cd_tipo_documento'];
        }

        $Prazo = mysqli_query($connect,"SELECT * FROM tipo_documento where cd_tipo_documento='$tipo';");
        while ($pra=mysqli_fetch_array($Prazo)) {
          $dias=$pra['prazo'];
        }
      
        $lin=mysqli_num_rows($verifica2);
        echo '$lin='."$lin";
      }
}
        if(!isset($_POST['documento'])||!isset($_POST['Observacao'])){$lin=0;}

         if ($lin==0){
          ?>
          
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Algo não estava nos planos!</h4>
            </div>
            <div class="modal-body">
            <?php
            if ($lin2==291291) {
              echo "Você já fez esse requerimento, aguarde pela resposta!";
            }else{echo "Erro ao fazer requerimento, tente novamente!";}
            ?>                
             
            </div>
            <div class="modal-footer">
              <a href="Requerimento"><button type="button" class="btn btn-danger">Ok</button></a>
            </div>
          </div>
        </div>
      </div>      
      <script>
          $(document).ready(function(){
            $('#myModal').modal('show');
          });

        </script>

    <?php }else if ($lin==1) {
    	# code...
    ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Solicitação feita!</h4>
            </div>
            <div class="modal-body">
              <p>O documento: <?php echo "''$nmDocumento''"; ?> foi solicitado com sucesso!</p>
              <p>O prazo é de: <?php echo "$dias dias uteis."; ?></p>
            </div>
            <div class="modal-footer">
              <a href="Requerimento"><button type="button" class="btn btn-success">Ok</button></a>
            </div>
          </div>
        </div>
      </div>        
      <script>
          $(document).ready(function(){
            $('#myModal').modal('show');
          });
        </script>
    <?php
      } 

 


  }
             

  ?>
</body>

</html>