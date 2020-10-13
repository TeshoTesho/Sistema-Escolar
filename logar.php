

<?php

echo "Aguarde..."; 
ob_start();
session_start();

     date_default_timezone_set('America/Sao_Paulo');
  require("conectdb.php");
     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
  $login = $_POST['rm'];
  $senha = $_POST['pass'];
        $login2="";
        $u=$login;
        $u=str_split($u);
        print_r($u);
        foreach ($u as $value) {
        $login2.=(ord($value))."-";
        }

        //echo "Login:".$login;
        //echo "<br>Login cod:".$login2;
        //echo "<br>Senha:".$senha;
        //echo "<br>Senha cod:".md5($senha);


     $verifica = mysqli_query($connect,"SELECT * FROM tb_usuario WHERE cd_rm_user_cp = '$login2' AND cd_password_user = md5($senha)");
     $verificarows= mysqli_num_rows($verifica);
     echo "linhas: ".$verificarows;
        if ($verificarows<=0){
         
         ?>   
         

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
         
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"     data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Algo não estava nos planos!</h4>
                       
                      
                    </div>
                    <div class="modal-body">
                        <p>Login e/ou senha incorretos</p>
            <p><h4>Tente novamente.</h4></p>
                    </div>
                    <div class="modal-footer">
                        <a href="login"><button type="button" class="btn btn-danger">Ok</button></a>
                    </div>
                </div>
            </div>
        </div>  

      <script>
            $('#myModal').modal('show');

        </script>


         <?php






        }else{
          $_SESSION['login']=$_POST['rm'];
          $_SESSION['senha']=$_POST['pass'];
          header("Location:Portal");
       }
     }else{
      header("Location:home");
     }


?>

</body>
</html>
