<?php 


	class Login extends Controllers{
	
		public function __construct()
		{
			parent::__construct();
			session_start();
		}

		public function login()
		{
			$data="";
			$this->views->getView($this,"login",$data);
		}

	}
 ?>