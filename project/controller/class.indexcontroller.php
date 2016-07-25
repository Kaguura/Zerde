<?php

	namespace project\controller;

	//use \project\model\ArticleModel;
	use \framework\mvc\View;

	###################################################################
	 ##	 MAIN PAGE  ##################################################
	###################################################################

	class IndexController extends Controller
	{
	
		public function index()
		{
			$view = $this->__common( new View( MainView ) );
			$view->title = 'Zerde | ' . 'Main Page' ;
		
			//$view->articles = ArticleModel::getArticles();
			//$view->articles_number = count( $view->articles );
		
			print $view->display();
		}
	}

?>