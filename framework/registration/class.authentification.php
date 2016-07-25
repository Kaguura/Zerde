<?php

	namespace framework\registration;

	class Authentification
	{
	
		private $id;
		private $username;
		private $password;
		private $avatar;
		private $passmd5;
		private $token;
	
		public function __construct() { }
	
		public function sessionExists()
		{
			return ( isset( $_SESSION['username'] ) && isset( $_SESSION['password'] ) );
		}
	
		public function valid_data()
		{
			return ( preg_match( '/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D', $this->username ) && preg_match( '/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D', $this->password ) );
		}
	
		public function valid_token()
		{
			return ( isset($_SESSION['token']) || $this->token == $_SESSION['token'] );
		}
	
		public function verifyDatabase()
		{
		
			$query = "SELECT id, role_id FROM users WHERE username = '" . $this->username . "' AND password = '" . $this->passmd5 . "'";
			$result = mysql_query( $query ) or die( mysql_error() );
		
			if( mysql_num_rows($result) > 0 )
			{
				while( $row = mysql_fetch_assoc( $result ) )
				{
					$this->id = $row['id'];
					$this->role_id = $row['role_id'];
				}
				return true;
			}
			return false;
		}
	
		public static function isLoggedIn()
		{
			return ( isset( $_SESSION['username'] ) && isset( $_SESSION['password'] ) && isset($_SESSION['token']) );
		}
	
		public function login( $data )
		{
			try
			{
				$this->username = preg_replace( '/[^a-zA-Z0-9@.]/', '', $data['username'] );
				$this->password = preg_replace( '/[^a-zA-Z0-9@.]/', '', $data['password'] );
				$this->passmd5  = md5( $this->password );

				if( !$this->valid_token() ) throw new \Exception( 'Unique token is already in use!' );
				if( !$this->valid_data() ) throw new \Exception( 'Invalid data input!' );
				if( !$this->verifyDatabase() ) throw new \Exception( 'Invalid username or password!' );
				
				session_start();
				$_SESSION['id'] = $this->id;
				$_SESSION['role_id'] = $this->role_id;
				$_SESSION['username'] = $this->username;
				$_SESSION['password'] = $this->password;
			}
			catch( \Exception $exception )
			{
			?>
				<div class="container wb">
					<div class="col-lg-12">
						<p class="text-center"><?=$exception->getMessage();?></p>
					</div>
				</div>
			<?php
			}
		}
	
		public static function logout()
		{
			session_start();
			session_unset();
			session_destroy();
			$_SESSION = array();
		}
	
		public static function getUsername()
		{
			return $this->username;
		}
	
	}

?>