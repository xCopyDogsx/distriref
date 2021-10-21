<?php 


	class Logout extends Controllers{
	
		public function __construct()
		{
			parent::__construct();
			session_start();
		}

		public function logout()
		{
			$data="";
			$this->views->getView($this,"logout",$data);
		}

	}
 ?>