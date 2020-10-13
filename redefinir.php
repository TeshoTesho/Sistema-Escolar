<!DOCTYPE html>
<html>
<head>
  <title></title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> 
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">


         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

<?php

echo "Aguarde...";
ob_start();
header('Content-Type: text/html;charset=utf-8');
session_start();
require("conectdb.php");

     date_default_timezone_set('America/Sao_Paulo');
  if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==1){
     header("Location:PortalSecretaria");
  }else{
  $login=$_SESSION['login'];

  $senhaautual=$_POST['senhaautal'];
  $novasenha=$_POST['nvsenha'];
  $confirmasenha=$_POST['cnvsenha'];
  
  
  $senhaatualmd5=md5($senhaautual);
  $novasenhamd5=md5($novasenha);
  $confirmasenhamd5=md5($confirmasenha);
  $rmmd5=md5($login);

   $u=$login; 
  $u2="";
  $u=str_split($u);
  print_r($u); 
  foreach ($u as $value) {
  $u2.=(ord($value))."-"; 
  }


  if($novasenhamd5==$confirmasenhamd5){
	   $verifica1 = mysqli_query($connect,"SELECT * FROM `tb_usuario`WHERE  `cd_rm_user_cp` =  '$u2'AND  `cd_password_user` =  '$senhaatualmd5'");
		 if (mysqli_num_rows($verifica1)<=0){
      $erro=1; //A senha atual está incorreta
        }else{
           if($rmmd5==$novasenhamd5){
            $erro=2 ;//Coloque uma senha que não seja seu próprio RM
          }else{
			try{
      $solicita = mysqli_query($connect,"UPDATE `tb_usuario` SET `cd_password_user`='$novasenhamd5' WHERE `cd_rm_user_cp`='$u2';");

           $verifica2 = mysqli_query($connect,"SELECT * FROM `tb_usuario`WHERE  `cd_rm_user_cp` =  '$u2'AND  `cd_password_user` =  '$novasenhamd5'");

       if (mysqli_num_rows($verifica2)<=0){
         $erro =3; //Erro ao redefinir a senha, tente novamente
        }else{
          $erro = 0;//Senha alterada com sucesso!');window.location.href='login';</script>";    
        }
			}catch (Exception $e) {
				echo 'Exceção capturada: ',  $e->getMessage();
			}
        }
          }
  } else{
	 $erro=4; //As senhas não correspondem
	  }       
    ?>
    <script>
          $(document).ready(function(){
            $('#myModal').modal('show');
          });
        </script>
    <?php    
if($erro==0){
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"     data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Sucesso!</h4>
                       
                      
                    </div>
                    <div class="modal-body">
                        <p>Sucesso em alterar sua senha</p>
                    </div>
                    <div class="modal-footer">
                        <a href="portal"><button type="button" class="btn btn-success">Uhull!</button></a>
                    </div>
                </div>
            </div>
        </div>
<?php

}else{ ?>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"     data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Falha!</h4>
                       
                      
                    </div>
                    <div class="modal-body">
                      <p><h4>Houve um erro ao alterar a senha.</h4></p><h5>
                      <?php
                      if($erro==1){echo "<p>A senha atual está incorreta!</p>";}
                        else if($erro==2){echo "<p>Coloque uma senha que não seja seu próprio RM!</p>";}
                          else if($erro==3){echo "<p>Erro ao redefinir a senha, tente novamente!</p>";}
                            else if($erro==4){echo "<p>As senhas não correspondem!</p>";}
                      ?></h5>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="alterarsenha"><button type="button" class="btn btn-danger">Tentar novamente!</button></a>
                    </div>
                </div>
            </div>
        </div>
<?php

}
}
?>


</body>
</html>