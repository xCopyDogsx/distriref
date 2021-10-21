<?php 
	class Registro extends Controllers{
	
		public function __construct()
		{
			parent::__construct();
			session_start();
		}

		public function registro()
		{
			$data="";
			$this->views->getView($this,"registro",$data);
		}
		public function completar(){
			if($_POST){
				if(empty($_SESSION['user_last_name'])){
					$arrResponse = array('status' => false, 'msg' => 'Para acceder a esta función es necesario entrar con Google :)' );
				}else{
				if(empty($_POST['nombres'])||empty($_POST['apellidos'])||empty($_POST['email'])||empty($_POST['pass'])){
					$arrResponse = array('status' => false, 'msg' => 'Todos los campos son obligatorios' );
				}else if($_POST['nombres']!=$_SESSION['user_first_name']||$_POST['apellidos']!=$_SESSION['user_last_name']||$_POST['email']!=$_SESSION['user_email_address']){
					$arrResponse = array('status' => false, 'msg' => 'Los datos básicos no coinciden con los del correo asociado' );
				}else{
					$strNombres=strClean($_POST['nombres']);
					$strApellidos=strClean($_POST['apellidos']);
					$strEmail=strClean($_POST['email']);
					$strPass=$_POST['pass'];
					$strRol=intval($_POST['Rol']);
					$rol=0;
					if($strRol==1){
						$rol=2;	
						}else if($strRol==2){
								$rol=3;
							}else if($strRol==3){
						$rol=4;
								}
					$strPassword =  empty($strPass) ? hash("SHA256",passGenerator()) : hash("SHA256",$strPass);
					$pass=base64_encode(openssl_encrypt(KEYAES,METHOD,$strPassword,0,IV));
					$request_newuser = "";
					$request_newuser = $this->model->insertUsuario($strNombres,
																	$strApellidos,
																	$strEmail,
																	$pass,
																	$rol,
																	$_SESSION['user_image']);
					if($request_newuser>0){
						if($request_newuser=='exist'){
							$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente, por favor inicie sesión (Esta se cerrará).');
						}
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al procesar la petición STATUS:500');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}
 ?>