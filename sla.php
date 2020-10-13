<?php 

$y=2;
if($y==2){
require("conectdb.php");
$verifica = mysqli_query($connect,"SELECT * FROM tb_usuario ") or die("erro ao selecionar");

echo "<table border=1;'>";
echo "<tr><td>NOME</td><td>RM</td><td>USER CP</td><td>SENHA</td></tr>";
while($Sol =mysqli_fetch_array($verifica)){
$cdUser=$Sol['cd_rm_user'];
$cdUserCP=$Sol['cd_rm_user_cp'];
$cdUserPASS=$Sol['cd_password_user'];
$nmUser=$Sol['nm_user'];

echo "<tr>";
echo "<td>".$nmUser."</td>";
echo "<td>".$cdUser."</td>";
echo "<td>".$cdUserCP."</td>";
echo "<td>".$cdUserPASS."</td>";
echo "</tr>";



if($cdUserCP==""){
$u=$cdUser;
echo $u."<br>";
$u2="";
$u=str_split($u);
print_r($u); 
foreach ($u as $value) {
  $u2.=(ord($value))."-"; 
}
if($cdUser==123456){$senhamd5=md5(123);}else{ $senhamd5=md5($cdUserPASS);}

$altera = mysqli_query($connect,"UPDATE `tb_usuario` SET  `cd_rm_user_cp` =  '$u2',`cd_password_user` = '$senhamd5' WHERE `cd_rm_user` ='$cdUser'");}


	}	

}else{header("Location: home");}

?>