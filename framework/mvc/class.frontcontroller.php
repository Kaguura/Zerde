<?php

	namespace framework\mvc;

  /*
**	���������� ����������� � ������ ��������� MVC ( MODEL - VIEW - CONTROLLER )
  */

	class FrontController {
		
		const DEFAULT_CONTROLLER = 'IndexController';
		const DEFAULT_ACTION     = 'index';
		
		protected $data			 = array();
		
		protected $root			 = null;
		
		protected $_namespace	 = '\\framework\\controller';
		
		// ������������� ������������ �����������...
		
		public function __construct( $root = null , $namespace = null , array $construct = array() ) {
		
			// ����������� �������� ����������...
		
			$this->root = ( $root == null ) ? FRAMEWORK_ROOT_FOLDER : $root ;
		
			// ����������� ������� ���������
			
			if( $namespace == null ) {
			
				$array = explode( '\\' , $this->root );
			
				$segment = $array[count( $array ) - 1];
			
				if( is_dir( $this->root . '/controller' ) )
				{
					$this->_namespace = '\\' . $segment . '\\controller';
				}
			} else {
			
				$this->_namespace = $namespace;
			
			}
		
			// ����� ���������� �����������: ��������������, ������
		
			( empty( $construct ) ) ? $this->parse() : $this->store( $construct );
		
		}
		
		// ����� ���������� ����������, ��������� ��� ��������������
		
		protected function store( array $construct )
		{
			list( $controller , $action , $argument ) = $construct;
			$this->controller = $controller;
			$this->action	  = $action;
			$this->argument	  = explode( '/' , $argument );
		}
		
		// ����� ���������� ���������� �������������, � ������������ � ������� URL
		
		protected function parse()
		{
			$path = trim( parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_PATH ) , '/' );
			$path = preg_replace( '/[^a-zA-Z0-9]\//' , '' , $path );
			$position = strpos( $path , '/' );
			if($position > 0 ) $position++;
			$path = substr( $path , $position , strlen( $path ) );
			$this->store( explode( '/' , $path, 3 ) );
		}
		
		// ������������� ����������� ����������� � �����������
		
		public function run()
		{
			call_user_func_array( array( new $this->controller( $this->root ), $this->action ) , $this->argument );
		}
		
		// ����� ���������� �������� ��������� ���������
		
		public function __get( $parameter )
		{
			return $this->data[$parameter];
		}

		// ����� ��������� �������� �������� ��������
	
		public function __set( $parameter , $value )
		{
		
			switch( $parameter )
			{
			
				case 'controller' :
					$value = ( $value == null || $value == '' ) ? $this->_namespace . '\\' . self::DEFAULT_CONTROLLER : $this->_namespace . '\\' . ucfirst( strtolower( $value ) . 'Controller' );
					if ( !class_exists( ucfirst( strtolower( $value ) ) ) ) exit( 'The controller ' . $value . ' not found.' );
				break;
			
				case 'action' :
					$value = ( $value == null || $value == '' ) ? self::DEFAULT_ACTION : $value;
					if ( !method_exists( ucfirst( strtolower( $this->controller ) ) , $value ) ) exit( "The controller action '" . $value . "' not found." );
				break;
			
				case 'argument' :
					$value = ( $value == null ) ? array() : $value;
				break;
			
			}
			
			$this->$parameter = $value;
		
		}
	
	}

?>