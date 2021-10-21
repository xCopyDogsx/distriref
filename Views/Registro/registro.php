<?php
include ('Config/GoogleConf.php');
if(empty($_SESSION)){
	header('Location:'.BASE_URL.'login');
}
if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Completa tu registro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=MEDIA_URL?>registro/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>registro/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('<?=MEDIA_URL?>registro/images/bg.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" name="formRegistro" id="formRegistro">
					<span class="login100-form-title p-b-59">
						Termina tu registro
					</span>
                  
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Nombres*</span>
						<input class="input100" type="text" name="nombres" id="nombres" readonly="" value="<?=$_SESSION['user_first_name']?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<span class="label-input100">Apellidos*</span>
						<input class="input100" type="text" name="apellidos" id="apellidos" readonly="" value="<?=$_SESSION['user_last_name']?>">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" id="email" readonly="" value="<?=$_SESSION['user_email_address']?>">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Este campo es requerido">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" name="pass" id="pass" autocomplete="on" placeholder="*************">
						<span class="focus-input100"></span>
					</div>
                    <div class="flex-m w-full p-b-33">
					<div class="contact100-form-checkbox">
					<span class="label-input100">Selecciona tu rol dentro de la U</span><br/><br/>
					<select class="form-select" name="Rol" id="Rol" aria-label="Rol">
 					<option value="1" selected>Estudiante</option>
  					<option value="2">Docente</option>
  					<option value="3">Otro</option>
					</select>
					</div>
                    </div>
					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" name="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Acepto los
									<a href="#" class="txt2 hov1">
                                    Terminos y condiciones  
									</a>
								</span>
							</label>
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" onclick="send()">
								Continuar
							</button>
						</div>

						<span onclick="salir()" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Cancelar    
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		window.onload = function() {
			swal("Antes de continuar...", "Para poder ver nuestro contenido debes de completar el registro", "warning");
		};
		function salir(){
			swal({
			title: "¿Deseas cancelar el registro?",
			text: "Recuerda que puedes volver a hacer este proceso después",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			})
			.then((willDelete) => {
			if (willDelete) {
				window.location.href = "<?=BASE_URL?>logout";
			} 
						});
		}
		function send(){
			if(document.querySelector("#formRegistro")){
			let formRegistro = document.querySelector("#formRegistro");
			formRegistro.onsubmit = function(e) {
			e.preventDefault();
			let nombres=document.querySelector('#nombres').value;
			let apellidos=document.querySelector('#apellidos').value;
			let correo=document.querySelector('#email').value;
			let pass = document.querySelector('#pass').value;
			let seleccion=document.getElementById('Rol');
			let rol=seleccion.options[seleccion.selectedIndex].text;
			if(nombres==''||apellidos==''||correo==''||pass==''||rol==''){
				swal("Por favor", "Todos los datos son obligatorios.", "error");
				return false;
			}
			if(nombres!='<?=$_SESSION['user_first_name']?>'||apellidos!='<?=$_SESSION['user_last_name']?>'||correo!='<?=$_SESSION['user_email_address']?>'){
				swal("Error", "Los datos básicos no coinciden con los del correo asociado", "error");
				return false;
			}
			if (!document.getElementById('ckb1').checked)	
				{
				swal("Error", "Debes de aceptar los terminos y condiciones", "error");
				return false;
					}
			///divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl ='<?=BASE_URL?>Registro/completar'; 
				var formData = new FormData(formRegistro);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							document.querySelector('#pass').value = "";
							swal({
									title: "Atención",
									text: objData.msg,
									icon: "success",
									buttons: true,
									dangerMode: false,
									}).then((willDelete) => {
										if (willDelete) {
									window.location.href = "<?=BASE_URL?>logout";
											}else{
										window.location.href = "<?=BASE_URL?>logout";
										} 
									});
						}else{
							swal("Atención", objData.msg, "error");
							document.querySelector('#pass').value = "";
						}
					}else{
						swal("Atención","Error en el proceso", "error");
					}
					///divLoading.style.display = "none";
					return false;
				}
			}
		}
	}
		</script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=MEDIA_URL?>registro/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=MEDIA_URL?>registro/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=MEDIA_URL?>registro/js/main.js"></script>
	<script src="<?=MEDIA_URL?>Basic/js/sweetalert.js"></script>
</body>
</html>