
<?php
ob_start();

echo "Aguarde...";
echo "<font color='#fff'>"; 
header('Content-Type: text/html;charset=utf-8');
session_start();
require("conectdb.php");

     date_default_timezone_set('America/Sao_Paulo');
  if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    header("Location:login");
    exit();
  }else if($_SESSION["ic"]==0){
     header("Location:PortalAluno");
  }else{
  $login=$_SESSION['login'];
  
      $NmAluno=$_POST["nmuser"];
      $RmAluno=$_POST["rmuser"];
      $RgAluno=$_POST["rguser"];
      $CPFAluno=$_POST["cpfuser"];
      $EmailAluno=$_POST["emailuser"];
      $DtAlunonasci=$_POST["dtnascimentouser"];
      $TelefoneAluno=$_POST["teluser"];
      $EnderecoAluno=$_POST["enderecouser"];
      $Turma=$_POST["Turma"];

      $RmAlunomd5=md5($RmAluno);

      $DtAlunonasci2 = implode("-",array_reverse(explode("/",$DtAlunonasci)));

      $CPFAluno=limpaCPF($CPFAluno);
      $RgAluno=limpaCPF($RgAluno);

      $u=$RmAluno;
      echo $u."<br>";
      $RmCP="";
      $u=str_split($u);
      print_r($u); 
      foreach ($u as $value) {
        $RmCP.=(ord($value))."-"; 
      }

      try{
     
        $editaaluno = mysqli_query($connect,"UPDATE  `portal_etec`.`tb_usuario` SET `nm_user` =  '$NmAluno',`cd_password_user` =  '$RmAlunomd5',`cd_rg` =  '$RgAluno',`cd_cpf` =  '$CPFAluno',`dt_nascimento` =  '$DtAlunonasci',`ds_email` =  '$EmailAluno',`cd_telefone` =  '$TelefoneAluno',`ds_endereco` =  '$EnderecoAluno' WHERE `tb_usuario`.`cd_rm_user_cp` ='$RmCP'");


      $editaturma = mysqli_query($connect,"UPDATE  `portal_etec`.`usuario_turma` SET  `cd_turma` =  '$Turma' WHERE  `usuario_turma`.`cd_rm_user` ='$RmAluno';");

       $verifica2 = mysqli_query($connect,"SELECT * FROM `tb_usuario` WHERE `cd_rm_user_cp` ='$RmCP' AND `cd_password_user` ='$RmAlunomd5';");

       if (mysqli_num_rows($verifica2)<=0){
         
         echo"<script language='javascript' type='text/javascript'>alert('Erro ao alterar Aluno');window.location.href='PortalAluno';</script>";  
          die();
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Aluno Alterado com sucesso!');window.location.href='Requerimento';</script>";
          
        }
}catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}
}
           function limpaCPF($valor){
 $valor = trim($valor);
 $valor = str_replace(".", "", $valor);
 $valor = str_replace(",", "", $valor);
 $valor = str_replace("-", "", $valor);
 $valor = str_replace("/", "", $valor);
 return $valor;
}

?>
