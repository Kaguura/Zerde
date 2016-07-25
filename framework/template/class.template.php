<?php

	namespace framework\template;

	###################################################################
	 ##	TEMPLATE  #####################################################
	###################################################################

	class Template
	{
	
		protected $content;
		protected $element;
	
		protected $cls;
		protected $style;
		protected $field;
	
		protected $inline_stylesheet = array('-moz-border-bottom-colors', '-moz-border-left-colors', '-moz-border-right-colors', '-moz-border-top-colors', '-moz-linear-gradient', '-moz-orient', '-moz-radial-gradient', '-moz-user-select', '-ms-interpolation-mode', '-ms-radial-gradient', '-o-linear-gradient', '-o-object-fit', '-o-radial-gradient', '-webkit-linear-gradient', '-webkit-radial-gradient', '-webkit-user-select', 'animation-delay', 'background', 'background-attachment', 'background-clip', 'background-color', 'background-image', 'background-origin', 'background-position', 'background-position-x', 'background-position-y', 'background-repeat', 'background-size', 'border', 'border-bottom', 'border-bottom-color', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-bottom-style', 'border-bottom-width', 'border-collapse', 'border-color', 'border-image', 'border-left', 'border-left-color', 'border-left-style', 'border-left-width', 'border-radius', 'border-right', 'border-right-color', 'border-right-style', 'border-right-width', 'border-spacing', 'border-style', 'border-top', 'border-top-color', 'border-top-left-radius', 'border-top-right-radius', 'border-top-style', 'border-top-width', 'border-width', 'bottom', 'box-shadow', 'box-sizing', 'caption-side', 'clear', 'clip', 'color', 'column-count', 'column-gap', 'column-rule', 'column-width', 'columns', 'content', 'counter-increment', 'counter-reset', 'cursor', 'direction', 'display', 'empty-cells', 'filter', 'float', 'font', 'font-family', 'font-size', 'font-stretch', 'font-style', 'font-variant', 'font-weight', 'hasLayout', 'height', 'hyphens', 'image-rendering', 'left', 'letter-spacing', 'line-height', 'list-style', 'list-style-image', 'list-style-position', 'list-style-type', 'margin', 'margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'max-height', 'max-width', 'min-height', 'min-width', 'opacity', 'orphans', 'outline', 'outline-color', 'outline-offset', 'outline-style', 'outline-width', 'overflow', 'overflow-x', 'overflow-y', 'padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top', 'page-break-after', 'page-break-before', 'page-break-inside', 'position', 'quotes', 'resize', 'right', 'scrollbar-3dlight-color', 'scrollbar-arrow-color', 'scrollbar-base-color', 'scrollbar-darkshadow-color', 'scrollbar-face-color', 'scrollbar-highlight-color', 'scrollbar-shadow-color', 'scrollbar-track-color', 'tab-size', 'table-layout', 'text-align', 'text-align-last', 'text-decoration', 'text-decoration-color', 'text-decoration-line', 'text-decoration-style', 'text-indent', 'text-overflow', 'text-shadow', 'text-transform', 'top', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-property', 'transition-timing-function', 'unicode-bidi', 'vertical-align', 'visibility', 'white-space', 'widows', 'width', 'word-break', 'word-spacing', 'word-wrap', 'writing-mode', 'z-index', 'zoom');
	
		public function __construct( $tag )
		{
			$this->element = $tag;
			$this->cls = array();
			$this->style = array();
			$this->field = array();
		}
		
		public static function construct( $tag )
		{
			return new Template( $tag );
		}
	
		public function apply( $attribute, $value )
		{
			if( in_array( $attribute, $this->inline_stylesheet ) )
			{
				$this->style[$attribute] = $value;
			}
			else
			if( $attribute == 'class' ) $this->cls[] = $value;
			else
			$this->field[$attribute] = $value;
		
			return $this;
		}
	
		public function append( $content )
		{
			$this->content = $this->content . $content;
			return $this;
		}
		
		public function display()
		{
			if( count($this->cls) > 0 )
			{
			$display_cls = ' class = "';
			foreach( $this->cls as $c )
			$display_cls .= $c . ' ';
			$display_cls .= '"';
			}
			if( count($this->style) > 0 )
			{
			$display_stl = ' style = "';
			foreach( $this->style as $k => $v )
			$display_stl .= $k . ':' . $v . ';';
			$display_stl .= '"';
			}
			if( count($this->field) > 0 )
			{
			$display_fld = ' ';
			foreach( $this->field as $k => $v )
			$display_fld .= $k . '="' . $v . '" ';
			}
			return '<' . $this->element . $display_cls . $display_stl . $display_fld . '>' . $this->content . '</' . $this->element . '>';
		}
	
	}

?>