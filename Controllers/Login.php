<?php 


	class Login extends Controllers{
	
		public function __construct()
		{
			session_start();
			session_regenerate_id(true);
			if(isset($_SESSION['login']))
			{
				header('Location: '.base_url().'dashboard');
				die();
			}
			parent::__construct();
		}

		public function login()
		{
			$data="";
			$this->views->getView($this,"login",$data);
		}
		public function loginUser()
		{
			if($_POST){
				if(empty($_POST['username']) || empty($_POST['password'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else{
					$strUsuario  =  strtolower(strClean($_POST['username']));
					$strPassword = hash("SHA256",$_POST['password']);
					$pass=base64_encode(openssl_encrypt(KEYAES,METHOD,$strPassword,0,IV));
					$requestUser = $this->model->loginUser($strUsuario, $pass);
					
					if(empty($requestUser)){
						$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.' ); 
					}else{
						$arrData = $requestUser;
						if($arrData['Per_Status'] == 1){
							$_SESSION['idUser'] = $arrData['Per_ID'];
							$_SESSION['nombres'] = $arrData['Per_Nombre']." ".$arrData['Per_Apellidos'];
							$_SESSION['rol'] = $arrData['Rol_ID'];
							$_SESSION['foto'] = $arrData['Per_Foto'];
							$_SESSION['login'] = true;

							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							sessionUser($_SESSION['idUser']);							
							$arrResponse = array('status' => true, 'msg' => 'ok');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}
 ?>