<?php

	namespace framework\database;

	// КЛАСС. ОСУЩЕСТВЛЯЕТ ПОДКЛЮЧЕНИЕ И ОСУЩЕСТВЛЕНИЕ ДРУГИХ ЗАПРОСОВ К БАЗЕ ДАННЫХ.
	// ИСПОЛЬЗУЕТ ПАТТЕРН SINGLETON. ПОДДЕРЖИВАЕТ ОДИН ЭКЗЕМПЛЯР ОБЪЕКТА ЕДИНОВРЕМЕННО.
	
		// ДАННЫЕ НЕОБХОДИМЫЕ ДЛЯ ПОДКЛЮЧЕНИЯ К БАЗЕ ДАННЫХ:
		// $hostname	ЛОКАЛЬНЫЙ / ВНЕШНИЙ ХОСТ
		// $database	БАЗА ДАННЫХ
		// $username	ПОЛЬЗОВАТЕЛЬ
		// $password	ПАРОЛЬ
		// ПЕРЕМЕННЫЕ СУЩЕСТВУЮТ НА ПРОТЯЖЕНИИ ВСЕГО СУЩЕСТ-
		// ВОВАНИЯ КЛАССА ОБЪЕКТА.
	
	class mySqlConnect
	{
	
		// ВНЕШНИЙ sql-ЗАПРОС
	
		public $sql;
	
		private $hostname;
		private $database;
		private $username;
		private $password;
	
		private $connection;
	
		// КОНСТРУКТОР КЛАССА ОБРАБОТКИ ЗАПРОСОВ К БАЗЕ ДАННЫХ
	
		public function __construct( $hostname , $username , $password , $database ) {
		
			$this->hostname = $hostname;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;
		
			// СОЕДИНЕНИЕ С БАЗОЙ ДАННЫХ
		
			$this->connect();
		
		}
	
		// МЕТОД ПРОИЗВОДИТ СОЕДИНЕНИЕ С БАЗОЙ ДАННЫХ
	
		private function connect() {
		
			$this->connection = mysql_connect( $this->hostname, $this->username, $this->password ) or die( mysql_error() );
		
			mysql_select_db( $this->database , $this->connection ) or die( mysql_error() );
		
		}
	
		// МЕТОД ВЫПОЛНЯЕТ ВВЕДЕННЫЙ ИЗВНЕ ЗАПРОС
	
		public function query( $q ) {
		
			return mysql_query( $q );
		
		}
	
		// МЕТОД ВОЗВРАЩАЕТ АССОЦИАТИВНЫЙ МАССИВ ЭЛЕМЕНТОВ ТЕКУЩЕГО ЗАПРОСА
	
		public function fetch() {
		
			while ( $row = mysql_fetch_assoc( $this->sql ) ) {
			
				return $row;
			
			}
		
		}
	
		// МЕТОД ВЫСВОБОЖДАЕТ ВСЮ ПАМЯТЬ, ЗАНИМАЕМУЮ РЕЗУЛЬТАТОМ
		public function free() {
		
			mysql_free_result( $this->sql );
		
		}
	
	}

?>