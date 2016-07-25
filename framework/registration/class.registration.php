<?php

	namespace framework\registration;

	class Registration
	{

		private $username;
		private $password;
		private $passmd5;
		
		private $errors;
		private $token;
		
		public function __construct( $data )
		{
		
			$this->errors = array();
			$this->username = $this->filter($data['username']);
			$this->password = $this->filter($data['password']);
			$this->token = $data['token'];
			$this->passmd5 = md5($this->password);
		
		}
		
		public function process()
		{
			if( $this->valid_token() && $this->valid_data() )
				$this->register();
			return ( count( $this->errors ) > 0 ) ? false : true;
		}
		
		public function filter( $var )
		{
			return preg_replace( '/[^a-zA-Z0-9@.]/', '', $var );
		}
		
		public function register()
		{
			$query = "INSERT INTO users(id, username, password, role_id) VALUES ( NULL , '$this->username', '$this->passmd5', '2')";
			$result = mysql_query( $query ) or die( mysql_error() );
			if( mysql_affected_rows() < 1 )
			{
				$this->errors[] =  'Registration process failed!';
			}
		}
		
		public function setPassword( $id , $value )
		{
			$this->password = $value;
			$this->passmd5 = md5($this->password);
			$query = "UPDATE users SET password='" . $this->passmd5 . "' WHERE id='" . $id . "'";
			$result = mysql_query( $query ) or die( mysql_error() );
			if( mysql_affected_rows() < 1 )
			{
				$this->errors[] =  'Registration process failed!';
			}
		}
		
		public function show_errors()
		{
			echo '<h3 style="#d2d2d2">Connection failed!</h3>';
		
			foreach( $this->errors as $key => $value )
			{
				echo '<p style="color:red">' . $value . '</p><br />';
			}
		}
		
		public function valid_data()
		{
		
			if( empty($this->username) )
				$this->errors[] = '"Username" field should be filled in!';
			if( empty($this->password) )
				$this->errors[] = '"Password" field should be filled in!';
		
			$query = "SELECT id FROM users WHERE username='$this->username'";
			$result = mysql_query( $query ) or die( mysql_error() );
			if( mysql_num_rows($result) )
				$this->errors[] = 'Username is already taken!';
			return ( count( $this->errors ) > 0 ) ? false : true;
		
		}
		
		public function valid_token()
		{
		
			if( !isset( $_SESSION['token'] ) || $this->token != $_SESSION['token'] )
			{
				$this->errors[] = 'Invalid submition';
			}
			return ( count( $this->errors ) > 0 ) ? false : true;
		
		}

	}

?>