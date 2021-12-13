<?php
include ('Config/GoogleConf.php');
if(!empty($_SESSION)){
    header('Location:'.BASE_URL.'home');
}
$login_button = '';
if(!isset($_SESSION['access_token']))
{ 
    $login_button = '';
    if(isset($_GET["code"]))
    {
     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
     if(!isset($token['error']))
     {
      $google_client->setAccessToken($token['access_token']);
      $_SESSION['access_token'] = $token['access_token'];
      $google_service = new Google_Service_Oauth2($google_client);
      $data = $google_service->userinfo->get();
    }
}
 $login_button = '<a href="'.$google_client->createAuthUrl().'" class="login100-social-item">
 <img src="'.MEDIA_URL.'login/images/icons/icon-google.png" alt="GOOGLE">
</a>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login V9</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=MEDIA_URL?>login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="container-login100" style="background-image: url('<?=MEDIA_URL?>login/images/bg.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" id="formLogin" name="formLogin">
				<span class="login100-form-title p-b-37" >
					Inicia sesión
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa un correo valido">
					<input class="input100" type="text" name="username" id="username" placeholder="Email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Ingresa la contraseña">
					<input class="input100" type="password" name="password" id="password" placeholder="Contraseña">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit">
						Ingresar
					</button>
				</div>

				<div class="text-center p-t-57 p-b-20">
					<span class="txt1">
                    Regístrate con tu correo institucional  
					</span>
				</div>

				<div class="flex-c p-b-112">
                    <?php echo $login_button;?>
				</div>

				<div class="text-center">
					<a href="#" class="txt2 hov1">
						¿Olvidaste la contraseña?
					</a>
				</div>
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	<script>
        const base_url = "<?= base_url(); ?>";
    </script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=MEDIA_URL?>login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=MEDIA_URL?>login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>login/js/main.js"></script>
	<script src="<?=MEDIA_URL?>Basic/js/sweetalert.js"></script>
	<script src="<?=MEDIA_URL?>login/js/functions.js"></script>
</body>
</html>

