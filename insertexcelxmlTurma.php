<?php

	require("conectdb.php");
	header('Content-Type: text/html;charset=utf-8');
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);
	$x=0;
	echo "<table border=2 width='100%'>
	<tr>
		<td> Nº </td>
		<td> Turma </td>
		<td> Sigla </td>
		<td> Curso </td>
		<td> Periodo </td>
		<td> Status </td>
	</tr>";
	if(!empty($_FILES['arquivo']['tmp_name'])){
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
				$Turma = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
				$Sigla = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
				$Curso = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
				$Periodo = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
				
				//Inserir o usuário no BD
				if($Turma=="// Contabilidade"||$Turma=="//Farmácia"||$Turma=="//Informática"||$Turma=="//Logística"||$Turma=="//Etim- Logística"||$Turma=="//Etim- Química"||$Turma=="//Transações Imobiliárias"){}else{
      			echo "	</div><tr>

		<td> $x </td>
		<td> $Turma </td>
		<td> $Sigla </td>
		<td> $Curso </td>
		<td> $Periodo </td>
		";
      try{
       $verifica2 = mysqli_query("SELECT * FROM `tb_turma` WHERE `nm_turma` ='$Turma';");

       if (mysqli_num_rows($verifica2)<=0){
 			$cadastraaluno = mysqli_query("INSERT INTO `portal_etec`.`tb_turma` (`cd_turma`, `sg_curso`, `nm_turma`, `cd_periodo`, `cd_curso`) VALUES (NULL, '$Sigla', '$Turma', '$Periodo', '$Curso');");
 			$verifica3 = mysqli_query("SELECT * FROM `tb_turma` WHERE `nm_turma` ='$Turma';");

       if (mysqli_num_rows($verifica3)<=0){
       		echo "<td>Turma $Turma não foi inserido!</td>";
        }else{
        	echo "<td>Turma $Turma foi inserido!</td>";
        	$cont++;          
        }
        }else{
			
			echo "<td>Turma $Turma Já é cadastrado!</td>";          
        }
        $x++;
     	echo "</tr>";

       
}catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}

}}
			}
			$primeira_linha = false;
		}

		echo "</table>Arquivo inserido!";
	}



?>