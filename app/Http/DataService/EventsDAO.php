<?php
namespace App\Http\DataService;

use App\Http\Model\Event;
use App\Http\Utillity\DatabaseException;
use App\Http\Utillity\MyLogger;
use Illuminate\Support\Facades\Session;
use PDO;
use PDOException;

class EventsDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * creates an event in database and returns true if it was added successfully
     *
     * @param Event $event
     * @throws DatabaseException
     * @return boolean
     */
    public function createEvent(Event $event)
    {
        MyLogger::info("Entering EventsDAO.createEvent()");

        try {
            // select info about event
            // url title date description
            $url = $event->getUrl();
            $title = $event->getTitle();
            $date = $event->getDate();
            $description = $event->getDescription();
            $capacity = $event->getCapacity();
            // create a prepared statment. Pass valus by binding pararmeters one by one
            $stmt = $this->conn->prepare("INSERT INTO events (ID, URL, TITLE, DATE, DESCRIPTION, CAPACITY) VALUES (null,?, ?, ?, ?,?)");
            $stmt->bindParam(1, $url);
            $stmt->bindParam(2, $title);
            $stmt->bindParam(3, $date);
            $stmt->bindParam(4, $description);
            $stmt->bindParam(5, $capacity);
            $stmt->execute();

            // check if changes were made
            if ($stmt->rowCount() == 1) {
                MyLogger::info("Exit EventsDAO.createEvent() with true");
                return true;
            } else {
                MyLogger::info("Exit EventsDAO.createEvent() with false");
                return false;
            }
        } catch (PDOException $e) {
            // log exception and throw a custom exception
            MyLogger::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * @param int $userID
     * @param int $eventID
     * @param int $attendents
     * @throws DatabaseException
     * @return boolean
     */
    public function attendEvent($eventID, $attendents)
    {
        MyLogger::info("Entering EventsDAO.attendEvent()");
        $userID = Session::get('User')->getUserId();

        try {
            // check if duplicate process first
            $duplicate = $this->conn->prepare("SELECT * FROM attendies WHERE users_ID = :userId AND events_ID = :eventId LIMIT 1");
            $duplicate->bindParam(':userId', $userID);
            $duplicate->bindParam(':eventId', $eventID);
            $duplicate->execute();

            // See if user already attended event else move
            if ($duplicate->rowCount() == 1) {
                MyLogger::info("Exit EventsDAO.attendEvent() with false. Duplicate attend signup!");
                return 2;
            } else {
                // Check to see if there's enough room for the amount of people specified
                $validateRoom = $this->conn->prepare("SELECT CAPACITY, CURRENTATTENDIES FROM events WHERE ID = :eventID");
                $validateRoom->bindParam(':eventID', $eventID);
                $validateRoom->execute();
                $row = $validateRoom->fetch(PDO::FETCH_ASSOC);
                if ((int) $row['CAPACITY'] - (int) $row['CURRENTATTENDIES'] - $attendents < 0)
                    return 3;
                // Updated attendies is to be used a little further on to update the event itself in the database, to increase it's current attendies column.
                $updatedAttendies = intVal($row['CURRENTATTENDIES']) + $attendents;
                // create a prepared statment. Pass valus by binding pararmeters one by one
                $stmt = $this->conn->prepare("INSERT INTO attendies (users_ID, events_ID, MEMBERS) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $userID);
                $stmt->bindParam(2, $eventID);
                $stmt->bindParam(3, $attendents);
                $stmt->execute();

                // check if changes were made
                if ($stmt->rowCount() == 1) {

                    // Updates the event row with an updated current attendies column, as there are more people attending now
                    $updateEvent = $this->conn->prepare("UPDATE events SET CURRENTATTENDIES = :updatedAttendies WHERE ID = :eventID");
                    $updateEvent->bindParam(':updatedAttendies', $updatedAttendies);
                    $updateEvent->bindParam(':eventID', $eventID);
                    $updateEvent->execute();
                    if ($updateEvent->rowCount() == 1) {
                        MyLogger::info("Exit EventsDAO.attendEvent() with true");
                        return 0;
                    } else {
                        MyLogger::info("Update event failed");
                        return 1;
                    }
                } else {
                    MyLogger::info("Exit EventsDAO.attendEvent() with false");
                    return 1;
                }
            }
        } catch (PDOException $e) {
            // log exception and throw a custom exception
            MyLogger::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }
    
    public function unattendEvent($eventID, $currentAttendies){
    	MyLogger::info("Entering EventsDAO.attendEvent()");
    	$userID = Session::get('User')->getUserId();
    	
    	try {
	    	// Check to see if there's enough room for the amount of people specified
	    	$members = $this->conn->prepare("SELECT MEMBERS FROM attendies WHERE events_ID = :eventId LIMIT 1");
	    	$members->bindParam(':eventId', $eventID);
	    	$members->execute();
	    	$memberCount = $members->fetch(PDO::FETCH_ASSOC);
	    	if ($members->rowCount() == 1){   		
	    		// Updated attendies is to be used a little further on to update the event itself in the database, to increase it's current attendies column.
	    		//$updatedAttendies = intVal($row['CURRENTATTENDIES']) + $attendents;
	    		$updatedAttendies = intVal($memberCount['MEMBERS'] - $currentAttendies);
	    		// create a prepared statment. Pass valus by binding pararmeters one by one
	    		$stmt = $this->conn->prepare("DELETE FROM attendies WHERE users_ID = :userId AND events_ID = :eventId LIMIT 1");
	    		$stmt->bindParam(':userId', $userID);
	    		$stmt->bindParam(':eventId', $eventID);
	    		$stmt->execute();
	    				
	    		// check if changes were made
	    		if ($stmt->rowCount() == 1) {			
	    			// Updates the event row with an updated current attendies column
	    			$updateEvent = $this->conn->prepare("UPDATE events SET CURRENTATTENDIES = :updatedAttendies WHERE ID = :eventID");
	    			$updateEvent->bindParam(':updatedAttendies', $updatedAttendies);
	    			$updateEvent->bindParam(':eventID', $eventID);
	    			$updateEvent->execute();
	    			if ($updateEvent->rowCount() == 1) {
	    				MyLogger::info("Exit EventsDAO.attendEvent() with true");
	    				return true;
	    			} else {
	    				MyLogger::info("Update event failed");
	    				return false;
	    			}
	    		} else {
	    			MyLogger::info("Exit EventsDAO.attendEvent() with false");
	    			return false;
	    		}
	    	}
    	} catch (PDOException $e) {
    		// log exception and throw a custom exception
    		MyLogger::error("Exception: ", array(
    				"message" => $e->getMessage()
    		));
    		throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
    	}
    }

    /**
     * finds users in database and returns true if found
     *
     * @param Event $event
     * @throws DatabaseException
     * @return boolean
     */
    public function findEvent(int $id)
    {
        MyLogger::info("Entering EventsDAO.findEvent()");

        try {
            $stmt = $this->conn->prepare("SELECT * FROM events WHERE ID = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // See if user existed and return true if found else return false if not found
            // Bad practice: this is a business rules in our DAO
            if ($stmt->rowCount() == 1) {
                MyLogger::info("Exit EventsDAO.findEvent() with true");
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $fetchedEvent = new Event($row['TITLE'], $row['DESCRIPTION'], $row['DATE'], $row['URL'], $row['CAPACITY'], $row['CURRENTATTENDIES']);
                // put user in session
                session_start();
                $_SESSION['Event'] = $fetchedEvent;
                // Session::put('Event', $fetchedEvent);

                return $fetchedEvent;
            } else {
                MyLogger::info("Exit EventsDAO.findEvent() with false");
                return false;
            }
        } catch (PDOException $e) {
            // BEST practice: catch all exceptions (do not swallow exceptions),
            // log the exception, do not throw technology specific exceptions, and throw a cusom exception
            MyLogger::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }

    public function getAllEvents()
    {
        MyLogger::info("Entering EventsDAO.getAllEvents()");

        try {
            // only select events after todays date, order by date ascending
            $stmt = $this->conn->prepare("SELECT * FROM events WHERE DATE > '" . date("Y-m-d") . "' ORDER BY DATE");
            $stmt->execute();

            // See if events returned and return true if found else return false if not found
            // Bad practice: this is a business rules in our DAO
            if ($stmt->rowCount() > 0) {
                MyLogger::info("Exit EventsDAO.getAllEvents() with events found");
                // get all events as associative arrays
                $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $events;
            } else {
                MyLogger::info("Exit EventsDAO.getAllEvents() with false");
                return false;
            }
        } catch (PDOException $e) {
            // BEST practice: catch all exceptions (do not swallow exceptions),
            // log the exception, do not throw technology specific exceptions, and throw a cusom exception
            MyLogger::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }

    public function deleteEvent($id)
    {
        MyLogger::info("Entering EventsDAO.deleteEvents()");
        try {
            // delete song based on id
            $stmt = $this->conn->query("DELETE FROM `events` WHERE `ID` = $id LIMIT 1");
            $result = $stmt->execute();

            MyLogger::info("event successfully deleted, exitng EventsDAO.deleteEvents()");
            // return bool if row was deleted
            return $result;
        } catch (PDOException $e2) {
            throw $e2;
        }
    }

    public function editEvent(Event $event)
    {
        MyLogger::info("Entering updatePlaylist() in the Playlist data service");
        try {
            // update playlist based on param playlist
            $stmt = $this->conn->prepare("UPDATE events SET URL = :url, TITLE = :title, DATE = :date, DESCRIPTION = :description, CAPACITY = :capacity WHERE ID = :id");
            $id = $event->getID();
            $url = $event->getUrl();
            $title = $event->getTitle();
            $date = $event->getDate();
            $description = $event->getDescription();
            $capacity = $event->getCapacity();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':capacity', $capacity);

            $stmt->execute();
            // check rows affected
            $result = $stmt->rowCount();
            if ($result == 1) {
                MyLogger::info("Event successfully updated, exiting, EventDAO.editEvent()");
                return true;
            } else {
                MyLogger::warning("Event not successfully updated, exiting, EventDAO.editEvent()");
                return false;
            }
        } catch (PDOException $e2) {
            throw $e2;
        }
    }

    public function findattend($eventID)
    {
        MyLogger::info("Entering EventsDAO.findattend()");
        $userID = Session::get('User')->getUserId();

        try {
            // check if duplicate process first
            $duplicate = $this->conn->prepare("SELECT * FROM attendies WHERE users_ID = :userId AND events_ID = :eventId LIMIT 1");
            $duplicate->bindParam(':userId', $userID);
            $duplicate->bindParam(':eventId', $eventID);
            $duplicate->execute();
            if ($duplicate->rowCount() == 1) {
                MyLogger::info("Exit EventsDAO.findattend() with true");
                return true;
            } else {

                MyLogger::info("Exit EventsDAO.findattend() with false");
                return false;
            }
        } catch (PDOException $e) {
            // log exception and throw a custom exception
            MyLogger::error("Exception: ", array(
                "message" => $e->getMessage()));
	        throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
	    }	    
	}
	
	/**
	 *
	 * @throws DatabaseException
	 * @return boolean
	 */
	public function eventsAttending(){
		MyLogger::info("Entering EventsDAO.eventsAttending()");
		$userID = Session::get('User')->getUserId();
		
		try{
			// only select events the current logged in user is attending
			$stmt = $this->conn->prepare("SELECT * FROM events INNER JOIN attendies ON events.ID = attendies.events_ID AND attendies.users_ID='$userID'");
			$stmt->execute();
			
			//See if events returned and return true if found else return false if not found
			if ($stmt->rowCount() > 0){
				MyLogger::info("Exit EventsDAO.eventsAttending() with events found");
				// get all events as associative arrays
				$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

				return $events;
			}else{
				MyLogger::info("Exit EventsDAO.eventsAttending() with false");
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