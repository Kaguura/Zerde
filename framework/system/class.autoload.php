<?php

	namespace framework\system;

	  /*
	**  КЛАСС АВТОЗАГРУЗКИ. ОБЕСПЕЧИВАЕТ АВТОМАТИЧЕСКУЮ ЗАГРУЗКУ ОТДЕЛЬНЫХ КЛАССОВ И ИНТЕРФЕЙСОВ
	  */

	//	ПОДДЕРЖИВАЕМЫЕ СВОЙСТВА:

		//	namespace	- ПРОСТРАНСТВО ИМЕН
		//	pathname	- ОБЛАСТЬ ВИДИМОСТИ
		//	separator	- РАЗДЕЛИТЕЛЬ ДЕРИКТОРИЙ
		//	extension	- РАСШИРЕНИЕ ИСКОМОГО ФАЙЛА
		//	prefix		- ПРЕФИКС ИМЕНИ КЛАССА
		//	postfix		- ПОСТФИКС ИМЕНИ КЛАССА
		
		//	root		- КОРНЕВАЯ ДИРЕКТОРИЯ ПОИСКА

	class Autoload
	{
	
	// public :
	
		public $extension;
		public $separator;
		public $prefix;
		public $postfix;
	
	// private :
	
		private $data = array();
		private $root = array();
	
	
		// МЕТОД ИНИЦИАЛИЗАЦИИ КЛАССА
	
		public function __construct( $construct = null )
		{
		
			// ИНИЦИАЛИЗАЦИЯ СВОЙСТВ ОБЪЕКТА АВТОЗАГРУЗКИ
		
			if( count( $this->root ) == 0 ) $this->add( FRAMEWORK_ROOT_FOLDER );
			
			$this->separator = ( isset( $construct['separator'] ) ) ? $construct['separator'] : '\\';
			$this->extension = ( isset( $construct['extension'] ) ) ? $construct['extension'] : 'php';
			
			$this->prefix	 = ( isset( $construct['prefix'] ) )	? $construct['prefix']	 : null;
			$this->postfix	 = ( isset( $construct['postfix'] ) )	? $construct['postfix']	 : null;
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ АВТОМАТИЧЕСКОЕ ПОДКЛЮЧЕНИЕ ВЫЗЫВАЕМОГО КЛАССА 
		
		public function load( $class ) {
		
			try {
			
				$path = $this->direct_download( $class );
				
				if( isset( $path ) && $path != null ) {
				
					require_once $path;

				} else {
				
					throw new \Exception( 'File ' . $class . ' not found! Operation cancelled.' );
				
				}
			
			}
			
			catch ( \Exception $event ) {
			
				$event->getMessage();
			
			}
			
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ 
		
		private function direct_download( $class ) {
		
			$temp = explode( '\\' , $class );
			$name = $temp[count( $temp )-1];
		
			if( $this->prefix != null )  $name = $this->prefix . $name;
			if( $this->postfix != null ) $name = $name . $this->postfix;
			$class = str_replace( $temp[count($temp)-1] , $name , $class );
		
			foreach( $this->root as $rootpath ) {
			
				$root = str_replace( $this->separator , '/' , $rootpath );
			
				$filename = str_replace( $this->separator , '/' , $class );
			
				$folder = explode( '/' , $filename );
			
				$path = strrpos( $root , $folder[0] );
			
				$path = substr( $root , 0 , strrpos( $root , $folder[0] ) );
			
				if( $path == null ) continue;
			
				$path .= $filename . '.' . $this->extension;
				if( file_exists( $path ) ) return $path;
			
			}
		
			return null;
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ПРОВЕРКУ СУЩЕСТВОВАНИЯ ФАЙЛА
		
		private function _require( $directory , $filename ) {
		
			echo $directory . ' - ' . $filename . '<br />';
		
			// ЗАГРУЗКА МЕНЕДЖЕРА ФАЙЛОВ
				
			$filemanager = new \framework\core\FileManager;
			
			// ПОИСК ФАЙЛА В ДИРЕКТОРИИ...
			
			$configuration = $filemanager->search( $directory , $filename );
			
			if ( $configuration != null ) {
			
				foreach ( $configuration as $path ) {
				
					if( file_exists( $path ) ) return $path;
				
				}
			
			}
			
			return null;
		
		}
		
		// -- ------------------------------------------- -- \\
		// -- ---------- SPL AUTO-LOAD LIBRARY ---------- -- \\
		// -- ------------------------------------------- -- \\
		
		// МЕТОД РЕГИСТРИРУЕТ ФУНКЦИЮ АВТОЗАГРУЗКИ ФАЙЛОВ В СТЕКЕ
		
		public function register()
		{
		
			spl_autoload_register( array( $this , 'load' ) );
		
		}
		
		// МЕТОД УДАЛЯЕТ ФУНКЦИЮ ИЗ СТЕКА АВТОЗАГРУЗКИ
		
		public function unregister()
		{
		
			spl_autoload_unregister( array( $this , 'load' ) );
		
		}
		
		// -- ------------------------------------------- -- \\
		// -- ------------ STACK  MANAGEMENT ------------ -- \\
		// -- ------------------------------------------- -- \\
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ДОБАВЛЕНИЕ ЭЛЕМЕНТА В СТЭК
		
		public function add( $value ) {
			
			$number = count($this->root);
			
			if( !in_array( $value , $this->root ) ) $this->root[$number] = $value;
			
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ УДАЛЕНИЕ ЭЛЕМЕНТА ИЗ СТЭКА
		
		public function remove( $value ) {
		
			for( $i = 0; $i < count( $this->root ); $i++ ) {
			
				if( $this->root == $value ) $this->root[$i] = null; 
			
			}
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ УДАЛЕНИЕ ВСЕХ ЭЛЕМЕНТОВ ИЗ СТЭКА
		
		public function clear() {
			
			for( $i = 0; $i < count( $this->root ); $i++ ) {
			
				$this->root[$i] = null;
			
			}
			
		}
		
		// -- ------------------------------------------- -- \\
		// -- ------------ GETTERS / SETTERS ------------ -- \\
		// -- ------------------------------------------- -- \\
		
		
		// МЕТОД ВОЗВРАЩАЕТ ЗАДАННЫЙ ПАРАМЕТР
		
		public function __get( $parameter ) {
		
			return $this->data[$parameter];
		
		}

		// МЕТОД ИЗМЕНЯЕТ ЗАДАННЫЙ ПАРАМЕТР
		
		public function __set( $parameter , $value ) {
		
			$this->data[$parameter] = $value;
			
			return $this;
		
		}
		
	}

?>