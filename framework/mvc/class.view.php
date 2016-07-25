<?php

	namespace framework\mvc;

  /*
**	пеюкхгюжхъ опедярюбкемхъ б пюлйюу оюпюдхцлш MVC ( MODEL - VIEW - CONTROLLER )
  */

class View
{
	
	// рейсыее опедярюбкемхе
	
    private $view = null;
	
	// бмсрпеммхе ябниярбю назейрю
	
	private $data = array();
	
	// хмхжхюкхгюжхъ опедярюбкемхъ
	
	public function __construct( $view = null )
	{
	
		( $view != null || strlen( $view ) > 0 ) ? $view = $view . '.php' : exit;
		  $view = PROJECT_ROOT_DIRECTORY . '/' . VIEW_DIRECTORY . '/' . $view;
		( file_exists( $view ) ) ? $this->view = $view : exit;
	
	}
	
	// лернд нясыеярбкъер бшбнд дюммшу мю щйпюм
	
	public function display()
	{
	
		if( $this->view != null || strlen( $this->view ) > 0 )
		{
		
			extract( $this->data );
		
			ob_start();
			
			require_once( $this->view );
			
			return ob_get_clean();
		
		}
	
	}
	
    // хглемхрэ меназъбкеммне ябниярбн назейрю - опедярюбкемхе
	
    public function __set( $property , $value )
    {
	
        if ( !isset( $this->$property ) )
        {
            $this->data[$property] = $value;
        }
	
    }
	
    // хглемхрэ меназъбкеммне ябниярбн назейрю - опедярюбкемхе
	
    public function __get( $property )
    {
	
        if (isset( $this->data[$property] ) )
        {
            return $this->data[$property];
        }
	
    }

}

?>