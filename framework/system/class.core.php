<?php

	namespace framework\system;
	
	  /*
	**	ЯДРО СИСТЕМЫ
	  */
	
	class Core {
		
		// УКАЗАТЕЛЬ НА ТЕКУЩИЙ КЛАСС
		
		protected static $instance;
		
		// СОЕДИНЕНИЕ С БАЗОЙ ДАННЫХ
		
		public static $connection;
		
		// КЛАСС АВТОЗАГРУКИ
		
		public static $autoload;
		
		// ЦЕНТРАЛЬНЫЙ КОНТРОЛЛЕР
		
		public static $controller;
		
		// МОДЕЛЬ
		
		public static $model;
		
		// ПРЕДСТАВЛЕНИЕ
		
		public static $view;
		
		// ЗАКРЫТЫЙ КОНСТРУКТОР ОБЪЕКТА
		
		private function __construct() {
		
		}
		
		// ИНИЦИАЛИЗАЦИЯ ЯДРА СИСТЕМЫ
		
		public function init() {
		
			require_once __DIR__ . '/class.autoload.php';
		
		//	1. ИНИЦИАЛИЗАЦИЯ КЛАССА АВТОЗАГРУЗКИ
		
			$loaddata = array( 'prefix' => 'class.' );
			$autoload = new Autoload( $loaddata );
		
			$autoload->add( FRAMEWORK_ROOT_FOLDER );
			$autoload->add( PROJECT_ROOT_DIRECTORY );
		
			$autoload->register();
		
		//	2. ОСУЩЕСТВЛЕНИЕ ПОДКЛЮЧЕНИЯ К БАЗЕ ДАННЫХ
		
			//self::$instance->connection = new \framework\database\mySqlConnect( 'localhost' , 'root' , '' , 'medicalcenter_database' );
		
		//	3. ЗАГРУЗКА ШАБЛОНА ПРОЕКТИРОВАНИЯ MVC
		
			$controller = new \framework\mvc\FrontController( PROJECT_ROOT_DIRECTORY );
			$controller->run();
		
		}
		
		// МЕТОД ВОЗВРАЩАЕТ УКАЗАТЕЛЬ НА ТЕКУЩИЙ КЛАСС
		// ПРИМЕНЕНИЕ: core::getInstance()->callMethod();
		
		public static function getInstance() {
			if( is_null(self::$instance) || !self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
	}

?>