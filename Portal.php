<?php 
ob_start();
session_start();

     date_default_timezone_set('America/Sao_Paulo');
  require("conectdb.php");

     if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else{
  $login = $_SESSION['login'];  
  $senha = $_SESSION['senha'];

    // Aluno ou secretaria? WHERE cd_rm_user = $login and cd_password_user = '$senha'
 
   $verifica = mysqli_query($connect,"SELECT * FROM tb_usuario where cd_rm_user='$login'") or die("erro ao selecionar");
         while($prod =mysqli_fetch_array($verifica))
        {
			echo $prod['nm_user'];
			echo ": ".$prod['ic_user']."<br>";
			$ic=$prod['ic_user'];
			
		}

          $_SESSION['ic']=$ic;
          

          if($ic==0){echo ("Aluno");
          echo "<a href='PortalAluno'>ALUNO</a>";

          header("Location: PortalAluno");
          }
            else if($ic==1){echo ("Secretaria");
            echo "<a href='PortalSecretaria/1'>SECRETARIA</a>";
            header("Location:PortalSecretaria.php/1");
          }
        else{header("Location: home");
      }
}
	
?>
