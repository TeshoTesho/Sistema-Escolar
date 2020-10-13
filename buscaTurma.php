	<?php
	//Incluir a conexão com banco de dados
	require('conectdb.php');
	
	//Recuperar o valor da palavra
	$turma = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$turma = "SELECT * FROM  `tb_turma` WHERE  `cd_turma` = '$turma'";
		$resultado_cursos = mysqli_query($connect,$turma);
	
	if(mysqli_num_rows($resultado_cursos) <= 0){
		echo "<h1>Selecione uma turma...</h1>";
	}else{

		while($rows = mysqli_fetch_array($resultado_cursos)){
			$cdTurma = $rows['cd_turma'];
		}

		$userT = mysqli_query($connect,"SELECT * FROM  `usuario_turma` WHERE  `cd_turma` ='$cdTurma'") or die("erro ao selecionar");
 	  	
 	  	echo "<table class='table' border=1>";
            echo "<thead>";
              echo "<tr>";
                echo "<th class='border border-dark align-middle w-25'> RM: </th>";
                echo "<th class='border border-dark align-middle'>Nome do Aluno:</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
   		while($uT =mysqli_fetch_array($userT)){
   		 $cdUser=$uT['cd_rm_user']; 
   		 	$userTi = mysqli_query($connect,"SELECT * FROM  `tb_usuario` WHERE  `cd_rm_user` ='$cdUser'") or die("erro ao selecionar");
 	  		while($uTi =mysqli_fetch_array($userTi)){
   			 $nmUser=$uTi['nm_user']; 
   			}
              echo "<tr>";
                echo "<td class='border border-dark'>$cdUser</td>";
                echo "<td class='border border-dark'>$nmUser</td>";
              echo "</tr>";		 

   		}

            echo "</tbody>";
          echo "</table>";

	}
?>