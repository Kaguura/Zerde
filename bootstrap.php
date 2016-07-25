<?php

	  /*
	**  bootstrap.php - хмхжхюкхгюжхъ мювюкэмшу оюпюлерпнб
	  */
	
		##	юдпея ондйкчвюелни дхпейрнпхх лндекеи опнейрю
	
	  	define( 'PROJECT_DIRECTORY' , 'project' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх лндекеи опнейрю
	
		define( 'MODEL_DIRECTORY' ,	'model' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх опедярюбкемхъ опнейрю
	
		define( 'VIEW_DIRECTORY' , 'view' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх йнмрпнккепнб опнейрю
	
		define( 'CONTROLLER_DIRECTORY' , 'controller' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх йнмрпнккепнб опнейрю
	
		define( 'FRAMEWORK_ROOT_FOLDER' , realpath( dirname( __FILE__ ) . '/' ) . "\\framework" );
	
		##	юдпея ондйкчвюелни дхпейрнпхх опнейрю
	
		define( 'PROJECT_ROOT_DIRECTORY' ,  realpath( dirname( __FILE__ ) . '/' ) . "\\" . PROJECT_DIRECTORY );
	
		## URL-юдпея унярю
	
		define( 'SERVER_HOST_URL' , 'http://' . $_SERVER['SERVER_NAME'] );
	
		## URL-юдпея йнпмебни дхпейрнпхх яюирю
	
		define( 'SERVER_ROOT_URL' , SERVER_HOST_URL . dirname($_SERVER['PHP_SELF']) );
	
		## URL-юдпея йнпмебни дхпейрнпхх опнейрю
	
		define( 'PROJECT_ROOT_URL' , SERVER_ROOT_URL . '/' . PROJECT_DIRECTORY );
	
		##	юдпея ондйкчвюелни дхпейрнпхх йюяйюдмшу рюакхж ярхкеи
	
		define( 'STYLESHEET_FOLDER' , PROJECT_ROOT_URL . '/' . VIEW_DIRECTORY . '/css' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх JAVASCRIPT
	
		define( 'JAVASCRIPT_FOLDER' , PROJECT_ROOT_URL . '/' . VIEW_DIRECTORY . '/js' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх хгнапюфемхи
	
		define( 'IMAGES_URL' , PROJECT_ROOT_URL . '/' . VIEW_DIRECTORY . '/images' );
	
		##	юдпея ондйкчвюелни дхпейрнпхх хгнапюфемхи
	
		define( 'IMAGES_FOLDER' , PROJECT_ROOT_DIRECTORY . '/' . VIEW_DIRECTORY . '/images' );

?>