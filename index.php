
<html>
	<head>
		<title>Etec Praia Grande</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="Img/favicon.ico" />
	</head>
	<body>
		<?php
			$url = (isset($_GET['url'])) ? $_GET['url']:'home';
			$url = array_filter(explode('/',$url));
			
			$file = $url[0].'.php';
			if($file=="index.php"||$file=="index"||$file=="Index"){
				$file="home.php";
			}
			if(is_file($file)){
				if($file=="Index.php"){
					include 'Home.php';
				}else{
				include $file;
			}
			}else{
				include '404.php';
				}	
					
		?>
	</body>
</html>