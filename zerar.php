<?php
ob_start();
session_start();
require('conectdb.php');
$y=2;
if($y==2){
  	$Aviso = mysqli_query($connect,"TRUNCATE tb_avisos;");
  	$Solicitacao = mysqli_query($connect,"TRUNCATE tb_solicitacao;");
  	$User_turma = mysqli_query($connect,"TRUNCATE usuario_turma;");
  	$Aluno = mysqli_query($connect,"DELETE FROM tb_usuario WHERE cd_rm_user != '123456';");
header("Location:home");
	$x=1;
	if($x==2){
		mysqli_query($connect,"DROP TABLE usuario_turma;");
		mysqli_query($connect,"create table usuario_turma(	cd_turma int,    cd_rm_user int,    constraint pk_cd_user_turma primary key (cd_turma,cd_rm_user),	constraint fk_cd_rm_user foreign key (cd_rm_user) references tb_usuario (cd_rm_user),    constraint fk_cd_turma foreign key (cd_turma) references tb_turma (cd_turma));");
	}
}else{
		header("Location:home");
	}

?>