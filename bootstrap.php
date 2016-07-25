<?php

	  /*
	**  bootstrap.php - ������������� ��������� ����������
	  */
	
		##	����� ������������ ���������� ������� �������
	
	  	define( 'PROJECT_DIRECTORY' , 'project' );
	
		##	����� ������������ ���������� ������� �������
	
		define( 'MODEL_DIRECTORY' ,	'model' );
	
		##	����� ������������ ���������� ������������� �������
	
		define( 'VIEW_DIRECTORY' , 'view' );
	
		##	����� ������������ ���������� ������������ �������
	
		define( 'CONTROLLER_DIRECTORY' , 'controller' );
	
		##	����� ������������ ���������� ������������ �������
	
		define( 'FRAMEWORK_ROOT_FOLDER' , realpath( dirname( __FILE__ ) . '/' ) . "\\framework" );
	
		##	����� ������������ ���������� �������
	
		define( 'PROJECT_ROOT_DIRECTORY' ,  realpath( dirname( __FILE__ ) . '/' ) . "\\" . PROJECT_DIRECTORY );
	
		## URL-����� �����
	
		define( 'SERVER_HOST_URL' , 'http://' . $_SERVER['SERVER_NAME'] );
	
		## URL-����� �������� ���������� �����
	
		define( 'SERVER_ROOT_URL' , SERVER_HOST_URL . dirname($_SERVER['PHP_SELF']) );
	
		## URL-����� �������� ���������� �������
	
		define( 'PROJECT_ROOT_URL' , SERVER_ROOT_URL . '/' . PROJECT_DIRECTORY );
	
		##	����� ������������ ���������� ��������� ������ ������
	
		define( 'STYLESHEET_FOLDER' , PROJECT_ROOT_URL . '/' . VIEW_DIRECTORY . '/css' );
	
		##	����� ������������ ���������� JAVASCRIPT
	
		define( 'JAVASCRIPT_FOLDER' , PROJECT_ROOT_URL . '/' . VIEW_DIRECTORY . '/js' );
	
		##	����� ������������ ���������� �����������
	
		define( 'IMAGES_URL' , PROJECT_ROOT_URL . '/' . VIEW_DIRECTORY . '/images' );
	
		##	����� ������������ ���������� �����������
	
		define( 'IMAGES_FOLDER' , PROJECT_ROOT_DIRECTORY . '/' . VIEW_DIRECTORY . '/images' );

?>