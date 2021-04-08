<?php
namespace App\Http\DataService;

use App\Http\Model\Event;
use App\Http\Utillity\DatabaseException;
use App\Http\Utillity\MyLogger;
use Illuminate\Contracts\Session\Session;
use PDO;
use PDOException;

class EventsDAO{
	
	private $conn;
	public function __construct($conn){
		$this->conn = $conn;
	}
	
	/**
	 * creates an event in database and returns true if it was added successfully
	 * @param Event $event
	 * @throws DatabaseException
	 * @return boolean
	 */
	public function createEvent(Event $event){
		MyLogger::info("Entering EventsDAO.createEvent()");
		
		try{
			//select info about event 
			// url title date description
			$url = $event->getUrl();
			$title = $event->getTitle();
			$date = $event->getDate();
			$description = $event->getDescription();
			//create a prepared statment. Pass valus by binding pararmeters one by one
			$stmt = $this->conn->prepare("INSERT INTO events (ID, URL, TITLE, DATE, DESCRIPTION) VALUES (null,?, ?, ?, ?)");
			$stmt->bindParam(1, $url);
			$stmt->bindParam(2, $title);
			$stmt->bindParam(3, $date);
			$stmt->bindParam(4, $description);
			$stmt->execute();
			
			//check if changes were made
			if ($stmt->rowCount() == 1){
				MyLogger::info("Exit EventsDAO.createEvent() with true");
				return true;
			}else{
				MyLogger::info("Exit EventsDAO.createEvent() with false");
				return false;
			}
		}catch (PDOException $e){
			//log exception and throw a custom exception
			MyLogger::error("Exception: ", array("message" => $e->getMessage()));
			throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
		}
	}
	
	/**
	 * finds users in database and returns true if found
	 * @param Event $event
	 * @throws DatabaseException
	 * @return boolean
	 */
	public function findEvent(int $id){
		MyLogger::info("Entering EventsDAO.findEvent()");
		
		try{			
			$stmt = $this->conn->prepare("SELECT * FROM events WHERE ID = :id LIMIT 1");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			//See if user existed and return true if found else return false if not found
			//Bad practice: this is a business rules in our DAO
			if ($stmt->rowCount() == 1){
				MyLogger::info("Exit EventsDAO.findEvent() with true");
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$fetchedEvent = new Event($row['TITLE'], $row['DESCRIPTION'], $row['DATE'], $row['URL']);
				//put user in session
				session_start();
				$_SESSION['Event'] = $fetchedEvent;
				// Session::put('Event', $fetchedEvent);
				return $fetchedEvent;
			}else{
				MyLogger::info("Exit EventsDAO.findEvent() with false");
				return false;
			}
		}catch (PDOException $e){
			//BEST practice: catch all exceptions (do not swallow exceptions),
			//log the exception, do not throw technology specific exceptions, and throw a cusom exception
			MyLogger::error("Exception: ", array("message" => $e->getMessage()));
			throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
		}
	}
	
	public function getAllEvents() {
	    MyLogger::info("Entering EventsDAO.getAllEvents()");
	    
	    try{
	        // only select events after todays date, order by date ascending
	        $stmt = $this->conn->prepare("SELECT * FROM events WHERE DATE > '" . date("Y-m-d") . "' ORDER BY DATE");
	        $stmt->execute();
	        
	        //See if events returned and return true if found else return false if not found
	        //Bad practice: this is a business rules in our DAO
	        if ($stmt->rowCount() > 0){
	            MyLogger::info("Exit EventsDAO.getAllEvents() with events found");
	            // get all events as associative arrays
	            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $events;
	        }else{
	            MyLogger::info("Exit EventsDAO.getAllEvents() with false");
	            return false;
	        }
	    }catch (PDOException $e){
	        //BEST practice: catch all exceptions (do not swallow exceptions),
	        //log the exception, do not throw technology specific exceptions, and throw a cusom exception
	        MyLogger::error("Exception: ", array("message" => $e->getMessage()));
	        throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
	    }
	}
}