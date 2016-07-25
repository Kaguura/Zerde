<?php

	namespace framework\template;
	
	use \framework\template\Template;

	###################################################################
	 ##	 MENU TEMPLATE  ###############################################
	###################################################################

	class Menu
	{
	
		private $header;
		private $navbar;
		private $menu_list;
		private $menu_item;
		
		public function __construct()
		{
			$this->element = '';
			$this->cls = array();
			$this->style = array();
			$this->field = array();
			$this->menu_list = array();
			$this->menu_item = array();
		}
	
		public function display_header()
		{
			return ( $this->header = Template::construct( 'div' )->apply( 'class', 'navbar-header' ) );
		}
	
		public function display_navbar()
		{
			return ( $this->navbar = Template::construct( 'div' )->apply( 'class', 'navbar-collapse collapse' )->apply( 'id', 'navbar' ) );
		}
	
		public function display_separator()
		{
			return Template::construct( 'li' )->apply( 'role', 'separator' )->apply( 'class', 'divider' );
		}
	
		public function display_list()
		{
			$list = new Template( 'ul' );
			$list->apply( 'class', 'nav' );
			$list->apply( 'class', 'navbar-nav' );
			return ( $list );
			
		}
	
		public function display_item()
		{
			return Template::construct( 'li' );		
		}
	
		public function display_link( $url, $content )
		{
			return Template::construct( 'a' )->apply( 'href', $url )->append( $content );
		}
		
		public function display()
		{
		//	foreach( $this->menu_list as $list )
		//	$m_list = $m_list . $list->display();
		//	echo $this->navbar->display();
			if( $this->header != NULL ) $display = $display .$this->header->display();
			if( $this->navbar != NULL ) $display = $display .$this->navbar->display();
			return $display;
		}
	}

?>