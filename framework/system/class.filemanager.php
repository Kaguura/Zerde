<?php

	namespace framework\system;

	  /*
	**  КЛАСС МЕНЕДЖЕРА ФАЙЛОВ. ПРОИЗВОДИТ ОТКРЫТИЕ, ЗАМЕНУ, УДАЛЕНИЕ ФАЙЛА И ОТДЕЛЬНЫХ ЕГО ЧАСТЕЙ
	  */

	class FileManager {

		public function FileManager() {
		
		}
		
		// МЕТОД ВЫПОЛНЯЕТ ОТКРЫТИЕ УКАЗАННОГО ФАЙЛА
		// 	- $path - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		// 	- $type - МЕТОД ДОСТУПА К ФАЙЛУ
		
		public static function open( $path , $type ) {

			switch( $type ) {
			
			// file - ВОЗВРАЩАЕТ СОДЕРЖИМОЕ ФАЙЛА В ВИДЕ МАССИВА
			
				case 'file' :
					(file_exists( $path )) ? $content = file( $path ) : exit();
				break;
				
			// file - ВОЗВРАЩАЕТ СОДЕРЖИМОЕ ФАЙЛА В ВИДЕ СТРОКИ
			
				case 'fgets' :
					(file_exists( $path )) ? $fopen = fopen( $path , 'r' ) : exit();
						while ( !feof( $fopen ) ) $content = fgets( $fopen , filesize( $path ) );
						fclose($fopen);
				break;
				
			// file_get_contents - ВОЗВРАЩАЕТ СОДЕРЖИМОЕ ФАЙЛА В ВИДЕ СТРОКИ
			
				case 'file_get_contents' :
					(file_exists( $path )) ? $content = file_get_contents( $path ) : exit();
				break;
			
			// fread - ВОЗВРАЩАЕТ СОДЕРЖИМОЕ ФАЙЛА В ВИДЕ СТРОКИ
				
				case 'fread' :
					(file_exists( $path )) ? $fopen = fopen( $path , 'r' ) : exit();
						$content = fread( $fopen , filesize( $path ) );
						fclose($fopen);
				break;
				
			}
			
			return $content;
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ПОИСК ПОДСТРОКИ В ФАЙЛЕ
		// С ПОСЛЕДУЮЩЕЙ ЗАМЕНОЙ
		
		public static function change( $path , $line , $replace ) {
			
			$array = self::open( $path , 'file' );
			
			foreach($array as $key => $value)
			{
				if(substr_count($value , $line))
				{
					array_splice( $array , $key , 1 , $replace );
				}
			
			$open = fopen( $path , "w" );
				
				for( $i = 0; $i < count( $array ); $i++ )
				{
					fwrite( $open , $array[$i] );
				}
				fclose( $open );
			}
			
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ЗАМЕНУ ПОДСТРОКИ В СТРОКЕ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		//  - $param - ИСКОМАЯ ПОДСТРОКА
		// 	- $value - МАССИВ СТРОК ДЛЯ ЗАПИСИ
		
		public static function replace( $path , $parameter , $value ) {
			
			$file = self::open( $path , 'file_get_contents' );
			
			$file = str_replace ( $parameter, $value , $file );
			
			file_put_contents ( $path , $file );
		
		}
		
		// МЕТОД ВОЗВРАЩАЕТ НОМЕР СТРОКИ ПО КЛЮЧЕВОМУ СЛОВУ В СТРОКЕ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		//  - $param - ИСКОМАЯ ПОДСТРОКА
		
		public static function line_number( $path , $parameter ) {
			
			$file = self::open( $path , 'file' );
			
			foreach( $file as $key => $value)
			{
				if ( substr_count( $value , $parameter ) )
				{
					return $key;
				}
			}
			
			return null;
			
		}
		
		// МЕТОД ВОЗВРАЩАЕТ МАССИВ СТРОК ОТ НАЧАЛЬНОГО ДО
		// КОНЕЧНОГО ЗНАЧЕНИЯ ЧИСЛА СТРОК В УКАЗАННОМ ФАЙЛЕ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		//  - $start - НОМЕР НАЧАЛЬНОЙ СТРОКИ
		//	- $end	 - НОМЕР КОНЕЧНОЙ СТРОКИ
		
		public static function line_block( $path , $start , $end ) {
			
			$array = array();
			
			$file = self::open( $path , 'file' );
			
			for( $i = $start; $i <= $end; $i++ ) {
				
				$array[ count( $array ) ] = $file[$i];
				
			}
			
			return $array;
			
		}
		
		// МЕТОД ВОЗВРАЩАЕТ СТРОКУ ОТ НАЧАЛЬНОГО ДО
		// КОНЕЧНОГО ЗНАЧЕНИЯ ПАРАМЕТРА В УКАЗАННОМ ФАЙЛЕ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		//  - $pm_1	 - НАЧАЛЬНЫЙ СТРОКОВОЙ ПАРАМЕТР
		//	- $pm_2	 - КОНЕЧНЫЙ СТРОКОВОЙ ПАРАМЕТР
		
		public static function string_block( $path , $pm_1 , $pm_2 ) {
		
			$file = self::open( $path , 'file_get_contents' );
		
			$offset_1 = strpos( $file , $pm_1 );
			$offset_2 = strpos( $file , $pm_2 );
		
			$result = abs( $offset_2 - $offset_1 );
		
			return substr( $file , $offset_1 + strlen($pm_1) , $result - strlen($pm_1) );
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ СОЗДАНИЕ ДИРЕКТОРИИ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ КАТАЛОГУ
		
		public static function makedir( $path , $rights = '0777' ) {
		
			if( !file_exists( $path ) ) mkdir( $path , $rights );
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ УДАЛЕНИЕ ДИРЕКТОРИИ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ КАТАЛОГУ
		
		public static function removedir( $path ) {
		
			if( file_exists( $path ) ) rmdir( $path );
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ НАХОЖДЕНИЕ ВСЕХ ПАПОК В ДИРЕКТОРИИ
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ КАТАЛОГУ
		
		public static function scanfordir( $path ) {
		
			// ПРОВЕРКА СУЩЕСТВОВАНИЯ УКАЗАННОЙ ДИРЕКТОРИИ...
		
			if( !is_dir( $path ) ) return null;
		
			$skip = array( '.' , '..' );
			
			$array = array();
		
			$directory_list = scandir( $path );
			
			foreach( $directory_list as $directory ) {
			
				if(!in_array( $directory , $skip ) ) $array[count($array)] = $directory;
			
			}
		
			if( count( $array ) > 0 ) return $array;
		
			return null;
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ЗАПИСЬ УКАЗАННОГО ФАЙЛА
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		// 	- $value - МАССИВ СТРОК ДЛЯ ЗАПИСИ
		
		public static function create( $path , $value ) {
		
			if( !file_exists( $path ) ) file_put_contents( $path , $value );
		
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ПЕРЕЗАПИСЬ УКАЗАННОГО ФАЙЛА
		// 	- $path  - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		// 	- $value - МАССИВ СТРОК ДЛЯ ЗАПИСИ
		
		public static function rewrite( $path , $value ) {
			
			file_put_contents( $path , $value );
			
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ УДАЛЕНИЕ УКАЗАННОГО ФАЙЛА
		// 	- $path - АБСОЛЮТНЫЙ ПУТЬ К ЗАДАННОМУ ФАЙЛУ
		
		public static function delete( $path ) {
			(file_exists( $path )) ? unlink( $path ) : exit();
		}
		
		// МЕТОД ОСУЩЕСТВЛЯЕТ ПОИСК УКАЗАННОГО ФАЙЛА В ДИРЕКТОРИИ
		// 	- $directory - СУЩЕСТВОВАНИЕ ДИРЕКТОРИИ (ОТСУТСТВИЕ - null)
		//	- $filename  - СУЩЕСТВОВАНИЕ ФАЙЛА (ОТСУТСТВИЕ - null)
		
		public static function search( $directory , $filename = null ) {
		
			if(!$array) $array = array();
		
			// ПРОВЕРКА СУЩЕСТВОВАНИЯ УКАЗАННОЙ ДИРЕКТОРИИ...
			
			if(!is_dir($directory)) return null;
			
			// ЕСЛИ ИСКОМЫЙ ФАЙЛ НЕ ОПРЕДЕЛЕН - ВОЗВРАЩАЕМ 
			// ЛИШЬ СУЩЕСТВУЮЩУЮ ДИРЕКТОРИЮ
			
			if(!$filename) return $directory;
			
			// ПОИСК ФАЙЛА (ВКЛЮЧАЕТ ВОЗМОЖНЫЕ ПОДДИРЕКТОРИИ)
			
			$opendirectory = opendir( $directory );
			   
			while ( ( $file = readdir( $opendirectory ) ) !== false ) {
			
				if( $file == "." || $file == ".." ) continue;    
			
				// ЕСЛИ ФАЙЛ С ЗАДАННЫМ ИМЕНЕМ СУЩЕСТВУЕТ - ВОЗВРАЩАЕМ ПУТЬ 
				
				if ( $file == $filename ) $array[] = $directory . '/' . $file; 
				
			// ДОПОЛНЕНИЕ: НАХОЖДЕНИЕ ФАЙЛА С ИСПОЛЬЗОВАНИЕМ is_file - РЕСУРСОЗАТРАТНО
				
			//	if( is_file( $directory . '/' . $filename ) ) $array[] = $directory . '/' . $filename;
			
			//	if( is_file( $directory . '/' . $file . '/' . $filename ) ) $array[] = $directory . '/' . $file . '/' . $filename;
					
				// ЕСЛИ ФАЙЛ НЕ ОБНАРУЖЕН - УЕЛИЧИВАЕМ ГЛУБИНУ ПОИСКА
			
				if( is_dir( $directory . '/' . $file ) ) $recursion = self::search( $directory . '/' . $file , $filename );
				
				if($recursion) return $recursion;
					
			}
			
			closedir($opendirectory);
			
			if(count($array) > 0) return $array;
			
			return null;
			
		}
		
		// МЕТОД #2 ОСУЩЕСТВЛЯЕТ ПОИСК УКАЗАННОГО ФАЙЛА В ДИРЕКТОРИИ
		// 	- $directory - СУЩЕСТВОВАНИЕ ДИРЕКТОРИИ (ОТСУТСТВИЕ - null)
		//	- $filename  - СУЩЕСТВОВАНИЕ ФАЙЛА (ОТСУТСТВИЕ - null)
		
		public static function search_2( $directory , $filename) { 
			
			$array = array_diff( scandir( $directory ), Array( '.' , '..' ) );     
			
			foreach( $array as $file ) {
				
				if( !is_dir( $directory . '/' . $file ) ) { 
				
					if ( $file == $filename ) return $directory . '/' . $file; 
					
				} else { 
				
					$res = self::search_2( $directory . '/' . $file , $filename ); 
					
					if ( $res ) return $res; 
					
				} 
			} 
			return false; 
		}
	}

?>