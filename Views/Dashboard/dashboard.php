<?php
if(!empty($_SESSION)){
?>
<!doctype html>
<html>
<head>
  <title>Sesion</title>
  <meta charset=”utf-8”/>
</head>
<body>
  <h1>Hola!!</h1>
  <h2>Nombres y apellidos: <?php echo $_SESSION['nombres'];?></h2>
  <h2>Foto: </h2>
  <?php $url = $_SESSION['foto'];?>
  <img alt="300px" width="300px" src="<?php echo $url; ?>">
  
</body>
</html>  <?php 	}else{
header('Location: login');
}                    
?>