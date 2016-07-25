<?php

	namespace project\controller;
	
	use \framework\mvc\FrontController;
	use \framework\mvc\View;
	
	use \framework\registration\Authentification;
	use \framework\registration\Registration;
	
	  /*
	**	���������� ��� ����������� ������������ � ������ ��������� MVC ( MODEL - VIEW - CONTROLLER )
	  */
	
	class Controller extends FrontController
	{

		public function __common( View $view )
		{
		
			// �������� �������������� ������������
			session_start();
			$view->isLoggedIn = Authentification::isLoggedIn();
			$view->role_id = $_SESSION['role_id'];
		
			// ���� � �������� CSS
		
			$view->stylesheet = STYLESHEET_FOLDER;
		
			// ������ ������� ������
		
			$list = get_class_methods( $this );
		
			// ������������� ������ ����� �������� ������� ����������� 
		
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