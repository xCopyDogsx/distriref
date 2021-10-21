<?php 
	
	class Views
	{
		function getView($controller,$view,$data="")
		{
			$controller = get_class($controller);
			if($controller == "Home"){
				
				$view = "Views/".$view.".php";
			}else{
				$view = "Views/".$controller."/".$view.".php";
			}
			if(file_exists($view)){
				require_once ($view);
			}else{
				echo ("Error al cargar la vista solicitada");
			}
			
		}
	}

 ?>