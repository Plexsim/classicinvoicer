<?php
class Database {

	// Function to the database and tables and fill them with the default data
	function create_database($data)
	{
		$response  = array();
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['db_user'],$data['db_password'],'');

		// Check for errors
		if($mysqli->connect_errno)
		{
			$response['msg'] = 'Failed to connect to MySQL : '. $mysqli->connect_error;
			$response['success'] = false;
		}
		else  if(!$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['db_name'])){
			$response['msg'] = "Database Error : Database <b>".$data['db_name']."</b> does not exist and could not be created. Please create the Database manually and retry installing.";
			$response['success'] = false;
		}
		else
		{
			$response['success'] = true;
		}

		// Close the connection
		$mysqli->close();

		
		return $response;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['db_user'],$data['db_password'],$data['db_name']);

		// Check for errors
		if($mysqli->connect_errno){
			$message  = "Failed to connect to MySQL: " . $mysqli->connect_error;
			return false;
		}

		// Open the default SQL file
		$query = file_get_contents('assets/install.sql');

		// Execute a multi query
		if($mysqli->multi_query($query)){
			while ($mysqli->next_result()) {;}
			$this->save_company_details($data);
			$this->save_admin_details($data);
		}

		// Close the connection
		$mysqli->close();

		return true;
	}

	function save_company_details($data)
	{
		$name 		= $data['company_name'];
		$email 		= $data['company_email'];
		$currency 	= $data['currency_symbol'];

		
		// Connect to the database	
		$mysqli = new mysqli($data['hostname'],$data['db_user'],$data['db_password'],$data['db_name']);
		
		if($mysqli->connect_errno){
			$message = "Failed to connect to MySQL: " . $mysqli->connect_error;
			exit;
			return false;
		}
		// Create the prepared statement
		$table = 'ci_config';
		$qry = "INSERT INTO ".$table." (name, email, currency) VALUES ('$name', '$email', '$currency')";
	
		$mysqli->query($qry) or die($mysqli->error); 

		// Close the connection
		$mysqli->close();
	
	}

	function save_admin_details($data) 
	{
		$firstname 	= 'admin';
		$lastname	= 'admin';
		$email 		= $data['admin_email'];
		$username 	= $data['admin_username'];
		$password 	= sha1($data['admin_password']);
		$created 	= date('Y-m-d H:i:s');

		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['db_user'],$data['db_password'],$data['db_name']);
		
		if($mysqli->connect_errno){
			$message = "Failed to connect to MySQL: " . $mysqli->connect_error;
			exit;
			return false;
		}
		
		// Create the prepared statement
		$table = 'ci_users';
		$qry = "INSERT INTO ".$table." (first_name, last_name, user_email, username, password, user_date_created) VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$created')";
		
		$mysqli->query($qry);

		// Close the connection
		$mysqli->close();
	
	}
}