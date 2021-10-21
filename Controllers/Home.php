	<?php 


		class Home extends Controllers{
		
			public function __construct()
			{
				parent::__construct();
				session_start();
			}

			public function home()
			{
		
			$data['page_name'] = "DistriRef";
			
				$this->views->getView($this,"home",$data); 
			}

		}
	?>