
<?php
ob_start();
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
      $complementoAluno=$_POST["complementouser"];
      $Turma=$_POST["Turma"];
      $CdEndereco=$_POST["cdenederecouser"];
      $BairroAluno=$_POST["bairrouser"];
      $CidadeAluno=$_POST["cidadeuser"];

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
      $Endereco=$EnderecoAluno.", nº".$CdEndereco." ".$complementoAluno." - ".$BairroAluno." - ".$CidadeAluno."/SP";

      try{
     
      $cadastraaluno = mysqli_query("INSERT INTO `portal_etec`.`tb_usuario` (`cd_rm_user`, `cd_rm_user_cp`, `nm_user`, `ic_user`, `cd_password_user`, `cd_rg`, `cd_cpf`, `dt_nascimento`, `ds_email`, `cd_telefone`, `ds_endereco`) VALUES ('$RmAluno', '$RmCP', '$NmAluno', '0', '$RmAlunomd5', '$RgAluno', '$CPFAluno', '$DtAlunonasci2', '$EmailAluno', '$TelefoneAluno', '$Endereco');");

      $cadastroturma = mysqli_query("INSERT INTO `portal_etec`.`usuario_turma` (`cd_user_turma`, `cd_turma`, `cd_rm_user`) VALUES (NULL, '$Turma', '$RmAluno');");

       $verifica2 = mysqli_query("SELECT * FROM `tb_usuario` WHERE `cd_rm_user_cp` ='$RmCP' AND `cd_password_user` ='$RmAlunomd5';");

       if (mysqli_num_rows($verifica2)<=0){
         echo"<script language='javascript' type='text/javascript'>alert('Erro ao alterar Aluno');window.location.href='PortalAluno';</script>";
          die();
        }else{
         setcookie("requerido","1");
          echo"<script language='javascript' type='text/javascript'>alert('Aluno alterado com sucesso!');window.location.href='Requerimento';</script>";
          
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
