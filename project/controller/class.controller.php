<?php

	namespace project\controller;
	
	use \framework\mvc\FrontController;
	use \framework\mvc\View;
	
	use \framework\registration\Authentification;
	use \framework\registration\Registration;
	
	  /*
	**	мюдярпнийю мюд жемрпюкэмшл йнмрпнккепнл б пюлйюу оюпюдхцлш MVC ( MODEL - VIEW - CONTROLLER )
	  */
	
	class Controller extends FrontController
	{

		public function __common( View $view )
		{
		
			// опнбепйю юсремрхтхйюжхх онкэгнбюрекъ
			session_start();
			$view->isLoggedIn = Authentification::isLoggedIn();
			$view->role_id = $_SESSION['role_id'];
		
			// осрэ й рюакхжюл CSS
		
			$view->stylesheet = STYLESHEET_FOLDER;
		
			// юмюкхг лернднб йкюяяю
		
			$list = get_class_methods( $this );
		
			// янонярюбкемхе юдпеяю осрел оепеанпю лернднб йнмрпнккепю 
		
			foreach( $list as $method )
			{ 
			
				if( $method != '__common' )
				{
				
					$name = $method . '_link';
				
					$view->$name = SERVER_ROOT_URL . '/' . $method;
				
				}
			
			}
		
			return $view;
		
		}
		
	}

?>