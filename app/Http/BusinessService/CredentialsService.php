<?php
namespace App\Http\BusinessService;

use App\Http\Model\User;
use App\Http\Utillity\MyLogger;
use PDO;
use App\Http\DataService\CredentialsDAO;

class CredentialsService{
	/**
	 * 
	 * @param User $user
	 * @return boolean
	 */
	public function login(User $user){
		MyLogger::info("Entering SecurityService.login()");
		//database connection variables stored in config/database.php file
		$servername = config("database.connections.mysql.host");
		$port = config("database.connections.mysql.port");
		$username = config("database.connections.mysql.username");
		$password = config("database.connections.mysql.password");
		$dbname = config("database.connections.mysql.database");

		
		//Create Connection
		$db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$service = new CredentialsDAO($db);
		$flag = $service->findUser($user);
	
		//in PDO you "close" the database connection by setting the PDO object to null
		$db = null;
			
		//Return the results
		MyLogger::info("Exit SecurityService.login() with " . $flag);
		return $flag;
	}
	/**
	 * 
	 * @param User $user
	 * @return boolean
	 */
	public function register(User $user){
		MyLogger::info("Entering SecurityService.login()");
		//database connection variables stored in config/database.php file
		$servername = config("database.connections.mysql.host");
		$port = config("database.connections.mysql.port");
		$username = config("database.connections.mysql.username");
		$password = config("database.connections.mysql.password");
		$dbname = config("database.connections.mysql.database");
		
		//Create Connection
		$db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$service = new CredentialsDAO($db);
		$flag = $service->createUser($user);
		
		//in PDO you "close" the database connection by setting the PDO object to null
		$db = null;
		
		//Return the results
		MyLogger::info("Exit SecurityService.login() with " . $flag);
		return $flag;
	}
	
	
}