<?php
namespace App\Http\BusinessService;

use App\Http\Model\Event;
use App\Http\Utillity\MyLogger;
use App\Http\DataService\EventsDAO;
use PDO;
use PDOException;

class EventsService{
	/**
	 *
	 * @param Event $event
	 * @return boolean
	 */
	public function createEvent(Event $event){
		MyLogger::info("Entering EventsService.createEvent()");
		//database connection variables stored in config/database.php file
		$servername = config("database.connections.mysql.host");
		$port = config("database.connections.mysql.port");
		$username = config("database.connections.mysql.username");
		$password = config("database.connections.mysql.password");
		$dbname = config("database.connections.mysql.database");
		
		//Create Connection
		$db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		// $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$service = new EventsDAO($db);
		$flag = $service->createEvent($event);
		
		//in PDO you "close" the database connection by setting the PDO object to null
		$db = null;
		
		//Return the results
		MyLogger::info("Exit EventsService.createEvent() with " . $flag);
		return $flag;
	}
	
	/**
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function findEvent(int $id){
		MyLogger::info("Entering EventsService.findEvent()");
		//database connection variables stored in config/database.php file
		$servername = config("database.connections.mysql.host");
		$port = config("database.connections.mysql.port");
		$username = config("database.connections.mysql.username");
		$password = config("database.connections.mysql.password");
		$dbname = config("database.connections.mysql.database");
		
		//Create Connection
		$db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$service = new EventsDAO($db);
		$flag = $service->findEvent($id);
		
		//in PDO you "close" the database connection by setting the PDO object to null
		$db = null;
		
		//Return the results
		// MyLogger::info("Exit EventsService.findEvent() with " . $flag);
		return $flag;
	}
	
	public function getAllEvents() {
	    MyLogger::info("Entering EventsService.getAllEvents()");
	    //database connection variables stored in config/database.php file
	    $servername = config("database.connections.mysql.host");
	    $port = config("database.connections.mysql.port");
	    $username = config("database.connections.mysql.username");
	    $password = config("database.connections.mysql.password");
	    $dbname = config("database.connections.mysql.database");
	    
	    //Create Connection
	    $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    // get all events using the data service
	    $service = new EventsDAO($db);
	    $flag = $service->getAllEvents();
	    
	    //in PDO you "close" the database connection by setting the PDO object to null
	    $db = null;
	    
	    //Return the results
	    return $flag;
	}
}