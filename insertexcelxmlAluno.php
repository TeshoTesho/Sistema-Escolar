
<?php
ob_start();
session_start();
require("conectdb.php");
  if(!isset($_SESSION["login"])||!isset($_SESSION["senha"])){
    $t="Login";
  }else {
     $t="Perfil: ".$_SESSION['login'];
  }
    
  ?>

<!DOCTYPE html>
<html>

<head>

	<title>Página Não Encontrada!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="Css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Css/estilo2.css" type="text/css"> </head>

<body class="bg-light">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="home">Início</a>
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
		<p class="mb-0" style="bottom: 0px;text-align: right;"><a class="ml-3 btn navbar-btn btn-danger" href="login"><?php echo $t;?>
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
              <a href="PortalSecretaria" class="nav-link text-white disabled"> <i class="fa fa-home fa-home"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link text-white">Avisos Acadêmicos</a>
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
 
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php

     $b = array();
	require("conectdb.php");
	header('Content-Type: text/html;charset=utf-8');
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);

	
	if(!empty($_FILES['arquivo']['tmp_name'])){
		echo "<table border=2 CELLPADDING='5' width='100%' style='float:left;margin: 0;padding: 0;'>
	<tr>
		<td> RM </td>
		<td> Nome </td>
		<td> RG </td>
		<td> CPF </td>
		<td> Email </td>
		<td> Data de nascimento </td>
		<td> Telefone </td>
		<td> Endereço </td>
		<td> Turma </td>
	</tr>";
		$arquivo = new DomDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
		
		$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);
		
		$primeira_linha = true;
		$cont=0;

		foreach($linhas as $linha){
			echo "<div style='display:none;'>";
			if($primeira_linha == false){
				if($linha->getElementsByTagName("Data")->item(0)->nodeValue!=""){
        // Erro inevitavel - só precisa de tratamento
				$Nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
				$RM = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
				$RG = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
				$CPF = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
				$Email = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
				$DTNascimento = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
				$DtAlunonasci = substr($DTNascimento, 0, 10);	
				$Telefone = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
				$Endereco = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
				$Turma = $linha->getElementsByTagName("Data")->item(8)->nodeValue;

				// ARRUMA DATA E LIMPA CPF/RG
				$RmAlunomd5=md5($RM);

      			$CPFAluno=limpaCPF($CPF);
      			$RgAluno=limpaCPF($RG);

      			// UTC
      			$u=$RM;
      			echo $u."<br>";
				$RmCP="";
      			$u=str_split($u);
      			print_r($u); 
      			foreach ($u as $value) {
      			  $RmCP.=(ord($value))."-"; 
      			}

				//Inserir o usuário no BD

      			echo "	</div><tr>
		<td> $RM </td>
		<td> $Nome </td>
		<td> $RG </td>
		<td> $CPF </td>
		<td> $Email </td>
		<td> $DtAlunonasci</td>
		<td> $Telefone </td>
		<td> $Endereco </td>
		<td> $Turma </td>
		</tr>";
      			if($RM!=0){
      try{
       $verifica2 = mysqli_query($connect,"SELECT * FROM `tb_usuario` WHERE `cd_rm_user_cp` ='$RmCP' AND `cd_rm_user` ='$RM';");

       if (mysqli_num_rows($verifica2)<=0){
 			$cadastraaluno = mysqli_query( $connect,"INSERT INTO `portal_etec`.`tb_usuario` (`cd_rm_user`, `cd_rm_user_cp`, `nm_user`, `ic_user`, `cd_password_user`, `cd_rg`, `cd_cpf`, `dt_nascimento`, `ds_email`, `cd_telefone`, `ds_endereco`) VALUES ('$RM', '$RmCP', '$Nome', '0', '$RmAlunomd5', '$RG', '$CPF', '$DtAlunonasci', '$Email', '$Telefone', '$Endereco');");

 			//
    		 $Turma = mysqli_query($connect,"SELECT * FROM tb_turma WHERE nm_turma = '$Turma'") or die("erro ao selecionar");
   
    		while($Tr2 =mysqli_fetch_array($Turma)){ 
   		   $nmTurma=$Tr2['nm_turma'];
   		   $cdTurma=$Tr2['cd_turma'];
  		  }

 			$cadastroturma = mysqli_query($connect,"INSERT INTO `portal_etec`.`usuario_turma` (`cd_turma`, `cd_rm_user`) VALUES ('$cdTurma', '$RM');");

 			$verifica3 = mysqli_query($connect,"SELECT * FROM `tb_usuario` WHERE `cd_rm_user_cp` ='$RmCP' AND `cd_password_user` ='$RmAlunomd5';");
       if (mysqli_num_rows($verifica3)<=0){
       		$a= "Aluno <b> $Nome </b> não foi inserido!!!";
        }else{
        	$a= "Aluno <b> $Nome </b> foi inserido!!!";

        	$cont++;          
        }
        }else{
			
			$a= "Aluno <b> $Nome </b> Já é cadastrado!";          
     }
     

     array_push($b, $a);
       
}catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}
}
}
			}
			$primeira_linha = false;
		}

		echo "</table><p style='text-align:right;'><font size='1'>Arquivo inserido com sucesso!</font></p>";
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

        	<div id="Alunos">
        		<?php if(!empty($_FILES['arquivo']['tmp_name'])){
        		$c = count($b);
        		echo "<h1 >".$c." Alunos no total!.</h1><br>";
        		
        		for ($i = 0; $i < count($b); $i++) {
    					if($b[$i]==""||$b[$i]==" "){}else{echo $b[$i]."<hr>";}
					}}
        		?>
        	</div>

        </div>
      </div>
    </div>
  </div>
  <center class="p-0 bg-light"><a href="home"><h1>Voltar para o Início</h1></a></center><br><br>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>