<?php
class RegistroModel extends Mysql{
    private $intIdUsuario;
    private $strNombre;
    private $strApellido;
    private $strEmail;
    private $strPassword;
    private $rol;
    private $foto;
    private $intStatus = 1;
    public function __construct()
		{
			parent::__construct();
		}	
        public function insertUsuario(string $nombre, string $apellido,string $email, string $password, int $rolx, string $ufoto){
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strEmail = $email;
			$this->strPassword = $password;
            $this->rol=$rolx;
            $this->foto=$ufoto;
			$return = 0;

			$sql = "SELECT * FROM persona WHERE 
					Per_Email = '{$this->strEmail}'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO persona(Per_Nombre,Per_Apellidos,Per_Email,Per_Passwd,Per_Foto,Rol_ID,Per_Status) 
								  VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array(
        						$this->strNombre,
        						$this->strApellido,
        						$this->strEmail,
        						$this->strPassword,
        						$this->foto,
        						$this->rol,
                                $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

   
}
?>