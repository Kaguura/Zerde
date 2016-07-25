<?php

	namespace framework\mvc;

	use framework\system\core;
	
  /*
**	пеюкхгюжхъ лндекх б пюлйюу оюпюдхцлш MVC ( MODEL - VIEW - CONTROLLER )
  */

	class Model
	{
	
		public $database = NULL;
	
		public function  __construct() { }
	
		public function MySQLConnect() { $this->database = Core::getInstance()->connection; }
		public function __get( $value ) { return $this->$value; }
		public function __set( $parameter, $value ) { $this->$parameter = $value; return $this; }
	
	}

?>