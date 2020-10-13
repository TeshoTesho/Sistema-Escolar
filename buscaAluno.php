  <?php
  //Incluir a conexão com banco de dados
  require('conectdb.php');
  
  //Recuperar o valor da palavra
  $user = $_POST['Aluno'];
  
  //Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
  
    $resultado_cursos = mysqli_query($connect,"SELECT * FROM  `tb_usuario` WHERE  `cd_rm_user` = '$user'");
  
  if(mysqli_num_rows($resultado_cursos) <= 0){
    echo "<div class='bg-light py-4'>";
    echo "<div class='container'>";
      echo "<div class='row'>";
        echo "<div class='col-md-12'>";
          echo "<div class='card '>";
            echo "<div class='card-body p-5'>";
    echo "<h1>Digite o RM...</h1>";
    
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";
  }else{

       $verifica = mysqli_query($connect,"SELECT * FROM tb_usuario WHERE cd_rm_user = '$user'") or die("1");

      

   // User Turma
    $userT = mysqli_query($connect,"SELECT * FROM usuario_turma WHERE cd_rm_user = '$user'") or die("2");
    $cdTurma="";
    while($uT =mysqli_fetch_array($userT)){
     $cdTurmam=$uT['cd_turma']; }

     $Turma = mysqli_query($connect,"SELECT * FROM tb_turma WHERE cd_turma = '$cdTurma'") or die("3");

    while($Tr2 =mysqli_fetch_array($Turma)){ 
      $nmTurmam=$Tr2['nm_turma'];}

 while($use =mysqli_fetch_array($verifica)){
          $cdAluno=$use['cd_rm_user']; 
          $nmAluno=$use['nm_user']; 
          $CpfAluno=$use['cd_cpf']; 
          $RgAluno=$use['cd_rg']; 
          $DtAluno=$use['dt_nascimento']; 
          $EmailAluno=$use['ds_email']; 
          $TelAluno=$use['cd_telefone'];
          $EndAluno=$use['ds_endereco']; 

        
             echo "<div class='bg-light py-4'>";
    echo "<div class='container'>";
      echo "<div class='row'>";
        echo "<div class='col-md-12'>";
          echo "<div class='card '>";
            echo "<div class='card-body p-5'>";
              echo "<form action='alterandoaluno.php' method='post'>";
                echo "<div class='form-group'> ";
                echo "<label class='text-dark'>";
				echo "<b>RM:";echo "</b>";echo "<br>";echo "</label>";
                  echo "<input class='form-control w-25' name='rmuser' placeholder='Número Matrícula' value='$cdAluno'> ";echo "</div>";
                echo "<div class='form-group'> ";echo "<label class='text-dark' >Nome Completo:&nbsp;";echo "<br>";echo "</label>";
                  echo "<input class='form-control' placeholder='Nome Completo' name='nmuser'value='$nmAluno'> ";echo "</div>";
                echo "<div class='row'>";
                  echo "<div class='col-md-6'>";
                    echo "<div class='form-group'> ";echo "<label class='text-dark' >RG:&nbsp;";echo "</label>";
                      echo "<input id='rg' class='form-control' placeholder='RG' maxlength='12' OnKeyPress='formatar(this, '##.###.###-#')' name='rguser' type='text' value='$RgAluno'> ";echo "</div>";
                  echo "</div>";
                  echo "<div class='col-md-6'>";
                    echo "<div class='form-group'>"; echo "<label class='text-dark' >CPF:&nbsp;";echo "</label>";
                      echo "<input id='cpf' class='form-control' placeholder='CPF' maxlength='14' OnKeyPress='formatar(this, '###.###.###-##')' name='cpfuser' type='text' value='$CpfAluno'>"; echo "</div>";
                  echo "</div>";
                echo "</div>";
                echo "<div class='row'>";
                  echo "<div class='col-md-6'>";
                    echo "<div class='form-group'>";echo "<label class='text-dark' >Data de Nascimento:&nbsp;";echo "</label>";
                      echo "<input type='text' id='data' maxlength='10' class='form-control w-50' name='dtnascimentouser' placeholder='dd/mm/aaaa'  OnKeyPress='formatar(this, '##/##/####')' onBlur='return doDateVenc(this.id,this.value, 4);' value='$DtAluno'> ";echo "</div>";
                  echo "</div>";
                  echo "<div class='col-md-6'>";
                    echo "<div class='form-group'>"; echo "<label class='text-dark' >E-mail:&nbsp;";echo "</label>";
                      echo "<input class='form-control' placeholder='E-mail' name='emailuser' type='email' value='$EmailAluno'> ";echo "</div>";
                  echo "</div>";
                echo "</div>";
                echo "<div class='row'>";
                  echo "<div class='col-md-6'>";
                    echo "<div class='form-group'> ";echo "<label class='text-dark' >Número de Telefone:";echo "</label>";
                      echo "<input id='telefone' class='form-control' name='teluser' placeholder='(00) 3333-3333' type='text' value='$TelAluno'> ";echo "</div>";
                  echo "</div>";
                echo "</div>";
                echo "<div class='row'>";
                  echo "<div class='col-md-12'>";
                    echo "<div class='form-group'> ";echo "<label class='text-dark'>Endereço:";echo "</label>";
                      echo "<input class='form-control' placeholder='Endereço'  name='enderecouser' type='text' value='$EndAluno'> ";echo "</div>";
                  echo "</div>";
                 
                echo "</div>";
                echo "<div class='row'>";
                  echo "<div class='col-md-12'>";
                    echo "<div class='form-group'> ";echo "<label class='text-dark'>Turma:";echo "</label>";
                      echo "<br>";
                      echo "<div class='btn-group w-25'> ";echo "<select class='btn dropdown-toggle form-control' style='height: 45px;' data-toggle='dropdown' name='Turma'>";
                   echo "<option class='dropdown-item'>Selecione";echo "</option>";
                $sql = mysqli_query($connect,'SELECT * FROM  `tb_turma`');
                while ($res = mysqli_fetch_array($sql)) { 
                    $cdTurma=$res['cd_turma']; 
                    $nmTurma=$res['nm_turma'];  
                    if($cdTurma==$cdTurmam){
                      echo "<option value='$cdTurma' selected='selected' class='dropdown-item'>$nmTurma";echo "</option>';";
                    }else{
                    echo "<option value='$cdTurma' class='dropdown-item'>$nmTurma";echo "</option>';";}
                }
                            
              echo "</select>";
               echo "</div>";
                    echo "</div>";
                  echo "</div>";
                echo "</div>";
                echo "<button type='submit' class='btn mt-2 active btn-outline-danger'>Atualizar Cadastro </button>";
              echo "</form>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";


        }
      }

	
?>